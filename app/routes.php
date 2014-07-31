<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/test', function(){
    $radius = 0;

    // radius can't be negative
    if ($radius <= 0) {
        throw new Exception('Invalid Radius: ' . $radius);
    } else {
        return pi() * $radius * $radius;
    }
});


Event::listen('Insight.Sessions.Events.*', 'Insight\Listeners\ActivityLogger@whenUserLoggedIn');

// Home page
Route::get('/', [
    'as' => 'home',
    'uses' => 'PagesController@home'
]);
// Authentication routes
Route::get('login', [
    'as' => 'login_path',
    'uses' => 'SessionsController@create'
]);
Route::post('login', [
    'as'    => 'login_path',
    'uses'  => 'SessionsController@store'
]);
Route::get('logout', [
    'as'    => 'logout_path',
    'uses'  => 'SessionsController@destroy'
]);

Route::get('forgot-password', ['as' => 'password.forgot', 'uses' => 'PasswordsController@forgotPassword']);
Route::post('forgot-password', ['as' => 'password.forgot', 'uses' => 'PasswordsController@sendResetLink']);
Route::get('reset-password/{token}', ['as' => 'password.edit', 'uses' => 'PasswordsController@edit']);
Route::patch('password-update/{user}', ['as' => 'password.update', 'uses' => 'PasswordsController@update']);
Route::patch('password-verify-update/{user}/{token}', ['as' => 'password.verify_update', 'uses' => 'PasswordsController@verifyAndUpdate']);

/**
 * Profile
 */
Route::resource('profiles', 'ProfilesController', ['only' => ['index', 'show', 'update']]);

/**
 * Admin
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{
    Route::resource('users', 'Admin\UsersController');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::resource('groups', 'Admin\GroupsController');
    Route::get('/', [
        'as' => 'admin.index',
        'uses' => 'Admin\AdminController@index'
    ]);
});