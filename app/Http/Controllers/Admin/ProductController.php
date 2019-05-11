<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);

        /*foreach ($products as $product) {
            $image = $product->images()->where('product_id', $product->id)->get();
            echo "Path:". $image->first()->path . "<br>";
        }*/
        
        return view('admin.products', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        // Se valida la data 
        $request->validate([
            'name' => 'required|max:190',
            'price' =>'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required|max:191',
            'imagen' => 'bail|required|image|max:5000'
        ]);
        // Se guarda la imagen en local
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('public/images');
        }
        // Guardamos los resultados en la BBDD
       
        $entrada = $request->all();

        $entrada['imagen'] = $path;

        Productos::create($entrada);

        // Redirijimos a 
        return redirect()->action('ProductosController@index')->with('message', 'Producto agregado con éxito.');*/
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
