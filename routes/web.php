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

    #region Домашние фронт-руты
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::get('/about', 'HomeController@about');
    Route::get('/contacts', 'HomeController@contacts');

    Route::get('/news', 'FrontController@showAllPosts');
    Route::get('/news/{id}', 'FrontController@openPost');
    #endregion

    #region Ошибки
    Route::get('/error503', function() {
        return view('errors.503');
    });
    Route::get('/error404', function() {
        return view('errors.404');
    });
    #endregion

    #region Руты админки
    Route::group(['prefix' => 'admin', 'middleware' => 'admin.access'], function () {
        Route::get('/', 'AdminController@index');

        // Геймеры
        Route::resource('gamers', 'GamerController');
        Route::post('gamerScoreUpdate', 'GamerController@scoreUpdate');

        // Команды
        Route::resource('teams', 'TeamController');
        Route::post('teamsScoreUpdate', 'TeamController@scoreUpdate');

        // Посты/новости
        Route::resource('posts', 'PostController');

        // Турниры
        Route::resource('tournaments', 'TournamentController');
        Route::post('tournamentScoreUpdate', 'TournamentController@scoreUpdate');

        // Заявки
        Route::group(['prefix' => 'requests'], function() {
            // на создание команды
            Route::resource('teamCreate', 'TeamCreateRequestController');
            Route::post('confirm', 'TeamCreateRequestController@confirmRequest');
            Route::post('deny', 'TeamCreateRequestController@denyRequest');
        });

        // Ключ-Значение
        Route::resource('keyValues', 'KeyValueController');


    });
    #endregion

    //Route::get('/syncTeams', 'AjaxController@syncTeams');

    #region Рейтинги во фронте
    Route::group(['prefix' => 'rating'], function () {
        Route::get('/gamers/{game?}', 'FrontController@gamerRating');
        Route::get('/teams/{game?}', 'FrontController@teamRating');
    });

    #endregion

    #region Регистрации участников и команд
    Route::group(['prefix' => 'register'], function () {

        Route::get('/gamer', 'GamerController@registerForm');
        Route::post('/gamer', 'GamerController@createGamerAccount');
        Route::get('/gamer/result', 'GamerController@displayGamerRegisterResult');

        Route::get('/team', 'GamerController@registerTeamForm');

    });
    #endregion

    #region Аякс-руты
    Route::group(['prefix' => 'ajax'], function() {
        Route::post('search-gamer', 'GamerController@searchGamerForDuplicate');
        Route::get('test', 'AjaxController@test');

        Route::post('participantsForSelect', 'AjaxController@getParticipantsForSelect');
    });
    #endregion

    #region Авторизационные пути
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
    #endregion


