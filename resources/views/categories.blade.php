@extends("layouts.app")

@section("content")
<div class="container-fluid my-3">
    <div class="row justify-content-center">
        <div class="col-md-11 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header bg-mostaza">
                    <h1 class="title text-oscuro">Categorias.</h1>
                </div>
                <div class="card-body row">
                @foreach($categories as $category)
                    <div class="col-xl-3 col-lg-4 col-sm-6 mb-3">
                        
                        <a href="{{route('categories.show', ['category' => $category->name])}}">
                            <div class="border border-dark rounded-lg p-1 bg-light clearfix">
                                <div class="float-left h5 m-0">
                                    {{$category->name}}
                                </div>
                                <div class="float-right h5 m-0">
                                    <span class="badge badge-pill badge-info text-white">
                                        {{ count($category->products)}}
                                    </span>
                                </div>
                            </div>
                        </a>
                    
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection