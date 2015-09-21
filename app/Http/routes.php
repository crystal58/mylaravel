<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::group(['prefix'=>'admin','namespace' => 'Admin','middleware' => 'auth'], function()
{
    // Controllers Within The "App\Http\Controllers\Admin" Namespace

    Route::get('/', 'UserController@index');

//    Route::group(['namespace' => 'User'], function()
//    {
//        // Controllers Within The "App\Http\Controllers\Admin\User" Namespace
//    });
});