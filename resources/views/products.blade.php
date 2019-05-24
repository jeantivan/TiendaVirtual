@extends("layouts.app")

@section("content")
<div class="container-fluid my-3">
    <div class="row align-content-center">
        <div class="col-md-7">
            <h1 class="mt-3 mb-2 title">Productos</h1>
        </div>
        <div class="col-md-5 ml-auto">
            <form action="{{route('products.index')}}" method="GET" class="form-inline">
                <input type="text" name="s" class="form-control mt-3 mb-2 mx-2" placeholder="Nombre del Producto...">
                <button class="btn btn-primary mt-3 mb-2" type="submit">
                    Buscar <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    <hr>
    <div class="d-flex flex-row flex-wrap mb-3">
        @foreach($products as $product)
            <div class="card shadow-sm my-3 mx-2" style="width: 30%;">
                <img src="{{ $product->images()->first()->path }}" class="card-img-top">
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
                    @if(!$product->in_stock)
                        <button class="btn btn-secondary disable float-right" disabled>No disponible</button>
                    @else
                        <button class="btn btn-warning float-right add" data-id="{{ $product->id}}" {{Auth::check()?:'disabled'}}>
                            Añadir al carrito <i class="fas fa-cart-plus"></i>
                        </button>
                    @endif
                </div>
            </div>
        @endforeach  
    </div>
    <div class="container">
        {{$products->links()}}
    </div>
</div>
@endsection