@extends('layouts.admin')

@section('content')
<div class="container-fluid my-4">
	<div class="clearfix">
		<div class="float-left">
			<h1 id="title" class="title">Productos Disponibles</h1>
		</div>
		<div class="float-right">
			<a href="#" class="btn btn-primary btn-block">Agregar Producto Nuevo</a>
		</div>	
	</div>
	<div class="row">
		<div class="col-9">
			@foreach($products as $product)
				@php
					$image = $product->images()->where('product_id', $product->id)->get();
					$path = $image->first()->path;
				@endphp
				<div class="card m-3">
					<img src="{{ $path }}" class="card-img-top">
					<div class="card-body">
						<h3 class="card-title">{{ $product->name }}</h3>
						<p class="card-text">{{ $product->description }}</p>
						<h5>Precio: <span class="badge badge-dark p-2">{{ $product->price}} $</span></h5>
						@if($product->in_stock)
							<span class="badge badge-primary p-2">Disponible</span>
						@else
							<span class="badge badge-dark p-2 float-right">Agotado</span>
						@endif
					</div>
				</div>
			@endforeach
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-12">
			{{ $products->links() }}
		</div>
	</div>
</div>
@endsection