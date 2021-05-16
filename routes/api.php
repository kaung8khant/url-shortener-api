<?php

use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('shorten', 'UrlShortenerController@store');
Route::get('link/{code}', 'UrlShortenerController@shortenLink');

Route::group(['prefix' => 'admin', 'middleware' => ['json.response']], function () {
    Route::post('login', 'Auth\AdminAuthController@login');

    Route::middleware('auth:users')->group(function () {
        Route::get('url', 'Admin\UrlController@index');
        Route::delete('url/{id}', 'Admin\UrlController@destroy');
    });
});
