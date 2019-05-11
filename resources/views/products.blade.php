@extends("layouts.app")

@section("content")
<div class="container rounded mh-100 w-100 bg-light">
    <div class="row">
        <div class="col-sm-9">
            <h1 class="pt-3 pb-2 title">Productos</h1>
        </div>
    </div>
    <hr>
    <div class="d-flex flex-row flex-wrap" >
        @foreach($products as $product)
            @php
                $image = $product->images()->where('product_id', $product->id)->get();
                $path = $image->first()->path;
            @endphp
            <div class="card shadow-sm my-3 mx-2" style="width: 30%;">
                <img src="{{ $path }}" class="card-img-top">
                <div class="card-body">
                    <a href="#" class="stretched-link card-link">
                        <h4 class="card-title">{{ $product->name }}</h4>
                    </a>
                    <p class="card-text">{{ $product->description}}</p>
                    <h5>Precio: <span class="badge badge-dark p-2">{{ $product->price }} $</span></h5>
                </div>
                <div class="card-footer">
                    @if(!$product->stock)
                        <button class="btn btn-secondary disable">No disponible</button>
                    @else
                        <form action="/carrito" method="POST">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{$producto->id}}">
                            <input type="number" class="form-control my-2 w-50" name="cantidad" min="1" value="1">
                            <input type="submit" class="btn btn-warning" name="enviar" value="Agregar al Carrito">
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
        {{$products->links()}}
    </div>
</div>
@endsection