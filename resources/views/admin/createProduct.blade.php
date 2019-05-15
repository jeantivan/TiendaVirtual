@extends('layouts.admin')

@section('content')
<div class="container my-4">
	<div class="card shadow-sm">
		<div class="card-header bg-dark text-white">
			<div class="row">
				<div class="col-sm-2 mt-2">
					<a href="{{route('admin.products.index')}}" class="btn btn-danger mr-auto">Volver</a>
				</div>
				<div class="col-sm-10 mt-2 text-center">
					<h1 class="card-title title">Agregar Producto</h1>
				</div>
				
			</div>
		</div>
		<div class="card-body">
			<form action="#" enctype="multipart/form-data"  method="POST" class="px-3">
				@csrf
				<div class="row justify-content-center">
					<div class="col-md-3">
						<label for="nombre" class="form-label my-2">Nombre de Producto:</label>
					</div>
					<div class="col-md-7">
						<input type="text" id="nombre" name="nombre" class="form-control form-control-sm my-2" placeholder="Camiseta">
					</div>
				</div><br>
				<div class="row  justify-content-center">
					<div class="col-md-3">
						<label for="precio" class="form-label my-2">Precio:</label>
					</div>
					<div class="col-md-7">
						<input type="number" min="0" step="0.01" id="precio" name="precio" class="form-control form-control-sm my-2" placeholder="45.32">
					</div>
				</div><br>
				<div class="row  justify-content-center">
					<div class="col-md-3">
						<label for="stock" class="form-label my-2">Stock:</label>
					</div>
					<div class="col-md-7">
						<input type="number" min="0" id="stock" name="stock" class="form-control form-control-sm my-2" placeholder="Cantidad disponible">
					</div>
				</div><br>
				<div class="row  justify-content-center">
					<div class="col-md-3">
						<label for="descripcion" class="form-label my-2">Descripción:</label>
					</div>
					<div class="col-md-7">
						<textarea name="descripcion" id="descripcion" rows="5" maxlength="190" class="form-control my-2" placeholder="Descripción del producto..."></textarea>
					</div>
				</div><br>
				<div class="row  justify-content-center">
					<div class="col-md-10">
						<div class="custom-file my-2">
	      					<input type="file" name="imagen" class="custom-file-input" id="imagen" >
	      					<label class="custom-file-label" for="imagen">Selecione una imagen</label>
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
	<div class="alert alert-warning fade show alert-dismissible fixed-top">	
		@foreach($errors->all() as $error)
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{ $error }}
		@endforeach	
	</div>
@endif
@endsection
