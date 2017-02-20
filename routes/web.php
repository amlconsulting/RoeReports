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

/**
 * Dashboard
 */
Route::group(['prefix' => 'dashboard'], function() {
    Route::get('/', 'DashboardController@dashboard');
    Route::get('/invoices', 'DashboardController@invoices');
    Route::get('/sales', 'DashboardController@sales');
});

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

    Route::get('edit', function() {
        return Auth::user();
    });

    Route::get('view-plans', 'SubscriptionController@viewPlans');
    Route::get('plans', 'SubscriptionController@plans');
    Route::post('subscribe/{plan}', 'SubscriptionController@subscribe');
    Route::get('swap/{plan}', 'SubscriptionController@swap');
    Route::get('cancel/confirm/{plan}', 'SubscriptionController@cancelConfirm');
    Route::post('cancel/{plan}', 'SubscriptionController@cancel');
    Route::get('resume', 'SubscriptionController@resume');
    Route::post('update-card', 'SubscriptionController@updateCard');
});

/**
 * Legal documents
 */
Route::group(['prefix' => 'legal'], function() {
    Route::get('terms', function() {
        return view('legal.terms');
    });

    Route::get('privacy', function() {
        return view('legal.privacy');
    });
});

Route::group(['prefix' => 'llr'], function() {
    Route::get('edit-login', 'LuLaRoeController@editLogin');
    Route::post('update-login', 'LuLaRoeController@updateLogin');
    Route::get('sessions', 'LuLaRoeController@sessions');
    Route::get('invoice', 'LuLaRoeController@invoice');
    Route::post('add-invoice', 'LuLaRoeController@addInvoice');
});