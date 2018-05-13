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
Route::get('register/verify/{code}','AuthController@ValidateUser');
Route::get('/auth/{provider}', 'AuthController@redirectToProvider');
Route::get('auth/{provider}/redirect', 'AuthController@handleProviderCallback');
Route::get('/', function () {
    return view('welcome');
});
