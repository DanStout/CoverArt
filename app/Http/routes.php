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

Route::get('about', function ()
{
    return storage_path();
//    return view('pages.about');
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