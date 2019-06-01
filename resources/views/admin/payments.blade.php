@extends('layouts.admin')

@section('content')
<div class="container-fluid my-3">
	<h1 class="title">Pagos.</h1>
	<hr>
@if(count($payments))
	@foreach($payments as $payment)
		<div class="card shadow-sm my-3">
			<div class="card-header">
				<h3>Número de pago <a href="{{route('admin.payments.show', ['payment' => $payment->id])}}">#{{$payment->id}}</a></h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<h5>Número de Orden: <a href="{{route('admin.orders.show' , ['order' => $payment->order_id])}}"><span class="badge badge-dark">#{{$payment->order_id}}</span></a>
						</h5>
						<h5>Monto de la Compra: <span class="badge badge-success">{{$payment->order->total}} Bs</span></h5>
						<h5>Número de Referencia: <span class="badge badge-info">#{{$payment->nro_ref}}</span></h5>
						<h5>Banco: <span class="badge badge-secondary">{{ucwords($payment->banco)}}</span></h5>
						<h5>Pagado en: <strong>{{$payment->created_at}}</strong></h5>
					</div>
					<div class="col-md-6">
						<h5>
							Nombre del cliente: <strong>{{ $payment->order->user->name . " " . $payment->order->user->last_name}}</strong>
						</h5>
						<h5>Correo del cliente: <strong>{{ $payment->order->user->email}}</strong></h5>
						<h5>Telefono de contacto: <strong>{{ $payment->order->user->phone_number}}</strong></h5>
					@if($payment->order->status === 'Pago Verificado' || $payment->order->status === 'Orden Enviada')
						<button class="btn btn-block btn-success my-3 confirm-payment disabled" data-order="{{$payment->order_id}}">Confirmar Pago</button>
					@else
						<button class="btn btn-block btn-success my-3 confirm-payment" data-order="{{$payment->order_id}}">Confirmar Pago</button>
					@endif
					</div>
				</div>
				
			</div>
		</div>
	@endforeach
	{{ $payments->links()}}
@else
	<h3 class="text-center title text-danger">No hay pagos disponibles.</h3>
@endif

</div>
@endsection