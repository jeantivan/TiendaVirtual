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
Route::get('/products', 'ProductController@index');

Route::prefix('admin')->group(function () {

	// Todos los Productos
    Route::resource('products', 'Admin\ProductController');

    // Todos las Ordenes
    Route::get('orders', 'Admin\AdminController@orders')->name('orders');
	
	Route::get('/', 'Admin\AdminController@index')->name('index');

});

Route::prefix('users')->group(function(){
	
	Route::resource('carts', 'CartController')->except('create', 'show', 'edit');
});


