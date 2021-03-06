<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * This is an authentication endpoint for first party clients that are also a
 * part of the Music.php project and can use password grant API authentication.
 */
Route::post('/oauth/grant/password', 'PasswordGrantController@login');
Route::post('/oauth/grant/refresh', 'PasswordGrantController@refresh');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/albums/{album}/image', 'AlbumController@image');
    Route::get('/tracks/{track}/audio', 'TrackController@audio');
    Route::post('/logout', 'PasswordGrantController@logout');
    Route::resource('albums', 'AlbumController', ['except' => [
        'create', 'edit'
    ]]);
    Route::resource('artists', 'ArtistController', ['except' => [
        'create', 'edit'
    ]]);
    Route::resource('tracks', 'TrackController', ['except' => [
        'create', 'edit'
    ]]);
});
