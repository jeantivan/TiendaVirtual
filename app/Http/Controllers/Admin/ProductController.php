<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Lista todos los productos disponibles
     * Tambien recibe un Request para filtrar los resultados por 
     * un buscardor simple.
     * 
     */
    public function index(Request $request)
    {
        if (!$request) {
            $products = Product::paginate(10);
            return view('admin.products')->with('products', $products);
        }

        $products = Product::where('name', 'like', '%'. $request->s .'%')->paginate(10);

        $products->each(function($products){
            $products->images;
        });
        return view('admin.products')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Formulario para crear productos junto con las categorias disponibles
        $categories = Category::all();
        return view('admin.createProduct', ['categories' => $categories]);
    }

    /**
     * Almacena un producto nuevo en la BBDD
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        return $request->input('categories');

        // Se guarda la imagen en local
        /*if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/images/products/' . Str::slug($request->name, '-'));
            }

        }*/
        // Guardamos los resultados en la BBDD
       
        /*$entrada = $request->all();

        $entrada['imagen'] = $path;

        Product::create($entrada);

        // Redirijimos a 
        return redirect()->route('admin.products.index')->with('message', 'Producto agregado con éxito.');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
