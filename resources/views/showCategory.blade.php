@extends("layouts.app")

@section("content")
<div class="container-fluid my-3">
    <div class="row clearfix">
        <div class="col-md-8 col-sm-12 float-left d-sm-block">
            <h1 class="title d-inline">Productos</h1>
            <p class="h5 d-inline"><i>categoría: {{ $category->name}}</i></p>
        </div>
        <div class="col-md-4 col-sm-12 float-md-right float-sm-left">
            <form action="{{route('products.index')}}" method="GET" class="form-inline">
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
    </div>
    <hr>
@if($category->products()->count())
    <div class="row">
        @foreach($category->products as $product)
            <div class="col-xl-3 col-md-4 col-sm-12 mb-3">
                <div class="card shadow-sm mb-3 mx-2" style="height: 100%;">
                    <img src="{{ Storage::url($product->images()->first()->path) }}" class="card-img-top">
                    <div class="card-body">
                        <a href="{{ route('products.show', ['product' => $product->id])}}" class="card-link">
                            <h4 class="card-title">{{ $product->name }}</h4>
                        </a>
                        <p class="card-text">
                            {{ substr($product->description, 0, 100)}}...
                        </p>
                        <h5>Precio: <span class="badge badge-success p-2">{{ $product->price }} Bs</span></h5>
                    </div>
                    <div class="card-footer">
                    @auth
                        @if(!$product->in_stock)
                            <button class="btn btn-secondary disable float-right" disabled>No disponible</button>
                        @else
                            <button class="btn btn-warning float-right add" data-id="{{ $product->id}}" {{Auth::check()?:'disabled'}}>
                                Añadir al carrito <i class="fas fa-cart-plus"></i>
                            </button>
                        @endif
                    @else
                        <a class="btn btn-secondary float-right" href="{{route('register')}}" data-toggle="tooltip" title="Para agregar este producto al carrito">Registrate</a>
                    @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center">
        <h3 class="title text-danger">
            Todavía no existen productos en esta categoría.
        </h3>
    </div>
@endif
</div>
@endsection