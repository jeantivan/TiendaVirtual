@extends('layouts.admin')

@section('content')
<div class="container-fluid my-4">
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
					<button class="btn btn-primary" type="submit">
						Buscar <i class="fas fa-search"></i>
            		</button>
				</div>	
			</div>      
        </form>
	</div>
	<hr>
	<div class="d-flex flex-row flex-wrap justify-content-between">
		@foreach($products as $product)
			<div class="card shadow-sm mb-3" style="width: 48%;">
				<img src="{{ Storage::url($product->images()->first()->path) }}" class="card-img-top" style="max-height: 50% !important;">
				<div class="card-body">
					<a href="{{route('admin.products.show', ['product' => $product->id])}}" class="card-link">
						<h3 class="card-title">{{ $product->name }}</h3>
					</a>
					<p class="card-text">{{ $product->description }}</p>
					<h5>Precio: <span class="badge badge-dark p-2">{{ $product->price}} $</span></h5>
					@if($product->in_stock)
						<h5>
							Cantidad disponible: <span class="badge badge-primary p-2">{{ $product->quantity_available }}</span>
						</h5>
					@else
						<h5>
							<span class="badge badge-dark p-2">Agotado</span>
						</h5>
					@endif
				</div>
				<div class="card-footer">
					<p>
						Creado el: {{ $product->created_at }}
					</p>
					<p>
						Ultima actualización: {{ $product->updated_at }}
					</p>
				</div>
			</div>
		@endforeach
	</div>
	<div class="d-flex justify-content-center">
		{{ $products->links() }}
	</div>
</div>
@endsection