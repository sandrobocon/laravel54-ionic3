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

    ApiRoute::group(
        ['namespace'=> 'CodeFlix\Http\Controllers\Api',
            'as' => 'api'
        ], function(){
            ApiRoute::post('/access_token',[
                'uses' => 'AuthController@accessToken',
                'middleware' => 'api.throttle',
                'limit' => 10, // Qty
                'expires' => 1 // Time in minutes (10 requests in 1 minute)
            ])->name('.access_token');

            ApiRoute::group([
                'middleware' => ['api.throttle', 'api.auth'],
                'limit' => 100,
                'expires' => 3
            ], function(){
                ApiRoute::post('/logout','AuthController@logout');

                ApiRoute::get('/test',function(){
                    return 'oi';
                });
            });
    });
});
