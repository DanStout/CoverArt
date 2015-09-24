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

//If you're getting 403 forbidden, check if that route is also a file/directory in the public folder!

Route::get('templates', ['as' => 'templates.index', 'uses' => 'TemplatesController@index']);
Route::get('templates/{template_id}/download', ['as' => 'templates.download', 'uses' => 'TemplatesController@download']);

//Covers routes
Route::get('covers/create', ['as' => 'covers.create', 'uses' => 'CoversController@create']);
Route::post('covers', ['as' => 'covers.store', 'uses' => 'CoversController@store']);
Route::get('covers/{cover_id}', ['as' => 'covers.show', 'uses' => 'CoversController@show']);
Route::get('/', ['as' => 'covers.index', 'uses' => 'CoversController@index']);
Route::get('covers/{cover_id}/edit', ['as' => 'covers.edit', 'uses' => 'CoversController@edit']);
Route::put('covers/{cover_id}', ['as' => 'covers.update', 'uses' => 'CoversController@update']);
Route::delete('covers/{cover_id}', ['as' => 'covers.destroy', 'uses' => 'CoversController@destroy']);

//Profile routes
Route::get('users/{user_id}', ['as' => 'profiles.show', 'uses' => 'ProfilesController@show']);
Route::get('users/{user_id}/edit', ['as' => 'profiles.edit', 'uses' => 'ProfilesController@edit']);
Route::put('users/{user_id}', ['as' => 'profiles.update', 'uses' => 'ProfilesController@update']);

//Login routes
Route::get('auth/check/{email}', ['as' => 'auth.check', 'uses' => 'Auth\AuthController@check']);
Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@postRegister']);