@extends('layouts.admin')

@section('content')
<div class="container-fluid my-3">
	<h1 class="title">Dashboard</h1>
	<hr>

	<div class="container">
		<h2 class="title"><a href="{{ route('admin.products.index')}}">Productos.</a></h2>

		<div class="d-flex flex-row flex-wrap justify-content-between">
			@foreach($products as $product)
				<div class="card shadow-sm" style="width: 32%;">
					<img src="{{ Storage::url($product->images()->first()->path) }}" class="card-img-top d-block" style="max-height: 300px !important;">
					<div class="card-body">
						<a href="{{route('admin.products.show', ['product' => $product->id])}}" class="card-link">
							<h3 class="card-title">{{ $product->name }}</h3>
						</a>
						<p class="card-text">{{ substr($product->description, 0, 100)}}...</p>
						<h5>Precio: <span class="badge badge-success p-2">{{ $product->price}} Bs</span></h5>
						@if($product->in_stock)
							<h5>
								Disponibles: <span class="badge badge-primary p-2">{{ $product->quantity_available }}</span>
							</h5>
						@else
							<h5>
								<span class="badge badge-dark p-2">Agotado</span>
							</h5>
						@endif
					</div>
				</div>
			@endforeach
		</div>
	</div>


</div>
@endsection