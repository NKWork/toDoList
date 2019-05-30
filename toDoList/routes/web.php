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

Route::get('/', 'dashboardController@index')->middleware('auth');
Route::get('/dashboard/getcomments/{id}','dashboardController@getComments')->middleware('auth');
Route::post('/dashboard/add', 'dashboardController@createTask')->middleware('auth');

Route::put('/dashboard/update/{id}','dashboardController@update' )->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');