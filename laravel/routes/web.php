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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ds', 'UserController@ds')->name('ds');
Route::get('/users', 'UserController@index')->name('users');
Route::post('userActivate', 'UserController@userActivate')->name('userActivate');
Route::post('userDelete', 'UserController@userDelete')->name('userDelete');
Route::post('changeRole', 'UserController@changeRole')->name('changeRole');
Route::post('markAsRead', 'NotificationsController@markAsRead')->name('markAsRead');

Gate::define('userList', 'App\Policies\userRoles@superAdmin');
Route::get('markAllAsRead', 'NotificationsController@markAllAsRead')->name('markAllAsRead');
//Employer Routes
Route::get('newEmployer', 'EmployerController@create')->name('newEmployer')->middleware('can:create-Employer');
Route::get('employers', 'EmployerController@index')->name('employers')->middleware('can:view-Employer');
Route::post('employerDelete', 'EmployerController@delete')->name('employerDelete')->middleware('can:delete-Employer');
Route::post('employerInsert', 'EmployerController@create')->name('employerInsert')->middleware('can:create-Employer');
Route::post('/employerUpdate', 'EmployerController@update')->name('employerUpdate')->middleware('can:update-Employer');
Route::get('/e-profile', 'EmployerController@profile')->name('e-profile')->middleware('can:view-Employer-Profile');
Route::post('/e-profile-update', 'EmployerController@profileUpdate')->name('e-profile-update')->middleware('can:view-Employer-Profile');

//vacancies route
Route::get('/vacancies', 'VacancyController@index')->name('vacancies')->middleware('can:view-vacancies');
Route::get('/new-vacancy', 'VacancyController@show')->name('new-vacancy')->middleware('can:create-vacancies');
Route::post('/locationList', 'VacancyController@locationList')->name('locationList');
Route::post('/add-vacancy', 'VacancyController@store')->name('add-vacancy')->middleware('can:create-vacancies');
Route::get('/vacancy/{id}/edit', 'VacancyController@edit')->name('edit-vacancy')->middleware('can:edit-vacancies'); 
Route::post('/vacancy/update', 'VacancyController@update')->name('update-vacancy')->middleware('can:edit-vacancies'); 
Route::post('/vacancy/delete', 'VacancyController@delete')->name('delete-vacancy')->middleware('can:delete-vacancies'); 
Route::get('/vacancy/{id}/view', 'VacancyController@view')->name('view-vacancy')->middleware('can:view-vacancies'); 



