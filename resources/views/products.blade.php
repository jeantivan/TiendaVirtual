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
                    <a href="#" class="card-link">
                        <h4 class="card-title">{{ $product->name }}</h4>
                    </a>
                    <p class="card-text">{{ $product->description}}</p>
                    <h5>Precio: <span class="badge badge-dark p-2">{{ $product->price }} $</span></h5>
                </div>
                <div class="card-footer">
                    @if(!$product->in_stock)
                        <button class="btn btn-secondary disable float-right">No disponible</button>
                    @else
                        <button class="btn btn-warning float-right" onclick="addToCart({{ $product->id }})">Añadir al carrito</button>
                    @endif
                </div>
            </div>
        @endforeach
        {{$products->links()}}
    </div>
</div>
<script type="text/javascript">
    function addToCart(id){
        jQuery.ajax({
            headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/carts',
            type: 'POST',
            data: {
                product_id: id,
                '_token': $("meta[name='csrf-token']").attr("content"),
            },
        })
        .done(function() {
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }
</script>
@endsection