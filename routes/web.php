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


Route::group(['namespace'=>'Admin'],function()
{

    Route::get('', 'LoginController@showLoginForm')->name('login');
    Route::post('', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');

    Route::group(['middleware'=>'auth','prefix' => 'admin'],function()
    {

        Route::get('', 'DashboardController@index')->name('dashboard');

        Route::post('actions/query_contacts', 'CustomersController@queryContacts')->name('query_contacts');

        Route::get('customers', 'CustomersController@showCustomersTable')->name('customers');
        Route::post('customers', 'CustomersController@delete');
        Route::get('customers/add','CustomersController@showCustomersAddForm')->name('customers_add');
        Route::post('customers/add', 'CustomersController@add');
        Route::get('customers/edit/{customer}', 'CustomersController@showCustomersEditForm')->name('customers_edit');
        Route::post('customers/edit/{customer}', 'CustomersController@edit');

        Route::get('contacts', 'ContactsController@showContactsTable')->name('contacts');
        Route::post('contacts', 'ContactsController@delete');
        Route::get('contacts/add','ContactsController@showContactsAddForm')->name('contacts_add');
        Route::post('contacts/add', 'ContactsController@add');
        Route::get('contacts/edit/{contact}', 'ContactsController@showContactsEditForm')->name('contacts_edit');
        Route::post('contacts/edit/{contact}', 'ContactsController@edit');

        Route::group(['middleware'=>'super.admin'],function()
        {

            Route::get('admin_users','AdminAccountsController@showAdminsTable')->name('admins');
            Route::post('admin_users','AdminAccountsController@delete');
            Route::get('admin_users/add','AdminAccountsController@showAdminsAddForm')->name('admins_add');
            Route::post('admin_users/add', 'AdminAccountsController@add');
            Route::get('admin_users/edit/{admin_account}', 'AdminAccountsController@showAdminsEditForm')->name('admins_edit');
            Route::post('admin_users/edit/{admin_account}', 'AdminAccountsController@edit');
        });
    });
});



//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
