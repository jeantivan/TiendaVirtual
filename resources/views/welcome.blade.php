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

    <style>
        main::after{
          content: '';
          position: absolute;
          left: 0;
          background: #33ccff;
          height: 40px;
          width: 100%;
        }
    </style>
</head>
<body class="bg-claro">
    <header class="wh-100 vh-100 bg-azul d-flex flex-column justify-content-center align-items-center">
        <div class="display-6 text-oscuro">Bienvenido a tu</div>
        <h1 class="display-5 title text-claro py-3">
            <i class="fas fa-store-alt text-mostaza"></i> TiendaVirtual
        </h1>
        <h3 class="font-italic pb-3 text-center">Donde encuentras tus productos al mejor precio.</h3>
        <a href="{{route('products.index')}}" class="btn btn-header shadow-sm">Ir a la Tienda</a>
    </header>
    <nav class="navbar navbar-expand-md fixed-top navbar-light navbar-gradient flex-md-nowrap p-2 shadow" id="navbar">
        <div class="container mx-0 mr-sm-2">
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
                        <a href="#nosotros" class="nav-link"><i class="fas fa-address-card"></i> Nosotros</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto pl-3">
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
        <section class="container-fluid row clearfix" id="carrito-categoria">
            <div class="col-md-6 p-5 clearfix float-left">
                <p class="display-6 text-center">Agrega tus productos al carrito</p>
                <p class="h2 text-muted text-center">Realiza tus compras más fácil.</p>
                <p class="text-center display-4"><i class="fas fa-shopping-cart text-claro bg-mostaza p-4 rounded-circle shadow"></i></p>
            </div>
            <div class="col-md-6 p-5 float-right">    
                <p class="text-center display-4"><i class="fas fa-tags text-claro bg-azul p-4 rounded-circle shadow"></i></p>
                <p class="display-6 text-center">Filtra los productos por categoría</p>
                <p class="h2 text-muted text-center">Y consiguelo más rápido.</p>
            </div>
        </section>
        <hr>
        <section class="container-fluid row clearfix" id="ordenes-pagos">
            <div class="col-md-6 p-5 float-right">
                <p class="text-center display-4"><i class="far fa-check-circle text-oscuro bg-azul p-4 rounded-circle shadow"></i></p>
                <p class="display-6 text-center">Conoce el estado de tus órdenes.</p>
                <p class="h2 text-muted text-center">
                    y descarga tu factura <i class="fas fa-file-invoice text-oscuro"></i>
                </p>
            </div>
            <div class="col-md-6 p-5 float-right">  
                <p class="display-6 text-center">Realiza los pagos de manera sencilla</p>
                <p class="text-center display-4"><i class="fas fa-money-check-alt text-mostaza bg-oscuro rounded-circle shadow" style="padding: 2rem;"></i></p>
            </div>
        </section>
        <hr>
        <section class="container-fluid p-5 pt-3 m-0 h3 bg-contact contact" id="nosotros">
            <p class="text-left display-6">Nosotros.</p>
            <p class="text-left h4 text-oscuro">
                Puedes encontrarnos en<br> <i class="text-muted">5087 Lazy Panda Corner, Toxaway, Illinois, 62903-9822, US.</i>
            </p> 
            <p class="text-left h4">
                Llamando al <strong class="text-mostaza">254-653-5081</strong>
            </p>
            <p class="text-left h4">
                Escribe a <strong class="text-mostaza">info@tiendavirtual.com</strong>
            </p>         
        </section>
    </main>

    <footer class="d-inline-flex flex-row align-content-center bg-gradient-bt p-3 footer">
        <div class="mr-auto text-white">
            <h4 style="font-family: monospace;">Jean P. Tivan R.</h4>
        </div>
        <div class="ml-auto d-flex flex-row">
            <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" class="instagram mx-2"><i class="fab fa-instagram"></i></a>
            <a href="#" class="facebook"><i class="fab fa-facebook"></i></a>
        </div>         
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
