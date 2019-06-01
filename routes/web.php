<?php
/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
|
| Aquí estan registradas todas las rutas que maneja la aplicación 
| 
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

Route::resource('products', 'ProductController')->only('index', 'show');
Route::get('/categories', 'CategoryController@index')->name('categories');

Route::get('/contact', function(){
	return view('contact');
})->name('contact');

// Rutas de administrador con prefijo y nombres
Route::prefix('admin')->group(function () {
	
	Route::name('admin.')->group( function (){

		// Productos
		Route::resource('products', 'Admin\ProductController')->except('edit');

		Route::get('/products/trash', 'Admin\TrashController@trash')->name('products.trash');

		Route::post('/products/restore/{product}', 'Admin\TrashController@restore')->name('products.restore');


		// Ordenes
    	Route::resource('orders', 'Admin\OrderController')->only('index', 'show', 'update');


    	// Pagos
    	Route::resource('payments', 'Admin\PaymentController')->only('index', 'show');
    	Route::post('payments/verified', 'Admin\PaymentController@verified')->name('payments.verified');
    	
    	// Categorias
    	Route::resource('categories', 'Admin\CategoryController')
    	->only('index', 'store');
		
		// Dashboard de Administrador
		Route::get('/dashboard', 'Admin\AdminController@index')->name('index');

	});

});

Route::get('/trash', function(){
	//$products = App\Product::onlyTrashed()->get();
	//return $products;
	//return view('admin.trash', ['products' => $products]);
	if (view()->exists('admin.trash')) {
		echo "La vista existe";
	} else{
		echo "No existe";
	}
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