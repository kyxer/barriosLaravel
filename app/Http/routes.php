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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [
    'as' => 'home',
    'uses' => 'Frontend\Dashboard\HomeController@index'
]);

Route::group(['middleware' => ['auth']], function() {
    Route::post('account/avatar', [
        'as' => 'avatar',
        'uses' => 'Frontend\Account\UserController@postAvatar'
    ]);

    Route::post('account/send-verify', [
        'as' => 'sendVerify',
        'uses' => 'Frontend\Account\UserController@postVerify'
    ]);

    Route::get('perfil', [
        'as' => 'profile',
        'uses' => 'Frontend\Account\UserController@getProfile'
    ]);

    Route::post('account/user', [
        'as' => 'updateUser',
        'uses' => 'Frontend\Account\UserController@postProfile'
    ]);
});

Route::get('auth/login/{provider}',[
    'as' => 'loginWithProvider',
    'uses' => 'Frontend\Auth\AuthController@getloginWithProvider']
);

Route::post('auth/login', [
    'as' => 'login',
    'uses' => 'Frontend\Auth\AuthController@postLogin'
]);

Route::post('auth/register', [
    'as' => 'register',
    'uses' => 'Frontend\Auth\AuthController@postRegister'
]);

Route::get('auth/logout', [
    'as' => 'logout',
    'uses' => 'Frontend\Auth\AuthController@getLogout'
]);

Route::post('auth/recover', [
    'as' => 'recover',
    'uses' => 'Frontend\Auth\PasswordController@postEmail'
]);

Route::post('auth/reset', [
    'as' => 'reset',
    'uses' => 'Frontend\Auth\PasswordController@postReset'
]);

Route::get('cambiar-contrasena/{token}', [
    'as' => 'viewReset',
    'uses' => 'Frontend\Auth\PasswordController@getReset'
]);

Route::get('verificar-cuenta/{verified_code}', [
    'as' => 'verification',
    'uses' => 'Frontend\Auth\AuthController@getVerify'
]);

Route::get('{url_barrio}/actividades', [
    'as' => 'activities',
    'uses' => 'Frontend\Activities\ActivitiesController@getIndex'
]);

Route::get('{url_barrio}/foros', [
    'as' => 'forums',
    'uses' => 'Frontend\Forums\ForumsController@getIndex'
]);

Route::get('{url_barrio}/noticias', [
    'as' => 'news',
    'uses' => 'Frontend\News\NewsController@getIndex'
]);

Route::get('{url_barrio}', [
    'as' => 'barrios',
    'uses' => 'Frontend\Dashboard\HomeController@getBarrio'
]);

Route::post('search/barrio', [
    'as' => 'searchBarrio',
    'uses' => 'Frontend\Dashboard\HomeController@postSearchBarrio'
]);

Route::get('auth/{provider}',[
        'as' => 'handleRedirectFacebook',
        'uses' => 'Frontend\Auth\AuthController@getLoginWithProvider']
);
