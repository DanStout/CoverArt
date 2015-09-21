<?php

namespace Coverart\Http\Controllers;

use Coverart\Platform;
use Illuminate\Http\Request;

use Coverart\Http\Requests;
use Coverart\Http\Controllers\Controller;

class TemplatesController extends Controller
{
    public function index()
    {
        $platforms = Platform::all();
        return view('templates.index', ['platforms' => $platforms]);
    }

    public function download($id)
    {
        $templatePsdPath = Platform::find($id)->template_psd_path;
        return response()->download($templatePsdPath);
    }
}
