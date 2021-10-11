<?php

use Illuminate\Support\Facades\Route;

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





Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



Route::get('/google', 'GoogleController@redirectToGoogle');
Route::get('/google/callback', 'GoogleController@handleGoogleCallback');

Route::get('facebook', 'FacebookController@redirectToFacebook');
Route::get('facebook/callback', 'FacebookController@handleFacebookCallback');

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
	Route::namespace('Auth')->middleware('guest:admin')->group(function(){
		Route::get('login','AuthenticatedSessionController@create')->name('login');
		Route::post('login','AuthenticatedSessionController@store')->name('adminlogin');
	});
	Route::middleware('admin')->group(function(){
		Route::get('dashboard','HomeController@index')->name('dashboard');
		Route::post('/getstates','UserController@getstates')->name('getstates');
		Route::post('/grocery/post', 'UserController@getstates1');
		Route::get('customer', 'UserController@index')->name('customer');
		Route::get('customer/{id}', 'UserController@usersdetails')->name('customerdetails');
		Route::get('customer/edit/{id}', 'UserController@usersedit')->name('customer.edit');
		Route::post('customer/detailsave', 'UserController@detailsave')->name('customer.detailsave');
		Route::post('customer/delete', 'UserController@deletecus')->name('customer.delete');
		Route::any('addnew/customer', 'UserController@addnewusers')->name('addnewcustomer');
		Route::any('addnewcus', 'UserController@addnewcus')->name('addnewcus');
		
		// User Management Routes
		Route::any('usersmanagement', 'UserController@usersmanagement')->name('usersmanagement');
		Route::any('usersmanagement/{id}', 'UserController@usersmanagementinfo')->name('usersmanagementinfo');
		Route::any('create-users', 'UserController@usersmanage')->name('create-users');
		Route::any('create-users-management', 'UserController@storeusersmanage')->name('create-users-management');
		Route::any('edit-users-management/{id}', 'UserController@editusersmanage')->name('edit-users-management');
		Route::post('update-users-management/{id}', 'UserController@updateusersmanage')->name('update-users-management');
		Route::any('delete-users-management/{id}', 'UserController@userdestroy')->name('delete-users-management');
		
		// User Role Routes
		Route::any('roles', 'RoleController@index')->name('roles');
		Route::any('edit-roles/{id}', 'RoleController@edit')->name('edit-roles');
		Route::any('update-roles/{id}', 'RoleController@update')->name('update-roles');
		Route::any('show-roles/{id}', 'RoleController@show')->name('show-roles');
		Route::any('create-roles', 'RoleController@create')->name('create-roles');
		Route::any('store-roles', 'RoleController@store')->name('store-roles');
		Route::any('destroy-roles/{id}', 'RoleController@destroy')->name('destroy-roles');
		
		
	});
	Route::post('logout','Auth\AuthenticatedSessionController@destroy')->name('logout');
	
});

  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});


