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
    Route::post('users', 'Auth\UserController@updateUserInfo');
    Route::post('video', 'Auth\VideoController@create');
    Route::post('video/{id}/comment', 'Auth\CommentController@createComment');
});

Route::get('videos', 'Auth\VideoController@getListVideos');
Route::get('video/{id}', 'Auth\VideoController@getVideoInfo');
Route::get('video/{id}/comments', 'Auth\CommentController@getListComments');

Route::post('video/{id}/reation', 'Auth\ReactionController@createReaction');
Route::get('video/{id}/reations', 'Auth\ReactionController@getListReaction');
Route::delete('reation/{id}', 'Auth\ReactionController@destroyReaction');
Route::post('video/{id}/view', 'Auth\ViewController@updateVideoViewCount');
