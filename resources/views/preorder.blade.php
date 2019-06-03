@extends("layouts.app")

@section('content')
<div class="container-fluid my-3">
	<div class="clearfix">
		<h1 class="title float-left">Carrito de Compras</h1>
		<a class="btn btn-danger float-right" href="{{ route('products.index')}}">Volver a la tienda</a>
	</div>
	<hr>
	<div class="container">
		<div class="container">
			<h3 class="my-2 text-center">
				<strong>Por favor verifique que los datos de su compra sean correctos y continue.</strong>
			</h3>
		</div>
		<table class="table table-sm table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>Imagen</th>
					<th>Nombre del Producto</th>
					<th>Cantidad</th>
					<th>Precio</th>
					<th>SubTotal</th>
				</tr>
			</thead>
			<tbody>
			@foreach($products as $product)
				@php
					// Se obtiene la primera imagen del producto
        			$image = $product->images()->first()->path;
    			@endphp
				<tr>
					<td class="text-center">
						<img src="{{Storage::url($image)}}" class="rounded" width="80">
					</td>
					<td class="text-center h5 align-middle">
						<strong>{{$product->name}}</strong>
					</td>
					<td class="text-center h5 align-middle">
						<strong>{{$product->qty}}</strong>
					</td>
					<td class="text-center h5 align-middle">
						<strong>{{$product->price}} Bs</strong>
					</td>
					<td class="text-center h5 align-middle">
						<strong>{{ $product->price * $product->qty}} Bs</strong>
					</td>
				</tr>
			@endforeach
				<tr>
					<td colspan="4" class="p-2 h5 text-right">
						<strong>Total + IVA (12%)</strong>
					</td>
					<td class="text-center h5 p-2">
						<strong>{{$total}} Bs</strong>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="clearfix">
			<div class="float-right">
				<a href="#order" data-toggle="modal" class="btn btn-success ml-2">Continuar</a>
				<a href="{{route('users.carts.index')}}" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="order">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			
        <div class="modal-header bg-dark">
        	<h4 class="modal-title title text-white">Procesar Orden</h4>
        	<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        <form action="{{route('users.orders.store')}}" method="POST" id="orderForm">
        	@csrf
        <div class="modal-body">

        	<div class="container justify-content-center">
        		<h5 class="text-center mt-2">Ingrese la dirección donde serán enviados los productos de su compra.</h5>
        		
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
	        		
	        	@foreach($products as $product)
					<input type="hidden" name="ids[]" value="{{$product->id}}">
					<input type="hidden" name="qtys[]" value="{{$product->qty}}">
	        	@endforeach
	        		<input type="hidden" name="total" value="{{$total}}">
        		
        	</div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        	<button class="btn btn-success" name="enviar" type="submit">Enviar</button>
        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
		</form>	
		</div>
	</div>
</div>
@endsection