<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Payment;
use App\Category;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    /**
     * Dashboard del administrador
     *
     */
    public function index()
    {
        // Datos para mostrar en la vista
        $products = Product::orderBy('updated_at', 'desc')->limit(3)->get();

        $payments = Payment::orderBy('updated_at', 'desc')->limit(4)->get();

        // Se muestran las ultimas ordenes dependiendo del status
        
        // Ultimas Ordenes creadas
        $last_orders = Order::orderBy('created_at', 'desc')->limit(4)->get();

        // Ultimas Ordenes Pagadas
        $paid_orders = Order::where('status', 'Confirmando Pago')->orderBy('updated_at', 'desc')->limit(4)->get();

        // Ultimas Ordenes con pago Verificado
        $confirmed_orders = Order::where('status', 'Pago Verificado')->orderBy('updated_at', 'desc')->limit(4)->get();

        // Se cargan las relaciones;
        
        // De las ordenes 
        /*$orders->load('user');
        $orders->each(function($order){
            $total_products = $order->orderDetails()
                            ->selectRaw('SUM(quantity) as total_products')->first();
            $order->total_products = $total_products->total_products;
        });*/

        // De los Productos
        $products->load('images');

        // De los Pagos
        $payments->load('order.user');

        $data = [
            'products' => $products, 
            'payments' => $payments,
            'last_orders' => $last_orders,
            'paid_orders' => $paid_orders,
            'confirmed_orders' => $confirmed_orders
        ];
        
        return view('admin.dashboard', $data);
    }

}
