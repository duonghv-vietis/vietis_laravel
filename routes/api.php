<?php

use Illuminate\Http\Request;
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

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function() {
    Route::get('/posts/search', 'PostsController@searchPosts')->name('posts.search');

    Route::resource('posts', 'PostsController');
});


Route::group(['prefix' => 'v1/auth', 'namespace' => 'Api\v1\Auth'], function () {
    Route::post('/register', 'AuthController@register')->name('register');
    Route::post('/login', 'AuthController@login')->name('login');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/logout', 'AuthController@logout')->name('logout');
        Route::get('/user', 'AuthController@me')->name('me');
    });
});
