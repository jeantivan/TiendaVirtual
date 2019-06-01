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
			<form action="{{ route('admin.products.store')}}" enctype="multipart/form-data"  method="POST" class="was-validate">
				@csrf
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="name" class="form-label">Nombre de Producto:</label>
						<input type="text" id="name" name="name" placeholder="Camiseta Marca..." maxlength="80" required autofocus class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}">
						@if ($errors->has('name'))
						    <span class="invalid-feedback" role="alert">
						        <strong>{{ $errors->first('name') }}</strong>
						    </span>
						@endif
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="price" class="form-label">Precio:</label>
						<input type="number" min="0" step="0.01" id="price" name="price"  placeholder="45.32 Bs" required class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price') }}">
						@if ($errors->has('price'))
						    <span class="invalid-feedback" role="alert">
						        <strong>{{ $errors->first('price') }}</strong>
						    </span>
						@endif
					</div>
					<div class="form-group col-md-6">
						<label for="stock" class="form-label">Stock:</label>
						<input type="number" min="1" id="stock" name="stock" class="form-control {{ $errors->has('stock') ? ' is-invalid' : '' }}" value="{{ old('stock') }}" placeholder="Cantidad disponible" required>
						@if ($errors->has('stock'))
						    <span class="invalid-feedback" role="alert">
						        <strong>{{ $errors->first('stock') }}</strong>
						    </span>
						@endif
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="description" class="form-label">Descripción:</label>
						<textarea name="description" id="description" rows="5" maxlength="5000" class="form-control my-2 {{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('description') }}" placeholder="Descripción del producto..." required></textarea>
						@if ($errors->has('description'))
						    <span class="invalid-feedback" role="alert">
						        <strong>{{ $errors->first('description') }}</strong>
						    </span>
						@endif
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12">
						<label for="categories" class="form-label">Categorias:</label>
					</div>
					<div class="form-group col-md-12">
					@foreach($categories as $category)
						<div class="custom-control custom-checkbox custom-control-inline">
						  <input type="checkbox" class="custom-control-input {{ $errors->has('categories') ? ' is-invalid' : '' }}" name="categories[]" id="{{$category->name}}" value="{{$category->name}}">
						  <label class="custom-control-label" for="{{$category->name}}">{{$category->name}}</label>
						</div>
						@if ($errors->has('categories'))
						    <span class="invalid-feedback" role="alert">
						        <strong>Debes seleccionar al menos una categoría</strong>
						    </span>
						@endif
					@endforeach
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<div class="custom-file">
	      					<input type="file" name="images[]" class="custom-file-input {{ $errors->has('images') ? ' is-invalid' : '' }}" id="images" multiple required>
	      					<label class="custom-file-label" for="images" data-browse="Examinar">Selecione una o varias imagenes</label>
	    				</div>
	    				@if ($errors->has('images'))
						    <span class="invalid-feedback" role="alert">
						        <strong>{{ $errors->get('images.*') }}</strong>
						    </span>
						@endif
	    			</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
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
