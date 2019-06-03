@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-3">
	<h1 id="title" class="title">Papelera.</h1>
	<hr>
@if(count($products))
	<div class="d-flex flex-row flex-wrap mb-3">
	@foreach($products as $product)
		<div class="card shadow-sm mb-3 mx-2" style="width: 30%">
			<img src="{{ Storage::url($product->images()->first()->path) }}" class="card-img-top d-block">
			<div class="card-body">
				<h3 class="card-text">{{ $product->name }}</h3>
				<p class="card-text">{{ substr($product->description, 0, 90)}}...</p>
			</div>
			<div class="card-footer">
				<form method="POST" action="{{route('admin.products.restore', ['id' => $product->id])}}">
					@csrf
					<button class="btn btn-warning btn-block my-2" data-toggle="tooltip" data-placement="top" title="Sacar de la papelera." type="submit">
						Restaurar <i class="fas fa-trash-restore"></i>
					</button>
				</form>
				<form method="POST" action="{{route('admin.products.destroy', ['product' => $product->id])}}">
					@csrf
					@method('DELETE')
					<button class="btn btn-danger btn-block my-2" data-toggle="tooltip" data-placement="bottom" title="Eliminar definitivo" type="submit">
						Eliminar <i class="fas fa-ban"></i>
					</button>
				</form>
			</div>
		</div>
	@endforeach
	</div>
@else
	<h3 class="text-center text-danger title">No hay productos en la papelera.</h3>
@endif
@if(session('message'))
<div class="alert alert-success fade show alert-dismissible fixed-top" style="z-index: 1080;">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>{{ session('message') }}</strong>
</div>
@endif
@endsection