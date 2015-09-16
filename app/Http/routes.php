<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('proc', function ($fullSrc = 'coverImgs\full\2015-09-14\20-39-28-HmD8N.jpeg')
{
    $start = microtime(true);
    $wiiBox = new Imagick('boxes/wii.png');
    $overlay = new Imagick('boxes/overlay.png');

    $base = new Imagick();
    $base->newImage(706, 538, 'none', 'png');

    $img = new Imagick($fullSrc);
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
        41, 0, 32, 27, //top right
        0, 538, 7, 506, //bottom left
        41, 538, 32, 509//bottom right
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


    header('Content-Type:image/png');
    echo $base;

    $end = microtime(true);
    $diff = $end - $start;

    Log::debug("Timediff: {$diff}");

});

Route::get('about', function ()
{
    return view('pages.about');
});

Route::get('templates', function ()
{
    return view('pages.templates');
});

//Covers routes
Route::get('covers/create', ['as' => 'covers.create', 'uses' => 'CoversController@create']);
Route::post('covers', ['as' => 'covers.store', 'uses' => 'CoversController@store']);
Route::get('covers/{covers}', ['as' => 'covers.show', 'uses' => 'CoversController@show']);
Route::get('/', ['as' => 'covers.index', 'uses' => 'CoversController@index']);
Route::get('covers/{covers}/edit', ['as' => 'covers.edit', 'uses' => 'CoversController@edit']);
Route::put('covers/{covers}', ['as' => 'covers.update', 'uses' => 'CoversController@update']);
Route::delete('covers/{covers}', ['as' => 'covers.destroy', 'uses' => 'CoversController@destroy']);

//Profile routes
Route::get('users/{users}', ['as' => 'profiles.show', 'uses' => 'ProfilesController@show']);
Route::get('users/{users}/edit', ['as' => 'profiles.edit', 'uses' => 'ProfilesController@edit']);
Route::put('users/{users}', ['as' => 'profiles.update', 'uses' => 'ProfilesController@update']);

//Login routes
Route::get('auth/check/{email}', ['as' => 'auth.check', 'uses' => 'Auth\AuthController@check']);
Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@postRegister']);