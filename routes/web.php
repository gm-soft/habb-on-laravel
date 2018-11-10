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
    Route::get('/event_schedule', 'HomeController@eventSchedule');


    Route::get('/news', 'HomeController@news');
    Route::get('/news/{id}', 'HomeController@openPost');
    Route::get('/tournaments/{id}', 'HomeController@openTournament');

    #endregion

    #region Ошибки

    if (env('APP_DEBUG')){
        Route::get('/error503', function() {
            return view('errors.503');
        });
        Route::get('/error500', function() {
            return view('errors.500');
        });
        Route::get('/error404', function() {
            return view('errors.404');
        });
    }

    #endregion

    #region Руты админки
    Route::group(['prefix' => 'admin', 'middleware' => 'admin.access'], function () {
        Route::get('/', 'AdminController@index');

        // Геймеры
        Route::resource('gamers', 'GamerController');
        Route::post('gamerReportForDatatable', 'GamerController@gamerReportForDatatable');
        Route::get('gamersTableToExcel', 'GamerController@gamersTableToExcel');

        // Команды
        Route::resource('teams', 'TeamController');

        // Посты/новости
        Route::resource('posts', 'PostController');

        Route::any('posts/preview/announce', 'PostController@postAnnouncePreview');
        Route::any('posts/preview/post', 'PostController@postPreview');

        //Баннеры
        Route::resource('banners', 'BannerController');

        // Статичные страницы
        Route::group(['prefix' => 'static_pages'], function() {

            Route::get('/', 'StaticPageController@index');
            Route::get('/{id}', 'StaticPageController@show');
            Route::get('/{id}/edit', 'StaticPageController@edit');
            Route::post('/update/{id}', 'StaticPageController@update');
            Route::patch('/update/{id}', 'StaticPageController@update');
            Route::any('/preview', 'StaticPageController@preview');
        });

        // Турниры
        Route::resource('tournaments', 'TournamentController');
        Route::any('/tournament_preview', 'TournamentController@preview');

        // Пользователи системы
        Route::resource('users', 'UserController');

        // Заявки
        Route::group(['prefix' => 'requests'], function() {
            // на создание команды
            Route::resource('teamCreate', 'TeamCreateRequestController');
            Route::post('confirm', 'TeamCreateRequestController@confirmRequest');
            Route::post('deny', 'TeamCreateRequestController@denyRequest');
        });

        // Ключ-Значение
        Route::resource('keyValues', 'KeyValueController');

        Route::resource('external_services', 'ExternalServicesController');
        Route::post('update_api_key', 'ExternalServicesController@updateApiKey');

        //бэкапы
        Route::group(['prefix' => 'backups'], function() {

            Route::get('/', 'BackupController@index');
            Route::get('/create', 'BackupController@create');
            Route::get('/download', 'BackupController@download');
            Route::post('/delete', 'BackupController@delete');
        });


        // загрузчик файлов
        Route::get('files', 'UploadController@index');
        Route::get('files/upload', 'UploadController@page');
        Route::post('files/upload', 'UploadController@store');
        Route::post('files/getAsJson', 'UploadController@getImagesAsJsonArray');

        if (env('APP_DEBUG')){
            Route::get('files/getAsJson', 'UploadController@getImagesAsJsonArray');
        }
    });
    #endregion


    #region Регистрации участников и команд
    Route::group(['prefix' => 'register'], function () {

        Route::get('/gamer', 'GamerController@registerForm');
        Route::post('/gamer', 'GamerController@createGamerAccount');
        Route::get('/gamer/result', 'GamerController@displayGamerRegisterResult');

        Route::get('/team', 'RegisterFormController@teamRegisterForTournament');
        Route::post('/team', 'RegisterFormController@saveTeamRegisterForTournament');
        Route::get('/team/result', 'RegisterFormController@teamRegisterForTournamentResult');

    });
    #endregion

    #region Аякс-руты
    Route::group(['prefix' => 'ajax'], function() {
        Route::post('search-gamer', 'GamerController@searchGamerForDuplicate');
        Route::get('test', 'AjaxController@test');

        Route::post('/participantsForSelect', 'AjaxController@getParticipantsForSelect');
    });
    #endregion

    #region Api-routes\

    Route::group(['prefix' => 'api'], function () {

        Route::group(['prefix' => 'gamers'], function () {
            Route::post('/create', 'ApiController@createGamer');

            Route::get('/exists', 'ApiController@doesGamerExists');

            Route::get('/{id}', 'ApiController@getGamer');
        });
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

    Route::get('profile','HomeController@profile');
    #endregion


