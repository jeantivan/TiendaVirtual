@extends("layouts.app")

@section('content')
<div class="container-fluid my-3">
	<div class="clearfix">
		<h1 class="title float-left">Mis Compras.</h1>
		<a class="btn btn-danger float-right" href="{{ route('products.index')}}">Volver a la tienda</a>
	</div>
	<hr>
@if(count($orders))
	@foreach($orders as $order)
		<div class="card shadow my-3">
			<div class="card-header clearfix">
				<div class="float-left h3 m-0">
					Compra <span class="text-info">#{{$order->id}}</span>
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
						<p class="h4 text-md-left">
							{{$order->shipping_address}}
						</p>
					</div>
					<div class="col-md-3">
						<h5><strong>Total:</strong></h5> 
						<p class="h4">
							<span class="badge badge-success">
								{{$order->total}} Bs
							</span>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
					@if($order->status === 'Esperando Pago')
						<a href="{{route('users.payments.payment', ['order' => $order->id])}}" class="btn btn-success btn-block my-2">Pagar</a>
					@else
						<a href="{{route('users.payments.payment', ['order' => $order->id])}}" class="btn btn-success btn-block my-2 disabled">Pagar</a>
					@endif
					</div>
					<div class="col-md-4">
						<a href="{{route('users.orders.invoice', ['id' => $order->id])}}" class="btn btn-block btn-primary my-2" target="_blank">Ver Factura</a>
					</div>
					<div class="col-md-4">
					@if($order->status === 'Pago Verificado' || $order->status === 'Enviada')
						<a href="#change-address" data-toggle="modal" class="btn btn-warning btn-block mt-1 mb-2 disabled">Cambiar Dirección</a>
					@else
						<a href="#change-address" data-toggle="modal" class="btn btn-warning btn-block mt-1 mb-2">Cambiar Dirección</a>
					@endif
					</div>
				</div>
			</div>
		</div>
	@endforeach
@else
	<h3 class="text-danger">Usted todavía no tiene compras registradas.</h3>
@endif
</div>

{{-- Ventana Modal para cambiar la dirección --}}
<div class="modal fade" id="change-address">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			
        <div class="modal-header bg-dark">
        	<h4 class="modal-title title text-white">Cambiar Dirección de envio.</h4>
        	<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">

        	<div class="container justify-content-center">
        		<h5 class="text-center mt-2">Ingrese la nueva dirección donde serán enviados los productos de su compra.</h5>
        		<form action="{{route('users.orders.update', ['order' => $order->id])}}" method="POST" id="orderForm">
        			@csrf
        			@method('PUT')
	        		<div class="row form-group">
	        			<label for="address" class="col-md-4 col-form-label text-md-right">Direccion de Envio:</label>
	        			<div class="col-md-8">
	        				<input type="text" name="address" id="address"class="form-control" placeholder="Alguna dirección..." {!!isset($addresses)?"list='address-list'": ""!!} required>
	        			</div>
	        		</div>
	        	@isset($addresses)
	        		<datalist id="address-list">

	        		@foreach($addresses as $address)
						<option>{{$address->address}}</option>
	        		@endforeach

	        		</datalist>
	        	@endisset
	        		<div class="form-group row justify-content-center">
	        			<div class="col-md-auto custom-control custom-checkbox">
	        				<input type="checkbox" class="custom-control-input" name="save" id="save" value="1">
	        				<label for="save" class="custom-control-label">Desea guardar esta dirección de Envio</label>
	        			</div>
	        		</div>
        		</form>
        	</div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        	<button class="btn btn-success" name="enviar"onclick="event.preventDefault(); $('#orderForm').submit();">Enviar</button>
        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
			
		</div>
	</div>
</div>
	
@if(session('message'))
<div class="alert alert-success fade show alert-dismissible fixed-top" style="z-index: 1080;">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>{{ session('message') }}</strong>
</div>
@endif
@endsection
