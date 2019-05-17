@extends("layouts.app")

@section("content")
<div class="container rounded mh-100 w-100 bg-light">
    <div class="row align-content-center">
        <div class="col-md-7">
            <h1 class="mt-3 mb-2 title">Productos</h1>
        </div>
        <div class="col-md-5 ml-auto">
            <form action="{{route('products')}}" method="GET" class="form-inline">
                <input type="text" name="s" class="form-control mt-3 mb-2 mx-2" placeholder="Nombre del Producto...">
                <button class="btn btn-primary mt-3 mb-2" type="submit">
                    Buscar <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    <hr>
    <div class="d-flex flex-row flex-wrap" >
        @foreach($products as $product)
            <div class="card shadow-sm my-3 mx-2" style="width: 30%;">
                <img src="{{ $product->images()->first()->path }}" class="card-img-top">
                <div class="card-body">
                    <a href="#" class="card-link">
                        <h4 class="card-title">{{ $product->name }}</h4>
                    </a>
                    <p class="card-text">{{ $product->description}}</p>
                    <h5>Precio: <span class="badge badge-dark p-2">{{ $product->price }} $</span></h5>
                </div>
                <div class="card-footer">
                    @if(!$product->in_stock)
                        <button class="btn btn-secondary disable float-right" disabled>No disponible</button>
                    @else
                        <button class="btn btn-warning float-right add" data-id="{{ $product->id}}">Añadir al carrito</button>
                    @endif
                </div>
            </div>
        @endforeach
        {{$products->links()}}
    </div>
</div>
@endsection