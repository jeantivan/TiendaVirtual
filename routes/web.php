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

Route::prefix('admin')->group(function () {
	
	Route::get('/', 'AdminController@index')->name('index');
	// Todos los Productos
    Route::get('products', 'AdminController@products')->name('products');

    // Todos las Ordenes
    Route::get('orders', 'AdminController@orders')->name('orders');
});
