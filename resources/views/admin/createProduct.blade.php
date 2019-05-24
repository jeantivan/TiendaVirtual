@extends('layouts.admin')

@section('content')
<div class="container-fluid my-3">
	<div class="card shadow-sm">
		<div class="card-header bg-dark text-white">
			<div class="row">
				<div class="col-2 mt-2">
					<a href="{{route('admin.products.index')}}" class="btn btn-danger mr-auto">Volver</a>
				</div>
				<div class="col-8 mt-2 text-center">
					<h1 class="card-title title">Agregar Producto</h1>
				</div>	
			</div>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.products.store')}}" enctype="multipart/form-data"  method="POST" class="px-3">
				@csrf
				<div class="row justify-content-center">
					<div class="col-md-3">
						<label for="name" class="form-label my-2">Nombre de Producto:</label>
					</div>
					<div class="col-md-7">
						<input type="text" id="name" name="name" class="form-control form-control-sm my-2" placeholder="Camiseta" maxlength="80" required>
					</div>
				</div><br>
				<div class="row  justify-content-center">
					<div class="col-md-3">
						<label for="price" class="form-label my-2">Precio:</label>
					</div>
					<div class="col-md-7">
						<input type="number" min="0" step="0.01" id="price" name="price" class="form-control form-control-sm my-2" placeholder="45.32 Bs" required>
					</div>
				</div><br>
				<div class="row  justify-content-center">
					<div class="col-md-3">
						<label for="stock" class="form-label my-2">Stock:</label>
					</div>
					<div class="col-md-7">
						<input type="number" min="1" id="stock" name="stock" class="form-control form-control-sm my-2" placeholder="Cantidad disponible" required>
					</div>
				</div><br>
				<div class="row  justify-content-center">
					<div class="col-md-3">
						<label for="description" class="form-label my-2">Descripción:</label>
					</div>
					<div class="col-md-7">
						<textarea name="description" id="description" rows="5" maxlength="5000" class="form-control my-2" placeholder="Descripción del producto..." required></textarea>
					</div>
				</div><br>
				<div class="row  justify-content-center">
					<div class="col-md-3">
						<label for="categories" class="form-label my-2">Categorias:</label>
					</div>
					<div class="col-md-7">
					@foreach($categories as $category)
						<div class="custom-control custom-checkbox custom-control-inline">
						  <input type="checkbox" class="custom-control-input" name="categories[]" id="{{$category->name}}" value="{{$category->name}}">
						  <label class="custom-control-label" for="{{$category->name}}">{{$category->name}}</label>
						</div>
					@endforeach
					</div>
				</div><br>
				<div class="row  justify-content-center">
					<div class="col-md-10">
						<div class="custom-file my-2">
	      					<input type="file" name="images[]" class="custom-file-input" id="images" multiple required>
	      					<label class="custom-file-label" for="images">Selecione una o varias imagenes</label>
	    				</div>
	    			</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-10 my-2">
							<input type="submit" class="btn btn-primary btn-lg btn-block" name="enviar" value="¡Agregar!">				
					</div>	
				</div>
			</form>
		</div>
	</div>
</div>
@if($errors->any())
	<div class="alert alert-danger fade show alert-dismissible fixed-top">	
		@foreach($errors->all() as $error)
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>{{ $error }}</strong>
		@endforeach	
	</div>
@endif
@endsection
