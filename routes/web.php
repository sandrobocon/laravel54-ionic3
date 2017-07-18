<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
    ->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::get('/home', 'HomeController@index');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin\\'
],function() {
    Route::name('login')->get('login','Auth\LoginController@showLoginForm');
    Route::post('login','Auth\LoginController@login');

    Route::group(['middleware' => 'can:admin'], function(){
        Route::name('logout')->post('logout','Auth\LoginController@logout');
        Route::get('dashboard', function(){
           return view('admin.dashboard');
        });
    });
});

Route::get('/force-login',function(){
   \Auth::loginUsingId(1);
});