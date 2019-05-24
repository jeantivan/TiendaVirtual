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

		// Productos
		Route::resource('products', 'Admin\ProductController');

		// Ordenes
    	Route::resource('orders', 'Admin\OrderController')->only('index', 'show', 'update');


    	// Pagos
    	Route::resource('payments', 'Admin\PaymentController')->only('index');
    	Route::post('payments/verified', 'Admin\PaymentController@verified')->name('payments.verified');
    	
    	// Categorias
    	Route::resource('categories', 'Admin\CategoryController')->only('index', 'store', 'destroy');
		
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

		// Ruta de la factura
		Route::get('/orders/invoice/{id}', 'OrderController@invoice')->name('orders.invoice');

		// Ruta de los Pagos
		Route::get('/payments/{order}', 'PaymentController@payment')->name('payments.payment');
		Route::post('/payments', 'PaymentController@store')->name('payments.store');
	});


	
	
});


