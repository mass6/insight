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

Route::get('testing', 'PagesController@testing');

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


// Member routes
Route::group(array('before' => 'auth'), function()
{

    // Home page
    Route::get('/', [
        'as' => 'home',
        'uses' => 'PagesController@home'
    ]);

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
        Route::get('portal/orders/print/{id}', ['as' => 'portal.orders.print', 'uses' => 'PortalController@printOrder']);
        Route::get('portal/orders', function(){
            return Redirect::route('portal.orders.period',['period'=>'today']);
        });
});

/**
 * Admin
 */
// Admin routes
Route::group(array('prefix' => 'admin', 'before' => 'auth|admin'), function()
{
    Route::resource('users', 'Admin\UsersController');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::resource('groups', 'Admin\GroupsController');
    Route::get('/', [
        'as' => 'admin.index',
        'uses' => 'Admin\AdminController@index'
    ]);
});