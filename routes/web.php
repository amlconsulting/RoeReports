<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

Auth::routes();

/**
 * User Registration
 */
Route::group(['prefix' => 'register'], function() {
    Route::get('confirm/{activation_token}', 'Auth\RegisterController@confirm');
});

Route::get('/dashboard', 'DashboardController@index');

/**
 * SocialAuth
 */
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

/**
 * User Profile
 */
Route::group(['prefix' => 'user'], function() {
    Route::get('profile', 'UserController@profile');
    Route::get('edit', 'UserController@edit');
    Route::post('update', 'UserController@update');
    Route::post('password', 'UserController@changePassword');
});

/**
 * Stripe
 */
Route::group(['prefix' => 'subscription'], function() {
    Route::get('secret', function() {
        return Config::get('services.stripe.secret');
    });
});