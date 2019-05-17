@extends('layouts.admin')

@section('content')
<div class="container my-4">
	<div class="clearfix">
		<h1 id="title" class="title float-left">{{$product->name}}</h1>
		<button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#edit">
			Editar Producto
		</button>
	</div>
	<hr>
	<div class="container">
		<h2 class="title">Imagenes.</h2>
		<hr>
		@foreach($product->images as $image)
			<img src="{{ Storage::url($image->path) }}" class="mr-3 my-2 border border-1" width="200">
		@endforeach
	</div>
	<hr>
	<div class="container">
		<h2 class="title">Detalles.</h2>
		<hr>
		<p class="h4">Nombre del producto: {{ $product->name }}</p>
		<p class="h4">Precio del producto: <span class="badge badge-dark">{{ $product->price }} $</span></p>
		<p class="h4">Cantidad Disponible: <span class="badge badge-primary">{{ $product->quantity_available }}</span></p>
		<p class="h4">Creado el: {{ $product->created_at }}</p>
		<p class="h4">Ultima actualización: {{ $product->updated_at }}</p>
	</div>
	<hr>
	<div class="container">
		<h2 class="title">Categorias.</h2>
		@foreach($product->categories as $category)
			<p class="h4 ml-2"><span class="badge badge-pill badge-primary">
				{{$category->name}}
			</span></p>
		@endforeach
	</div>
</div>
<div class="modal fade" id="edit">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

			<!-- Header de la ventana Modal -->
			<div class="modal-header">
				<h2 class="modal-title title">Editar Producto</h2>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form action="{{ route('admin.products.update', ['product' => $product->id])}}" method="POST">
				@method('PUT')
				@csrf
				<!-- Body de la ventana Modal -->
				<div class="modal-body">
					<div class="row justify-content-center">
						<div class="col-md-3">
							<label for="name" class="form-label my-2">Nombre de Producto:</label>
						</div>
						<div class="col-md-7">
							<input type="text" id="name" name="name" class="form-control form-control-sm my-2"  maxlength="80" value="{{$product->name}}">
						</div>
					</div><br>
					<div class="row  justify-content-center">
						<div class="col-md-3">
							<label for="price" class="form-label my-2">Precio:</label>
						</div>
						<div class="col-md-7">
							<input type="number" min="0" step="0.01" id="price" name="price" class="form-control form-control-sm my-2" value="{{$product->price}}">
						</div>
					</div><br>
					<div class="row  justify-content-center">
						<div class="col-md-3">
							<label for="stock" class="form-label my-2">Stock:</label>
						</div>
						<div class="col-md-7">
							<input type="number" min="0" id="stock" name="stock" class="form-control form-control-sm my-2" value="{{$product->quantity_available}}">
						</div>
					</div><br>
					<div class="row  justify-content-center">
						<div class="col-md-3">
							<label for="description" class="form-label my-2">Descripción:</label>
						</div>
						<div class="col-md-7">
							<textarea name="description" id="description" rows="5" maxlength="190" class="form-control my-2" required>{{$product->description}}</textarea>
						</div>
					</div>
				</div>
				
				<!-- Footer de la ventana Modal -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">
						Actualizar
					</button>
		    		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		  		</div>
      		</form>	
		</div>
	</div>
</div>
@if(session('message'))

	<div class="alert alert-success fade show alert-dismissible fixed-top">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>{{ session('message') }}</strong>
	</div>
@endif
@endsection