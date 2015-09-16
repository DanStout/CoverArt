<?php

namespace Coverart\Http\Controllers;

use Coverart\Cover;
use Illuminate\Http\Request;

use Coverart\Http\Requests;
use Coverart\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Imagick;

class CoversController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    //display all covers
    public function index()
    {
        $covers = Cover::all();
        return view('covers.index', ['covers' => $covers]);
    }

    //display a single cover
    public function show(Cover $cover)
    {
        return view('covers.show', ['cover' => $cover]);
    }

    //show form for editing a cover
    public function edit(Cover $cover)
    {
        $this->checkCoverAuth($cover);
        return view('covers.edit', ['cover' => $cover]);
    }

    //update a cover
    public function update(Request $request, Cover $cover)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'description' => 'max:1000'
        ]);

        $this->checkCoverAuth($cover);
        $cover->update($request->all());
        return redirect()->route('covers.index')->with('message', 'Cover updated successfully');
    }

    //delete a cover
    public function destroy(Cover $cover)
    {
        $this->checkCoverAuth($cover);
        $cover->delete();
        return redirect()->route('covers.index')->with('message', 'Cover deleted successfully');
    }

    //show form for creating a cover
    public function create()
    {
        return view('covers.create');
    }

    //store a cover
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'cover' => 'max:10000',
            'description' => 'max:500'
        ]);
        $file = $request->file('cover');

        $time = time();
        $today = date('Y-m-d', $time);
        $timeStr = date('H-i-s-', $time);
        $fileName = $timeStr.Str::random(5).'.'.$file->guessExtension();

        $fullDestDir = "coverImgs/full/{$today}";
        $fullDestPath = "{$fullDestDir}/{$fileName}";

        $previewDestDir = "coverImgs/preview/{$today}";
        if (!file_exists($previewDestDir))
            mkdir($previewDestDir, 0777, true);
        $previewDestPath = "{$previewDestDir}/{$fileName}";

        $file->move($fullDestDir, $fileName);
        $this->processImg($fullDestPath, $previewDestPath);

        $cover = new Cover($request->all());
        $cover->full_img_path = $fullDestPath;
        $cover->preview_img_path = $previewDestPath;
        $cover->user_id = Auth::id();
        $cover->save();

        return redirect()->route('covers.index')->with('message', 'Cover uploaded successfully');
    }

    //abort if user shouldn't be accessing this cover
    private function checkCoverAuth($cover)
    {
        if ($cover->user_id !== Auth::user()->id)
            abort(403);
    }

    private function processImg($src, $dest)
    {
        $img = new Imagick($src);
        $img->distortImage(imagick::DISTORTION_PERSPECTIVE, [], true);
        $img->resizeImage(200, 200, imagick::FILTER_LANCZOS, 1, true);
        $img->writeImage($dest);
    }
}
