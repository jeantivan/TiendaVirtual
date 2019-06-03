@extends('layouts.admin')

@section('content')
<div class="container mt-3">
	<h1 class="title">{{ $product->name }}</h1>
	<hr>
	<div class="row py-2">
		<div class="col-12 my-2">
			<h2 class="title">Imagenes.</h2>
			<hr>
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
		<div class="col-12 my-2">
			<h2 class="title">Detalles.</h2>
			<hr>
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<h5>
						<strong>ID del Producto:</strong> <span class="badge badge-dark shadow">#{{$product->id}}</span>
					</h5>
					<h5>
						<strong>Precio Unitario:</strong> <span class="badge badge-success shadow">{{$product->price}} Bs</span>
					</h5>
				@if($product->in_stock)
					<h5>
						<strong>Producto:</strong>
						<span class="badge badge-info text-light shadow">Disponible</span>
					</h5>
				@else
					<h5>
						<stong>Producto:</stong>
						<span class="badge badge-danger shadow">
							Agotado
						</span>
					</h5>
				@endif
					<h5>
						<strong>Cantidad en Stock:</strong> <span class="badge badge-info text-light shadow">{{$product->quantity_available}}</span>
					</h5>
					<h5>
						<strong>Creado en:</strong> <i>{{$product->created_at}}</i>
					</h5>
					<h5>
						<strong>Última actualización:</strong> <i>{{$product->updated_at}}</i>
					</h5>
				</div>
				<div class="col-md-6 col-sm-12">
					<h4><strong>Opciones:</strong></h4>
					<button type="button" class="btn btn-warning my-2 shadow" data-toggle="modal" data-target="#edit">Editar Producto <i class="fas fa-edit"></i>
					</button>
				@if(!$product->trashed())
					<form action="{{route('admin.products.totrash', ['product' => $product->id])}}" method="POST" class="form-inline">
						@csrf
						<button class="btn btn-danger shadow my-2" type="submit">Enviar a la Palera <i class="fas fa-trash"></i>
						</button>
					</form>
				@else
					<button class="btn btn-danger shadow my-2" >Restaurar <i class="fas fa-restore"></i>
					</button>
				@endif
				</div>
			</div>
		</div>
	</div>
	<div class="row my-3">
		<div class="col-12">
			<h2 class="title">Descripción</h2>
			<hr>
			<div class="h5 text-justify">
				{{$product->description}}
			</div>
		</div>
	</div>

	<div class="row my-3">
		<div class="col-12">
			<h2 class="title">Categorias.</h2>
			<hr>
			<div class="d-flex flex-row flex-wrap" id="categories">
				@if(count($product->categories))
					@foreach($product->categories as $category)
						<p class="h3 ml-2"><span class="badge badge-pill badge-primary">
							{{$category->name}}
						</span></p>
					@endforeach	
				@else
					<p class="title h5 text-danger">El producto todavía no tiene una categoría asignada.</p>
				@endif
			</div>
		</div>
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