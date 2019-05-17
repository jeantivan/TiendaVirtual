@extends("layouts.app")

@section('content')
<div class="container my-4">
	<div class="clearfix">
		<h1 class="title float-left">Carrito de Compras</h1>
		<a class="btn btn-danger float-right" href="{{ route('products')}}">Volver a la tienda</a>
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
				@foreach($products as $product)
					@php
						// Se obtiene la primera imagen del producto
            			$image = $product->images()->where('product_id', $product->id)->get();
            			$path = $image->first()->path;

            			// Se obtiene el id del Carrito que tiene al
            			// actual
            			$cart = $product->carts()
            					->where('user_id', auth()->user()->id)
            					->where('session_key', session()->getId())->first();
        			@endphp
					<tr id="{{$cart->id}}">
						<td>
							<img src="{{$path}}" width="100">
						</td>
						<td class="align-middle">
							{{$product->name}}
						</td>
						<td class="align-middle">
							{{$product->price}}
						</td>
						<td class="align-middle">
							<input type="number" min="1" max="{{$product->quantity_available}}" class="form-control" value="1">
						</td>
						<td class="align-middle">
							<button class="btn btn-danger delete" data-id="{{$cart->id}}">Eliminar del Carrito</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		
	@else
		<h2 class="display-4 text-danger">
			No hay productos en el carrito.
		</h2>
	@endif
</div>
@endsection