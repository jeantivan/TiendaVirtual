<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request) {
            $products = Product::orderBy('id', 'desc')->paginate(9);
            return view('products', ['products' => $products]);
        }

        $products = Product::where('name', 'like', '%'. $request->s .'%')
                    ->orderBy('id', 'desc')->paginate(9);

        $products->each(function($products){
            $products->images;
        });
        return view('products', ['products' => $products]);
        
    }

    public function show($id){
        // Se encuentra el Producto en la BBDD
        // en caso de no existir retorna un error HTTP 404
        $product = Product::findOrFail($id);

        // Se cargan las relaciones del producto
        $product->load('images', 'categories');

        // Se retorna una vista y se le pasa el Producto
        return view('showProduct', ['product' => $product]);
    }

}
