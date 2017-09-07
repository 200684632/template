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
Route::get('/test', 'TestController@test')->name('test')->remark('娃娃');
Route::group(['middleware' => 'auth'], function() {
//    Route::get('/test', 'TestController@test')->name('test')->remark('娃娃');
});

Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
