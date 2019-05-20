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

Route::resource('products', 'ProductController')->only('index', 'show');
Route::get('/categories', 'CategoryController@index')->name('categories');

Route::get('/contact', function(){
	return view('contact');
})->name('contact');

// Rutas de administrador con prefijo y nombres
Route::prefix('admin')->group(function () {
	
	Route::name('admin.')->group( function (){

		// Todos los Productos
		Route::resource('products', 'Admin\ProductController');

		// Todos las Ordenes
    	Route::get('orders', 'Admin\AdminController@orders')->name('orders');

    	Route::resource('categories', 'Admin\CategoryController');
		
		// Dashboard de Administrador
		Route::get('/', 'Admin\AdminController@index')->name('index');

	});
    

    

});

Route::prefix('users')->group(function(){

	Route::name('users.')->group(function(){

		// Rutas del Carrito
		Route::resource('carts', 'CartController')->only('index', 'store', 'destroy');

		// Preorder
		Route::post('/carts/preorder', 'CartController@preOrder')->name('preorder');

		// Rutas de las Ordenes
		Route::resource('orders', 'OrderController')->only('index', 'store', 'update');

	});
	
	
});


