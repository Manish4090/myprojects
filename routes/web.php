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
		
	});
	Route::post('logout','Auth\AuthenticatedSessionController@destroy')->name('logout');
	
});
