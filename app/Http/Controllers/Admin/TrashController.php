<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class TrashController extends Controller
{
    public function __construct()
    {
    	$this->middleware('admin');
    }

    /**
     * 
     * Muestra los productos en la papelera.
     *
     */
    public function trash()
    {
        /*if (!$request) {
            $products = Product::onlyTrashed()->get();
            return view('admin.trash', ['products' => $products]);
        }*/

        //$products = Product::onlyTrashed()->where('name', $request->search)->get();
        $products = Product::onlyTrashed()->get();
        return $products;
        //return view('admin.trashed', ['products' => $products]);

    }

    /**
     * 
     * Restaura un producto de la papelera
     *
     */
    public function restore(Product $product)
    {

    }
}
