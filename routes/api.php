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
/**
 * @SWG\Swagger(
 *   basePath="/api",
 *   @SWG\Info(
 *     title="MyApp API",
 *     version="1.0"
 *   )
 * )
 */

Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');

// protected routes
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('users', 'Auth\UserController@getUserInfo');
    Route::put('users', 'Auth\UserController@updateUserInfo');
    Route::post('videos', 'Auth\VideoController@create');
    Route::post('videos/{id}/comments', 'Auth\VideoController@createComment');
});

Route::get('videos', 'Auth\VideoController@getListVideos');
Route::get('videos/{id}', 'Auth\VideoController@getVideoInfo');
Route::get('videos/{id}/comments', 'Auth\VideoController@getListComments');

