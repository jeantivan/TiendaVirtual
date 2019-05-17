<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Product;
use App\User;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Se muestran los productos que tiene el usuario en el carrito
     * en las sesion actual
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carts = Cart::where('user_id', auth()->user()->id)
                    ->where('session_key', session()->getId())->get();
        $products = [];
        foreach ($carts as $cart) {
            array_push($products, Product::find($cart->product_id));
        }

        return view('carts', ['carts' => $carts, 'products' => $products]);
    }

    /**
     * Se almacenan los productos del usuario en un carrito
     * utilizando la sesion actual
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cart $cart)
    {
        $user_id = auth()->user()->id;
        $product_id = $request->product_id;
        $session_key = session()->getId();

        $cart->user_id = $user_id;
        $cart->product_id = $product_id;
        $cart->session_key = $session_key;
        $cart->save();

        return response('success', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return response('Producto eliminado del Carrito.',200);
    }
}
