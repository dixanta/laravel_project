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

Route::get('/dashboard','DashboardController@index');
Route::resource('/colors','Master\ColorController');
Route::post('/colors/status','Master\ColorController@changeStatus');
Route::resource('/sizes','Master\SizeController');
Route::post('/sizes/status','Master\SizeController@changeStatus');
Route::resource('/units','Master\UnitController');
Route::post('/units/status','Master\UnitController@changeStatus');

Route::resource('/brands','BrandController');
Route::resource('/categories','CategoryController');
Route::post('/categories/status','CategoryController@changeStatus');
Route::resource('/stores','StoreController');
Route::resource('/suppliers','SupplierController');
