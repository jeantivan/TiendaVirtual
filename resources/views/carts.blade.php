@extends("layouts.app")

@section('content')
<div class="container-fluid my-3">
	<div class="clearfix">
		<h1 class="title float-left">Carrito de Compras</h1>
		<a class="btn btn-danger float-right" href="{{ route('products.index')}}">Volver a la tienda</a>
	</div>
	<hr>
	@if(count($carts))
		<table class="table table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>Imagen</th>
					<th>Nombre del Producto</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<form 
					action="{{route('users.preorder')}}" 
					method="POST" 
					id="cartForm">
					@csrf
				@foreach($carts as $cart)
					@php
						// Se obtiene la primera imagen del producto
	        			$image = $cart->product->images()->first()->path;

	        			// El producto
	        			$product = $cart->product;

	    			@endphp
					<tr id="{{$cart->id}}">
						<td>
							<img src="{{Storage::url($image)}}" class="rounded" width="100">
						</td>
						<td class="align-middle">
							{{$product->name}}
						</td>
						<td class="align-middle">
							{{$product->price}} Bs
						</td>
						<td class="align-middle">
							<input 
								type="hidden" 
								name="ids[]"
								value="{{$product->id}}">
							<input 
								type="number" 
								name="qtys[][qty]" 
								value="1"
								min="1" 
								max="{{$product->quantity_available}}" class="form-control"
								required>
						</td>
						<td class="align-middle">
							<button class="btn btn-danger delete" data-id="{{$cart->id}}">Eliminar del Carrito</button>
						</td>
					</tr>
				@endforeach
				</form>
			</tbody>
		</table>

		<button 
			class="btn btn-success float-right my-2"
			onclick="event.preventDefault(); $('#cartForm').submit();">
			Procesar Orden
		</button>
	@else
		<h2 class="display-4 text-danger">
			No hay productos en el carrito.
		</h2>
	@endif
</div>
@endsection