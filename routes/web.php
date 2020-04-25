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

Route::get('/user_cpanel', 'HomeController@index')->name('User Panel')->middleware('cors');
Route::get('/user', 'UserController@index');
Route::get('/producers', 'UserController@getProducers');
Route::get('/user_geopoint/{id}', 'UserGeopointController@show');
Route::post('/user_geopoint/{id}', 'UserGeopointController@update');

Route::post('/user_cpanel/studio', 'Backend\UserControlPanelController@store');
Route::get('/user_cpanel/product', 'Backend\ProductController@index');
Route::post('/user_cpanel/product/store', 'Backend\ProductController@store');
Route::get('/user_cpanel/product/cats', 'Backend\ProductController@cats');
