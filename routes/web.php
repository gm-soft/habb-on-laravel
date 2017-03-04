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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');
Route::get('/news', 'HomeController@news');
Route::get('/about', 'HomeController@about');
Route::get('/contacts', 'HomeController@contacts');

Route::group(['prefix' => 'admin', 'middleware' => 'admin.access'], function () {
    Route::get('/', 'AdminController@index');


    Route::group(['prefix' => 'gamers'], function() {
        Route::get('/', 'GamerController@index');
        Route::get('/show/{id}', 'GamerController@show');

        Route::get('/create', 'GamerController@create');
        Route::post('/store', 'GamerController@store');

        Route::get('/edit/{id}', 'GamerController@edit');
        Route::post('/update', 'GamerController@update');

        Route::post('/delete/{id}', 'GamerController@delete');
    });

});

/**
 * Auth Routes
 */

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');



