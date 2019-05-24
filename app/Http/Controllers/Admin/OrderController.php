<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order; 

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Se muestran todos los pedidos
     */
    public function index()
    {
        $orders = Order::orderBy('updated_at', 'desc')->paginate(10);
        $orders->load('user');
        $orders->each(function($order){
            $total_products = $order->orderDetails()
                            ->selectRaw('SUM(quantity) as total_products')->first();
            $order->total_products = $total_products->total_products;
        });
        
        return view('admin.orders', ['orders' => $orders]);
    }

    /**
     * Se muestran los detalles de una Orden
     * 
     */
    public function show(Order $order)
    {
        $order->load('orderDetails.product', 'user');

        return view('admin.showOrder', ['order' => $order]);
    }

    /**
     * Se actualiza el status de la orden
     */
    public function update(Order $order)
    {
        $order->status = "Enviada";
        $order->save();

        return $order;
    }
    
}
