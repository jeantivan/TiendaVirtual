@extends('layouts.admin')

@section('content')
<div class="container-fluid my-3">
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
	<div class="row">
	@foreach($products as $product)
		<div class="col-xl-4 col-md-6 col-sm-8">
			<div class="card shadow-sm mb-3 mx-sm-auto">
				<img src="{{ Storage::url($product->images()->first()->path) }}" class="card-img-top d-block img-fluid" style="width: 100%;">
				<div class="card-body">
					<a href="{{route('admin.products.show', ['product' => $product->id])}}" class="card-link">
						<h3 class="card-title">{{ $product->name }}</h3>
					</a>
					<p class="card-text">{{ substr($product->description, 0, 200)}}...</p>
					<h5>Precio: <span class="badge badge-success p-2">{{ $product->price}} Bs</span></h5>
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
		</div>
	@endforeach
	</div>
	<div class="d-flex justify-content-center">
		{{ $products->links() }}
	</div>
</div>
@endsection