@extends('layouts.admin')

@section('content')
<div class="container-fluid my-3">
	<div class="clearfix">
		<h1 id="title" class="title float-left">Categorias</h1>
		<form action="" method="GET" class="form-inline float-right">
			<div class="input-group">
				<input type="text" name="s" class="form-control" placeholder="Nombre del Categoría...">
				<div class="input-group-append">
					<button class="btn btn-info" type="submit">
						Buscar <i class="fas fa-search"></i>
            		</button>
				</div>	
			</div>      
        </form>
	</div>
	<button class="btn btn-primary mt-3" data-toggle="collapse" data-target="#add">
		Crear Categoría
	</button>
	<div id="add" class="collapse my-3">
		<form class="form-group row" id="addCategory">
			<label for="name" class="col-auto col-form-label">Nombre:</label>
			<div class="col-5">
				<div class="input-group">
					<input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Tecnología" required maxlength="30" min="3">
					<div class="input-group-append">
						<button type="submit" class="btn btn-success btn-sm">
							Agregar <i class="fas fa-plus"></i>
	            		</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<hr>
	<div class="d-inline-flex flex-row flex-wrap" id="categories">
		@foreach($categories as $category)
			<button class="btn btn-danger mb-2 mx-2" data-id="{{$category->id}}">{{$category->name}}</button>	
		@endforeach	
	</div>
</div>
@endsection