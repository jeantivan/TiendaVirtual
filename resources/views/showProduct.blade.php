@extends('layouts.app')

@section('content')
<div class="container-fluid my-3">
	<div class="clearfix">
		<h1 class="title float-left">{{ $product->name }}</h1>
		<a href="{{route('products.index')}}" class="btn btn-danger float-right">Volver a la Tienda</a>
	</div>
	<hr>
	<div class="row py-2">
		<div class="col-md-6">
			<div id="images" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					@foreach($product->images as $image)
						<div class="carousel-item {{$loop->first ? 'active':''}}" style="max-height: 450px;">
							<img src="{{Storage::url($image->path)}}" class="d-block w-50 mx-auto" >
						</div>
					@endforeach
					<a class="carousel-control-prev" href="#images" role="button" data-slide="prev">
    					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
  					</a>
					<a class="carousel-control-next" href="#images" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="container">
				<h2 class="h2 title">Detalles del Producto</h2>
				<hr>
				<h4 class="py-2">
					ID del Producto: <span class="badge badge-dark shadow">#{{$product->id}}</span>
				</h4>
				<h4 class="py-2">
					Precio Unitario: <span class="badge badge-success shadow">{{$product->price}} Bs</span>
				</h4>
				@if($product->in_stock)
					<h4 class="py-2">
						Producto:
						<span class="badge badge-pill badge-info text-light shadow">Disponible</span>
					</h4>
					<h4 class="py-2">
						Cantidad en Stock: <span class="badge badge-info text-light shadow">{{$product->quantity_available}}</span>
					</h4>
				@else
					<h4 class="py-2">
						Producto:
						<span class="badge badge-pill badge-danger shadow">
							Agotado
						</span>
					</h4>
				@endif
				<button 
					class="btn btn-lg btn-warning float-md-right shadow add" 
					data-id="{{$product->id}}" 
					{{$product->in_stock && Auth::check()?:'disabled'}}>
					Añadir al carrito <i class="fas fa-cart-plus"></i>
				</button>
			</div>
		</div>
	</div>
	<div class="row my-3">
		<div class="col-xl-12">
			<h2 class="h2 title">Descripción</h2>
			<hr>
			<div class="h5 text-justify">
				{{$product->description}}
			</div>
		</div>
	</div>

	<div class="row my-3 w-100">
		<div class="col-xl-12">
			<h2 class="h2 title">Categorias</h2>
			<hr>
			<div class="d-flex flex-row flex-wrap" id="categories">
				@if(count($product->categories))
					@foreach($product->categories as $category)
						<a href="#" class="btn btn-lg btn-outline-danger mx-2">{{$category->name}}</a>
					@endforeach	
				@else
					<p class="title h5 text-danger">El producto todavía no tiene una categoría asignada.</p>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection