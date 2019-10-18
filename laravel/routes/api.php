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

Route::namespace('Api')->group(function () {
    Route::get('user', 'AuthController@user')->name('user');

    Route::group(['middleware' => ['guest']], function () {
        Route::post('register', 'AuthController@register')->name('register');
        Route::post('login', 'AuthController@login')->name('login');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::post('logout', 'AuthController@logout')->name('logout');
    });
});
