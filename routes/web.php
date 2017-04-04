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


Route::get('/', 'HomeController@index');
Route::get('/manager', 'ManagerController@index')->name('manager');
Route::get('/manager/{application}', 'ManagerController@openFile')->name('file');

Route::post('/manager', 'UploadController@store')->name('apply');

Auth::routes();