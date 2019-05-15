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
					<tr>
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
							<button id="{{$cart->id}}"class="btn btn-danger" onclick="deleteFromCart(event,{{ $cart->id }})">
								Eliminar del Carrito 
							</button>
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
<script type="text/javascript">
	function deleteFromCart(event, id){
		$('#'+event.target.id).append('<span class="spinner-border spinner-border-sm"></span>')
		$.ajax({
			headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			url: "{{url()->current() .'/'}}"+ id,
			type: 'DELETE',
			success: function(){
				$('#'+event.target.id).remove('.spinner-border');
			},

			error: function (data){
				console.log(data);
			},
		})
		.done(function() {
			alert('Producto eliminado con éxito.')
			location.reload();
			console.log("success");
		})
		.fail(function() {
			alert('No se pudo eliminar el producto del Carrito.')
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	}
</script>
@endsection