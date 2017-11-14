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
    <link href="{{ asset('css/table.css?v=1.0.1') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/giraffe.css?v=1.0.7') }}">
    <link href="{{ asset('sweetalert/sweetalert.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{{ asset('images/favicon.ico') }}}">

</head>
<body>
<div id="app">
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/printThis.js?v=1.0.1') }}"></script>
<script src="{{ asset('js/venta.js?v=1.0.10') }}"></script>
<script src="{{ asset('js/personal.js?v=1.0.1') }}"></script>
<script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>

@include('sweet::alert')
</body>
</html>
