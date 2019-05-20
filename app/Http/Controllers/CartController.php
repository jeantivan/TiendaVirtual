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

        $carts->each(function($carts){
            $carts->load('product');
        });

        return view('carts', ['carts' => $carts]);
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
     * Se elimina un Producto del Carrito del Usuario
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

    public function preOrder(Request $request)
    {
        // Los inputs
        $ids = $request->ids;
        $qtys = $request->qtys;

        $products = Product::select('id','name', 'price')->get()->only($ids);
        $products->load('images');

        $total = 0;
        for ($i=0, $len = count($ids); $i < $len ; $i++) { 
            $products[$i]->qty = $qtys[$i]['qty'];
            $total += $products[$i]->price * $qtys[$i]['qty'];
        }

        // Total de la Compra
        $total += $total * 0.12;
        $total = number_format($total, 2, '.','');

        // Si el usuario tiene alguna dirección de envio guardada
        // se la pasamos a la vista
        $user = User::find(auth()->id());
        if($user->has('shippingAddresses')) {
            $addresses = $user->shippingAddresses;
            return view('preorder', ['products' => $products, 'total' => $total, 'addresses' => $addresses]);
        }

        return view('preorder', ['products' => $products, 'total' => $total]);

    }
}
