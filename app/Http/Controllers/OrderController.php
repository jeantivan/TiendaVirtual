<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Product;
use App\OrderDetail;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use PDF;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->get();

        // Se cuenta la cantidad de productos de cada orden
        $orders->each(function($order){
            $total_products = $order->orderDetails()
                            ->selectRaw('SUM(quantity) as total_products')->first();
            $order->total_products = $total_products->total_products;
        });

        $addresses = auth()->user()->shippingAddresses;

        return view('orders', ['orders' => $orders, 'addresses' => $addresses]);
    }


    /**
     * Se Guarda la nueva orden y la dirección de envio del
     * usuario si es necesario.
     *
     */
    public function store(Request $request)
    {
        // El usuario
        $user = User::find(auth()->user()->id);

        // Los inputs
        $ids = $request->ids;
        $qtys = $request->qtys;
        $address = $request->address;
        $total = $request->total;

        // Se crea la orden
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'Esperando Pago',
            'shipping_address' => $address,
            'total' => $total
        ]);

        // Detalles de la orden
        $orderDetails = [];

        for ($i=0, $len = count($ids); $i < $len; $i++){

            $detail = [
                'product_id' => $ids[$i],
                'quantity' => $qtys[$i],
            ];

            array_push($orderDetails, $detail);

            // Restamos la cantidad del Producto a los registros
            $product = Product::find($ids[$i]);

            $product->quantity_available -= $qtys[$i];

            // Si no quedan productos se cambia el stock
            $product->in_stock = $product->quantity_available ? 1: 0;

            $product->save();
        }


        // Se crean los detalles de la Orden
        $order->orderDetails()->createMany($orderDetails);

        // Si el Usuario quiere guardar la dirección
        if ($request->has('save')) {

            // Si no existe la direccion la guardamos
            if(!$user->shippingAddresses()->where('address', $address)->exists()){
                
                $user->shippingAddresses()->create([
                    'address' => $address
                ]);  
            } 
        }

        // Eliminamos los productos en el Carrito del Usuario
        Cart::where('user_id', $user->id)->orWhere('session_key', session()->getId())->delete();

        // Se redirije a la vista con las ordenes del usuario
        return redirect()->route('users.orders.index')->with('message', 'Su orden ha sido procesada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    

    /**
     * Se actualiza la direccion de envio de la orden.
     *
     * 
     */
    public function update(Request $request, Order $order)
    {
        $address = $request->address;
        // Si el Usuario quiere guardar la dirección
        if ($request->has('save')) {

            // Si no existe la direccion la guardamos
            if(!$user->shippingAddresses()->where('address', $address)->exists()){
                
                $user->shippingAddresses()->create([
                    'address' => $address
                ]);  
            } 
        }

        $order->shipping_address = $address;

        $order->save();

        return redirect()->action('OrderController@index');
    }


    public function invoice($id)
    {
        $order = Order::find($id);
        $order->load('orderDetails.product', 'user', 'payment');

        $order->total_products = $order->orderDetails()->selectRaw('SUM(quantity) as total_products')->first();

        $pdf = PDF::loadView('invoice', ['order' =>$order]);

        return $pdf->stream('invoice.pdf');

        //return view('invoice', ['order' => $order]);

    }
}
