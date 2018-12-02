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

//Admin routes 
Route::namespace('Admin')->prefix('admin')->group(function(){

Route::get('/', 'AdminController@login')->name('login');
Route::get('/login', 'AdminController@login')->name('login');
Route::post('/post-auth', 'AdminController@postAuth');

Route::get('/forgot-auth', 'AdminController@forgotAuth');
Route::post('/post-forgot', 'AdminController@postForgot');

Route::get('/reset-auth', 'AdminController@resetAuth');
Route::post('/post-reset-auth', 'AdminController@postResetAuth');

});	
// Admin route after succussfully login 
Route::namespace('Admin')->prefix('admin')->as('admin.')->middleware('auth:user')->group(function
	(){

	Route::any('change-status', 'AjaxController@changeStatus');
	Route::post('hard-delete/{table}/{id}', 'AjaxController@hardDelete');
	Route::post('get-all-data', 'AjaxController@getAllData');
   
	Route::get('/dashboard', 'AdminController@dashboard');
	Route::get('/profile', 'AdminController@profile');
	Route::post('/post-profile', 'AdminController@postProfile');
	Route::post('/change-password', 'AdminController@postChangePassword');
	Route::get('/logout', 'AdminController@logout');
	
    // users route
    Route::resource('users', 'UserController');

    // Company Route
    Route::resource('companies', 'CompanyController');

    // Vouchers Route
    Route::resource('vouchers', 'VoucherController');

    // Vouchers Route
    Route::resource('lesars', 'LesarController');
	
    

});	
