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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-claro">
    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top navbar-light navbar-gradient flex-md-nowrap p-2 shadow">
            <div class="container mx-0">
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
                            <a href="{{url('/')}}/#nosotros" class="nav-link"><i class="fas fa-address-card"></i> Nosotros</a>
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->isAdmin)
                                        <a href="{{ route('admin.index') }}" class="dropdown-item">
                                            <i class="fas fa-tools"></i> Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('users.carts.index') }}" class="dropdown-item">
                                            <i class="fas fa-shopping-cart"></i> Carrito 
                                        </a>
                                        <a href="{{ route('users.orders.index') }}" class="dropdown-item">
                                            <i class="fas fa-box-open"></i> Mis Compras
                                        </a>
                                        
                                    @endif
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

        <main class="pt-5">
            @yield('content')
        </main>

        <footer class="d-inline-flex flex-row align-content-center bg-gradient-bt p-3 footer">
            <div class="mr-auto text-white">
                <h5 style="font-family: monospace;">Jean P. Tivan R.</h5>
            </div>
            <div class="ml-auto d-flex flex-row">
                <a href="https://twitter.com/" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/" target="_blank" class="instagram mx-2"><i class="fab fa-instagram"></i></a>
                <a href="https://www.facebook.com/" target="_blank" class="facebook"><i class="fab fa-facebook"></i></a>
            </div>         
        </footer>
    </div>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
