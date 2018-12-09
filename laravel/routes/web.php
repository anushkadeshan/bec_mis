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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ds', 'UserController@ds')->name('ds');
Route::get('/users', 'UserController@index')->name('users');
Route::post('userActivate', 'UserController@userActivate')->name('userActivate');
Route::post('userDelete', 'UserController@userDelete')->name('userDelete');
Route::post('changeRole', 'UserController@changeRole')->name('changeRole');
Route::post('markAsRead', 'NotificationsController@markAsRead')->name('markAsRead');
Gate::define('userList', 'App\Policies\userRoles@superAdmin');


