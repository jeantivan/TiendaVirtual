@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-3">
	<h1 class="title">Orden <span class="text-info">#{{ $order->id }}</span></h1>
	<hr>
	<div class="card shadow-sm">
		<div class="card-header h2">Detalles de la orden.</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-7">
					<h4 class="mb-3">
						<strong>Estado de la orden:</strong>

					@switch($order->status)
						@case('Esperando Pago')
							<span class="badge badge-danger">{{$order->status}}</span>
							@break
						@case('Confirmando Pago')
							<span class="badge badge-warning">{{$order->status}}</span>
							@break
						@case('Pago Verificado')
							<span class="badge badge-info text-white">{{$order->status}}</span>
							@break
						@case('Enviada')
							<span class="badge badge-success">{{$order->status}}</span>
							@break
					@endswitch
					</h4>
					<h4 class="mb-3">
						<strong>Monto total:</strong>
						<span class="badge badge-success">{{$order->total}} $</span>
					</h4>
					<h4 class="mb-2"><strong>Dirección de envio:</strong></h4>
					<p class="text-secondary h4">{{$order->shipping_address}}</p>
				</div>
				<div class="col-md-5">
					<h4 class="mb-3"><strong>Cliente:</strong> {{$order->user->name . " " . $order->user->last_name}}</h4>
					<h4 class="mb-3"><strong>Correo:</strong> {{$order->user->email}}</h4>
					<h4 class="mb-3"><strong>Teléfono:</strong> {{$order->user->phone_number}}</h4>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-12">
					<p class="h3 title text-center">Productos de la Orden</p>
					<table class="table table-striped table-sm">
						<thead class="thead-dark text-center">
							<th>ID</th>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Subtotal</th>
						</thead>
						<tbody>
						@foreach($order->orderDetails as $detail)
							<tr class="text-center">
								<td>
									<a href="{{route('admin.products.show', ['product' => $detail->product_id])}}"title="Ver Producto">
										{{$detail->product_id}}
									</a>
								</td>
								<td>{{$detail->product->name}}</td>
								<td>{{$detail->product->price}}</td>
								<td>{{$detail->quantity}}</td>
								<td>{{ $detail->product->price * $detail->quantity}}</td>
							</tr>
						@endforeach	
						</tbody>
					</table>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-12">
				@if($order->status === "Pago Verificado")
					<button class="btn btn-success btn-block" data-order="{{$order->id}}" id="ship">Marcar Orden como Enviada</button>
				@else
					<button class="btn btn-success btn-block disabled" disabled>Marcar Orden como Enviada</button>
				@endif	
				</div>
			</div>
				
		</div>
	</div>
</div>
@endsection