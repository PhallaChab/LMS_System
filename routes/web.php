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


Auth::routes();

//home page
Route::get('/', 'HomeController@index')->name('admin');
Route::get('/applyLeave','HomeController@applyLeave');
Route::post('/addLeaveform','HomeController@createLeave');
Route::get('/leaveRequest','HomeController@showLeaverequest');
Route::get('/paddingRequest','HomeController@paddingRequest');
Route::get('/approveRequet/{id}','HomeController@approveRequet');
Route::get('/rejectRequet/{id}','HomeController@rejectRequet');

//edit leave
Route::get('/editleave/{id}','HomeController@editleave');
Route::post('/updateLeave','HomeController@updateLeave');
Route::get('/deleteleave','HomeController@deleteleave');

//manage admin
Route::get('/admin', 'AdminController@index');
Route::get('/admin/manageuser','AdminController@showmanageUser')->middleware('admin');
Route::get('/addUser','AdminController@addUserForm')->middleware('admin');
Route::post('/createNewUser','AdminController@createNewUser')->middleware('admin');
Route::get('/editUser/{id}','AdminController@editUser')->middleware('admin');
Route::get('/deleteUser','AdminController@destroyUser')->middleware('admin');

//manage leave request in admin
Route::get('/admin/leaverequest','AdminController@showAllLeave');

//change password
Route::get('/changePassword','ChangepasswordController@index');
Route::post('/updatePassword','ChangepasswordController@updatePassword');

//manage profile
Route::get('/profile','AdminController@userProfile');

// manage role
Route::get('/admin/managerole','AdminController@indexRole');
Route::post('/createRole','AdminController@createRole');
Route::get('/editrole/{id}','AdminController@editrole');
