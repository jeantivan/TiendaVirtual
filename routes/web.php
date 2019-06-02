<?php
/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
|
| Aquí estan registradas todas las rutas que maneja la aplicación 
| 
*/
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

Route::resource('products', 'ProductController')->only('index', 'show');
Route::resource('categories', 'CategoryController')->only('index','show');

Route::get('/contact', function(){
	return view('contact');
})->name('contact');

// Rutas de administrador con prefijo y nombres
Route::prefix('admin')->group(function () {
	
	Route::name('admin.')->group( function (){

		// Productos
		
		Route::resource('products', 'Admin\ProductController')->except('edit');

		Route::post('/products/toTrash/{product}', 'Admin\ProductController@toTrash')->name('products.totrash');

		Route::get('/products/trash', 'Admin\ProductController@trash')->name('products.trash');

		Route::post('/products/restore/{id}', 'Admin\ProductController@restore')->name('products.restore');


		// Ordenes
    	Route::resource('orders', 'Admin\OrderController')->only('index', 'show', 'update');


    	// Pagos
    	Route::resource('payments', 'Admin\PaymentController')->only('index', 'show');
    	Route::post('payments/verified', 'Admin\PaymentController@verified')->name('payments.verified');
    	
    	// Categorias
    	Route::resource('categories', 'Admin\CategoryController')
    	->only('index', 'store');
		
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