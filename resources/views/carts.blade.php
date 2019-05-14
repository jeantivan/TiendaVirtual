@extends("layouts.app")

@section('content')
<div class="container my-5">
	<h1 class="title">Carrito de Compras</h1>
	<hr>
	@isset($carts)
		@foreach($carts as $cart)
			{{ $cart->product_id }} <br>
		@endforeach
	@else
		<h2 class="display-2">No hay Productos en el Carrito</h2>
	@endisset
</div>
@endsection