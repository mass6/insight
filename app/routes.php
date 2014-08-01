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

Route::get('/report/{report}', 'ReportController@getReport');

Event::listen('Insight.Sessions.Events.*', 'Insight\Listeners\ActivityLogger@whenUserLoggedIn');

Event::listen('Insight.Users.Events.UserUpdated', function($event){
    Log::info('_____SEND EMAIL:_______  = ' . $event->user->send_email);
});

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
 * Dashboards
 */
Route::get('dashboard', ['as' => 'dashboards.home', 'uses' => 'DashboardsController@home']);

/**
 * Portal
 */
Route::get('portal/ajax/{report}', 'PortalController@getAjaxReport');
Route::get('portal/users', ['as' => 'portal.users', 'uses' => 'PortalController@getUsers']);
Route::get('portal/contracts', ['as' => 'portal.contracts', 'uses' => 'PortalController@getContracts']);
Route::get('portal/products', ['as' => 'portal.products', 'uses' => 'PortalController@getProducts']);
Route::get('portal/doa', ['as' => 'portal.doa', 'uses' => 'PortalController@getDoa']);
Route::get('portal/approvals', ['as' => 'portal.approvals', 'uses' => 'PortalController@getApprovals']);
Route::get('portal/approval-statistics', ['as' => 'portal.approvals.statistics', 'uses' => 'PortalController@getApprovalStatistics']);
Route::get('portal/orders/search', ['as' => 'portal.orders.search', 'uses' => 'PortalController@searchRouter']);
Route::get('portal/orders/search/{searchTerm}', ['as' => 'portal.orders.search_term', 'uses' => 'PortalController@searchOrder']);
Route::get('portal/orders/{period}', ['as' => 'portal.orders.period', 'uses' => 'PortalController@getOrders']);
Route::get('portal/orders/details/{id}', ['as' => 'portal.orders.details', 'uses' => 'PortalController@getOrderDetails']);
Route::get('portal/orders', function(){
    return Redirect::route('portal.orders.period',['period'=>'today']);
});

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