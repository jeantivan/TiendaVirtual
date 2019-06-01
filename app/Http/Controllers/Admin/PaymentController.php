<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Order;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Se muestran todos los pagos
     *
     */
    public function index()
    {
        $payments = Payment::orderBy('updated_at', 'desc')->paginate(5);

        // Pasamos los datos de la orden y 
        // del usuario al cual le pertene la orden
        $payments->load('order.user');

        return view('admin.payments', ['payments' => $payments]);
    }

    /**
     *
     * Se muestran los detalles del pago
     * 
     */
    public function show(Payment $payment)
    {
        $payment->load('order.user');

        return view('admin.showPayment', ['payment' => $payment]);
    }

    /*
     * Se recibe la confirmación de pago y se cambia
     * el status de la compra
    */
    public function verified(Request $request)
    {
        $order = Order::find($request->order_id);

        $order->status = "Pago Verificado";
        $order->save();     
    }

}
