<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Payment;

class PaymentController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }


    public function payment(Order $order)
    {
    	return view('payment', ['order' => $order]);
    }

    public function store(Request $request)
    {

    	$payment = new Payment;

    	$payment->order_id = $request->order_id;
    	$payment->banco = $request->banco;
    	$payment->nro_ref = $request->ref;
    	$payment->save();

    	$order = Order::find($request->order_id);
    	$order->status = "Confirmando Pago";
    	$order->save();

    	$order = null;
    	$payment = null;

    	return redirect()->action('OrderController@index');


    }
}
