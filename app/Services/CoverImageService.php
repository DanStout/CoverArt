<?php namespace Coverart\Services;

use Coverart\Cover;
use Illuminate\Support\Str;
use Imagick;
use Log;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CoverImageService
{
    /**
     * Process the image to be associated with a given cover
     * Generates a 3D preview
     *
     * @param Cover $cover
     * @param UploadedFile $file
     */
    public function ProcessCover(Cover $cover, UploadedFile $file)
    {
        //setup files and directories
        $time = time();
        $today = date('Y-m-d', $time);
        $timeStr = date('H-i-s-', $time);
        $baseFileName = $timeStr.Str::random(5);

        $fullDestDir = "coverImgs/full/{$today}";
        $fullDestPath = "{$fullDestDir}/{$baseFileName}.jpg";
        $file->move($fullDestDir, $baseFileName.'.jpg');

        $previewDestDir = "coverImgs/preview/{$today}";
        if (!file_exists($previewDestDir))
        mkdir($previewDestDir, 0777, true);

        $previewDestBasePath = "{$previewDestDir}/{$baseFileName}";
        $previewLargePath = $previewDestBasePath.'-large.png';
        $previewSmallPath = $previewDestBasePath.'-small.png';

        $cover->full_img_path = $fullDestPath;
        $cover->small_preview_img_path = $previewSmallPath;
        $cover->large_preview_img_path = $previewLargePath;

        $this->GenerateAndSavePreviews($cover);
    }

    /**
     * Regenerates and saves the previews for this cover, assuming all relevant directories exist.
     * @param Cover $cover
     */
    public function GenerateAndSavePreviews(Cover $cover)
    {
        $boxPath = storage_path($cover->platform->box_trim_path);
        $overlayPath = storage_path($cover->platform->box_overlay_path);
        $fullDestPath = $cover->full_img_path;
        $previewLargePath = $cover->large_preview_img_path;
        $previewSmallPath = $cover->small_preview_img_path;

        $preview = $this->GeneratePreview($fullDestPath, $boxPath, $overlayPath);

        /*
         * There are some seriously strange things going on with ImageMagick's handling of color profiles/spaces.
         * With no additional changes, RGB images which didn't have color would be converted to grayscale
         * when they were resized, which means they would often drastically lose color (Gray BG becoming black)
         * You can prevent that by calling transformimagecolorspace(Imagick::COLORSPACE_RGB) (Note that SRGB would not
         * work, for some reason) but then it would only seem to be handled correctly by web browsers - Photoshop or
         * Windows Explorer would still view it as grayscale. The solution ended up being prepending PNG32 to the filename,
         * which has the added benefit of greatly reducing the filesize.
         */

        $preview->writeImage('PNG32:'.$previewLargePath);
        $preview->resizeImage(300, 0, Imagick::FILTER_CATROM, 1);
        $preview->writeImage('PNG32:'.$previewSmallPath);
    }

    /**
     * Generate a 3D preview of a cover
     *
     * @param $coverPath string The path to the full version of the cover
     * @param $boxPath string The path to the box trim image
     * @param $overlayPath string The path to the overlay for this box size
     * @return Imagick The full preview
     */
    public function GeneratePreview($coverPath, $boxPath, $overlayPath)
    {
        $wiiBox = new Imagick($boxPath);
        $overlay = new Imagick($overlayPath);

        $base = new Imagick();
        $base->newImage(706, 538, 'none', 'png');

        $img = new Imagick($coverPath);
        $img->resizeImage(805, 538, imagick::FILTER_CATROM, 1, false);

        $img->setImageFormat('png');
        $img->setImageVirtualPixelMethod(Imagick::VIRTUALPIXELMETHOD_TRANSPARENT);

        $spine = clone $img;
        $spine->cropImage(41, 538, 382, 0);

        $spineCtrlPts =
            [
                0, 0, 7, 30, //top left
                41, 0, 33, 27, //top right
                0, 538, 7, 506, //bottom left
                41, 538, 33, 509//bottom right
            ];
        $spine->distortImage(Imagick::DISTORTION_PERSPECTIVE, $spineCtrlPts, false);

        $back = clone $img;
        $back->cropImage(382, 538, 0, 0);

        $backCtrlPts =
            [
                0, 0, 43, 51, //TL
                382, 0, 341, 42, //TR
                0, 538, 43, 483, //BL
                382, 538, 341, 495 //BR
            ];
        $back->distortImage(Imagick::DISTORTION_PERSPECTIVE, $backCtrlPts, false);

        //crop format: width, height, topLeftX, topLeftY
        $img->cropImage(382, 538, 424, 0);

        //points in format srcX, srcY, destX, destZ
        $ctrlPts =
            [
                0, 0, 42, 25, //TL
                382, 0, 338, 47, //TR
                0, 538, 42, 511, //BL
                382, 538, 338, 485 //BR
            ];

        $img->distortImage(imagick::DISTORTION_PERSPECTIVE, $ctrlPts, false);

        $base->compositeImage($back, Imagick::COMPOSITE_DEFAULT, -2, -2);
        $base->compositeImage($spine, Imagick::COMPOSITE_DEFAULT, 331, -7);
        $base->compositeImage($img, Imagick::COMPOSITE_DEFAULT, 321, -7);
        $base->compositeImage($overlay, Imagick::COMPOSITE_DEFAULT, 0, 0);
        $base->compositeImage($wiiBox, Imagick::COMPOSITE_DEFAULT, 0, 0);

        return $base;
    }

}