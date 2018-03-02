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
Route::resource('/sizes','Master\SizeController');
Route::resource('/units','Master\UnitController');

Route::resource('/brands','BrandController');
Route::resource('/categories','CategoryController');

Route::resource('/suppliers','SupplierController');
