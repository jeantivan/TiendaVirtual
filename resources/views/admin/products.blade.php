@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-3">
	<div class="clearfix">
		<div class="float-left">
			<h1 id="title" class="title">Productos Disponibles</h1>
		</div>
		<div class="float-right">
			<a href="{{route('admin.products.create')}}" class="btn btn-primary btn-block">Agregar Producto Nuevo</a>
		</div>	
	</div>
	<div class="mt-2">
		<form action="{{route('admin.products.index')}}" method="GET" class="form-inline">
			<div class="input-group">
				<input type="text" name="s" class="form-control" placeholder="Nombre del Producto...">
				<div class="input-group-append">
					<button class="btn btn-info" type="submit">
						Buscar <i class="fas fa-search"></i>
            		</button>
				</div>	
			</div>      
        </form>
	</div>
	<hr>
@if(count($products))
	<div class="row">
	@foreach($products as $product)
		<div class="col-xl-3 col-md-4 col-sm-12 mb-3">
			<div class="card shadow-sm " style="height: 100%;">
				<img src="{{ Storage::url($product->images()->first()->path) }}" class="card-img-top d-block img-fluid" style="width: 100%;">
				<div class="card-body">
					<a href="{{route('admin.products.show', ['product' => $product->id])}}" class="card-link">
						<h3 class="card-title">{{ $product->name }}</h3>
					</a>
					<p class="card-text">{{ substr($product->description, 0, 90)}}...</p>
					<h5>Precio: <span class="badge badge-success">{{ $product->price}} Bs</span></h5>
					@if($product->in_stock)
						<h5>
							Cant. disponible: <span class="badge badge-primary p-2">{{ $product->quantity_available }}</span>
						</h5>
					@else
						<h5>
							<span class="badge badge-dark">Agotado</span>
						</h5>
					@endif
				</div>
			</div>
		</div>
	@endforeach
	</div>
	<div class="d-flex justify-content-center">
		{{ $products->links() }}
	</div>
@else
	<div class="text-center">
		<h3 class="title text-danger">
			Todavía no existen productos
			<span><a href="{{route('admin.products.create')}}">Crea el primero.</a></span>
		</h3>
	</div>
@endif
</div>
@if(session('message'))
<div class="alert alert-success fade show alert-dismissible fixed-top" style="z-index: 1080;">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>{{ session('message') }}</strong>
</div>
@endif
@endsection