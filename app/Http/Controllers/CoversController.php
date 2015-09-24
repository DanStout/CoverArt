<?php

namespace Coverart\Http\Controllers;

use Coverart\Cover;
use Coverart\Platform;
use Coverart\Services\CoverImageService;
use Illuminate\Http\Request;
use Coverart\Http\Requests;
use Coverart\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Imagick;
use Log;

class CoversController extends Controller
{
    protected $covImgServ;
    public function __construct(CoverImageService $covImgServ)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->covImgServ = $covImgServ;
    }

    //display all covers
    public function index()
    {
        $coverQuery = Cover::with('platform', 'user')->orderBy('created_at', 'desc');
        $covers = $coverQuery->paginate(15);
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
        $this->checkCoverAuth($cover);

        $this->validate($request, [
            'title' => 'required|max:100',
            'description' => 'max:1000',
            'platform_id' => 'exists:platforms,id'
        ]);

        $platformDidChange = $request->input('platform_id') != $cover->platform_id;
        $cover->update($request->all());
        if ($platformDidChange)
        {
            Log::debug('Generating previews');
            $this->covImgServ->GenerateAndSavePreviews($cover);
        }
        $msg = 'Cover updated successfully.';
        if ($platformDidChange) $msg .= ' You may need to refresh your browser before the updated preview image is displayed.';
        return redirect()->route('covers.index')->with('message', $msg);
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
            'title' => 'required|max:100',
            'cover' => 'image|max:10000',
            'description' => 'max:1000',
            'platform_id' => 'exists:platforms,id'
        ]);
        $file = $request->file('cover');

        $cover = new Cover($request->all());
        $cover->user_id = Auth::id();

        $this->covImgServ->ProcessCover($cover, $file);

        $cover->save();

        return redirect()->route('covers.index')->with('message', 'Cover uploaded successfully');
    }

    //abort if user shouldn't be accessing this cover
    private function checkCoverAuth(Cover $cover)
    {
        if ($cover->user_id !== Auth::user()->id)
            abort(403);
    }
}
