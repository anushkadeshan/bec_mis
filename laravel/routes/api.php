<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::get('user', 'PassportController@details');
    Route::get('/vacancies', 'VacancyController@vacancies_api');;
});

Route::post('/register', 'FlutterUserController@register');
Route::post('/login', 'FlutterUserController@login');
Route::get('/user', 'FlutterUserController@getCurrentUser');
Route::post('/update', 'FlutterUserController@update');
Route::get('/logout', 'FlutterUserController@logout');
