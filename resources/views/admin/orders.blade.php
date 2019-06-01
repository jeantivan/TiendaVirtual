@extends('layouts.admin')

@section('content')
<div class="container-fluid my-3">
	<h1 class="title">Ordenes.</h1>
	<hr>
@if(count($orders))
	@foreach($orders as $order)
		<div class="card shadow-sm my-3">
			<div class="card-header clearfix">
				<div class="float-left h3 m-0">
					Orden <a href="{{ route('admin.orders.show', ['order' => $order->id])}}" class="card-link" title="Ver Orden">#{{$order->id}}</a>
				</div>
				
				<div class="float-right h5 my-auto">
						Ultima actualización: <strong>{{$order->updated_at}}</strong>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
						<div class="col-md-3">
							<h5><strong>Estado de la orden:</strong></h5>
							<p class="h4">
						@switch($order->status)
							@case('Esperando Pago')
								<span class="badge badge-danger">{{$order->status}}</span>
								@break
							@case('Confirmando Pago')
								<span class="badge badge-warning">{{$order->status}}</span>
								@break
							@case('Pago Verificado')
								<span class="badge badge-info">{{$order->status}}</span>
								@break
							@case('Enviada')
								<span class="badge badge-success">{{$order->status}}</span>
								@break
						@endswitch
							</p>				
						</div>
						<div class="col-md-3">
							<h5><strong>Cantidad de productos:</strong></h5>
							<p class="h4">
								<span class="badge badge-pill badge-info text-white">{{$order->total_products}}
								</span>
							</p>
						</div>
						<div class="col-md-3">
							<h5><strong>Dirección de envio:</strong></h5> 
							<p class="h4 text-secondary">
								{{substr($order->shipping_address, 0, 30)}}...

							</p>
						</div>
						<div class="col-md-3">
							<h5><strong>Total:</strong></h5> 
							<p class="h4">
								<span class="badge badge-success">
									{{$order->total}} Bs
								</span>
							</p>
							<a href="{{ route('admin.orders.show', ['order' => $order->id])}}" class="btn btn-primary btn-block mt-4">Ver Orden</a>
						</div>
					</div>
			</div>
		</div>
	@endforeach

	{{ $orders->links()}}
@else
	<h3 class="text-center title text-danger">No hay ordenes disponibles.</h3>
@endif
</div>
@endsection