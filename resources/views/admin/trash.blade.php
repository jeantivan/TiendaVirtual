@extends('layouts.admin')

@section('content')
<div class="container-fluid my-3">

	<h1 id="title" class="title">Papelera.</h1>
	<div class="mt-2">
		<form action="{{route('admin.products.trash')}}" method="GET" class="form-inline">
			<div class="input-group">
				<input type="text" name="search" class="form-control" placeholder="Nombre del Producto...">
				<div class="input-group-append">
					<button class="btn btn-info" type="submit">
						Buscar <i class="fas fa-search"></i>
            		</button>
				</div>	
			</div>      
        </form>
	</div>
	<hr>
	<div class="d-flex flex-row flex-wrap mb-3">
	@foreach($products as $product)
		<div class="card shadow-sm mb-3 mx-sm-auto">
			<img src="{{ Storage::url($product->images()->first()->path) }}" class="card-img-top d-block img-fluid" style="width: 100%;">
			<div class="card-body">
				<h3 class="card-title">{{ $product->name }}</h3>
				<p class="card-text">{{ substr($product->description, 0, 90)}}...</p>
			</div>
			<div class="card-footer">
				<form>
					<button class="btn btn-danger btn-block">
						Restaurar <i class="fas fa-restore"></i>
					</button>
				</form>
			</div>
		</div>
	@endforeach
	</div>
</div>
@endsection