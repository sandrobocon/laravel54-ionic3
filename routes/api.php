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

ApiRoute::version('v1',function() {
    ApiRoute::group(['namespace'=> 'CodeFlix\Http\Controllers\Api','as' => 'api'], function(){
        ApiRoute::post('/access_token','AuthController@accessToken')
            ->name('.access_token');
    });
});
