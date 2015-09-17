<?php namespace Coverart\Services;

use Coverart\Cover;
use Illuminate\Support\Str;
use Imagick;
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



        $boxPath = storage_path($cover->platform->template_path);
        $overlayPath = storage_path($cover->platform->overlay_path);

        $preview = $this->GeneratePreview($fullDestPath, $boxPath, $overlayPath);

        $preview->writeImage($previewLargePath);

        $preview->resizeImage(300, 0, Imagick::FILTER_CATROM, 1);
        $preview->writeImage($previewSmallPath);

        $cover->full_img_path = $fullDestPath;
        $cover->small_preview_img_path = $previewSmallPath;
        $cover->large_preview_img_path = $previewLargePath;
    }

    /**
     * Generate a 3D preview of a cover
     *
     * @param $coverPath - The path to the full version of the cover
     * @param $boxPath
     * @param $overlayPath
     * @return Imagick - The full preview size
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
        $w = $img->getImageWidth();
        $h = $img->getImageHeight();

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