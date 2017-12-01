<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Giraffe: Heladería Cafetería</title>

    <!-- Styles -->
    <link href="{{ asset('font/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/table.css?v=1.0.2') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('css/giraffe.css?v=1.0.23') }}" rel="stylesheet">
<!-- <link rel="stylesheet" href="{{ asset('css/modal-fullscreen.css?v=1.0.12') }}"> -->

    <link rel="shortcut icon" href="{{{ asset('images/favicon.ico') }}}">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo-header-2.png') }}" alt="">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @guest
                        @else
                            @if(Auth::user()->rol_usuario != 3)
                                &nbsp;
                                <li>
                                    <a href="{{ url('/') }}">
                                        Inicio
                                    </a>
                                </li>

                                <li class="dropdown">

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false" aria-haspopup="true">
                                        Personas<span class="caret"></span>

                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('register') }}">
                                                Usuarios
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('clienteindex') }}">
                                                Clientes
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false" aria-haspopup="true">
                                        Productos<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('productoindex') }}">
                                                Gestión de Productos
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('kardexindex') }}">
                                                Kardex
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('insumoindex') }}">
                                                Insumos
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false" aria-haspopup="true">
                                        Ventas<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('listaventaindex') }}">
                                                Lista de Ventas
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('orderDetail')}}">
                                                Reporte de Ventas
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @endguest
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">Ingresar</a></li>
                    <!-- <li><a href="{{ route('register') }}">Registro</a></li> -->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->email }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar Sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-6 text-left texto">
                Developed by <a href="http://www.gvallejos.com" class="link" target="_blank">gVallejos.com</a>
            </div>
            <div class="col-md-6 col-xs-6 text-right texto">
                © 2017 Giraffe v.1.0.0.
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- <script src="{{ asset('js/fullscreen-modal.js?v=1.0.2') }}"></script> -->
<script src="{{ asset('js/printThis.js?v=1.0.1') }}"></script>
<script src="{{ asset('js/venta.js?v=1.0.18') }}"></script>
<script src="{{ asset('js/lista-venta.js?v=1.0.4') }}"></script>
<script src="{{ asset('js/personal.js?v=1.0.1') }}"></script>
<script src="{{ asset('js/cuadrecaja.js?v=1.0.7') }}"></script>
<script src="{{ asset('js/detalle.js?v=1.0.3') }}"></script>
<script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>

@include('sweet::alert')
</body>
</html>
