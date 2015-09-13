<?php

namespace Coverart\Http\Controllers;

use Coverart\Cover;
use Coverart\Http\Requests\StoreCoverRequest;
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
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $covers = Cover::all();
        return view('covers.index', ['covers' => $covers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('covers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(StoreCoverRequest $request)
    {
        $data = $request->all();

        $file = $request->file('cover');
        $newName = Str::random(20).'.'.$file->guessExtension();
        $file->move('coverImgs/', $newName);
        $destPath = 'coverImgs/'.$newName;
        $this->processImg($destPath);
        $data['img_path'] = $destPath;
        $cover = Auth::user()->covers()->create($data);
        return redirect('covers');
    }

    private function processImg($path)
    {
        $img = new Imagick($path);
        $img->resizeImage(200, 200, imagick::FILTER_LANCZOS, 1, true);
        $img->writeImage('written.jpg');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
