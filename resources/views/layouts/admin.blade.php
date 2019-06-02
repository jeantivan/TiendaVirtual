<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css" defer>

    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-light">
    <div id="loader_container">
        <div id="loader1">
            <div id="loader2">
                <div id="loader3"></div>
            </div>
        </div>
    </div>

    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top bg-light navbar-light flex-md-nowrap p-1 shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-store-alt"></i> {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="{{route('home')}}" class="nav-link"><i class="fas fa-home"></i> Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('products.index')}}" class="nav-link"><i class="fas fa-store-alt"></i> Tienda</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('categories.index')}}" class="nav-link"><i class="fas fa-tags"></i> Categorias</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('contact')}}" class="nav-link"><i class="fas fa-address-card"></i> Contacto</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Iniciar sesión') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> {{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('admin.index') }}" class="dropdown-item">
                                        <i class="fas fa-tools"></i> Dashboard
                                     </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-lg-2 d-none d-md-block bg-secondary sidebar navbar-dark">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item ">
                            @if(url()->current() == route('admin.index'))
                                <a href="{{route('admin.index')}}" class="nav-link active">
                                    <i class="fas fa-tools"></i>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{route('admin.index')}}" class="nav-link">
                                    <i class="fas fa-tools"></i>
                                    Dashboard
                                </a>
                            @endif
                            </li>
                            <li class="nav-item">
                            @if(url()->current() == route('admin.orders.index'))
                                <a class="nav-link active" href="{{ route('admin.orders.index')}}">
                                    <i class="far fa-file"></i> Ordenes
                                </a>
                            @else
                                <a class="nav-link" href="{{ route('admin.orders.index')}}">
                                    <i class="far fa-file"></i> Ordenes
                                </a>
                            @endif
                            </li>
                            <li class="nav-item">
                            @if(url()->current() == route('admin.payments.index'))
                                <a class="nav-link active" href="{{route('admin.payments.index')}}">
                                    <i class="fas fa-money-check-alt"></i> Pagos
                                </a>
                            @else
                                <a class="nav-link" href="{{route('admin.payments.index')}}">
                                    <i class="fas fa-money-check-alt"></i> Pagos
                                </a>
                            @endif
                            </li>
                            <li class="nav-item dropdown">
                            @if(url()->current() == route('admin.products.index') || url()->current() == route('admin.products.trash'))
                                <a class="nav-link dropdown-toggle active" href="#" id="products" data-toggle="dropdown">
                                    <i class="fas fa-box-open"></i> Productos
                                </a>
                            @else
                                <a class="nav-link dropdown-toggle" href="#" id="products" data-toggle="dropdown">
                                    <i class="fas fa-box-open"></i> Productos
                                </a>
                            @endif
                                <div class="dropdown-menu">
                                @if(url()->current() == route('admin.products.create'))
                                    <a href="{{route('admin.products.create')}}" class="dropdown-item active"><i class="fas fa-plus"></i> Agregar</a>
                                @else
                                    <a href="{{route('admin.products.create')}}" class="dropdown-item"><i class="fas fa-plus"></i> Agregar</a> 
                                @endif
                                @if(url()->current() == route('admin.products.index'))
                                    <a href="{{route('admin.products.index')}}" class="dropdown-item active"><i class="fas fa-box-open"></i> Todos</a>
                                @else
                                    <a href="{{route('admin.products.index')}}" class="dropdown-item"><i class="fas fa-box-open"></i> Todos</a> 
                                @endif
                                @if(url()->current() == route('admin.products.trash')) 
                                    <a href="{{route('admin.products.trash')}}" class="dropdown-item active"><i class="fas fa-trash"></i> Papelera</a>
                                @else
                                    <a href="{{route('admin.products.trash')}}" class="dropdown-item"><i class="fas fa-trash"></i> Papelera</a>
                                @endif

                                </div>
                            </li>
                            <li class="nav-item">
                            @if(url()->current() == route('admin.categories.index'))
                                <a class="nav-link active" href="{{route('admin.categories.index')}}">
                                    <i class="fas fa-tags"></i> Categorias
                                </a>
                            @else
                                <a class="nav-link" href="{{route('admin.categories.index')}}">
                                    <i class="fas fa-tags"></i> Categorias
                                </a>
                            @endif
                            </li>
                            
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
                
        <main role="main" id="main" class="col-md-9 ml-sm-auto col-lg-10">
            @yield('content')
        </main>
    </div>
    
</body>
</html>
