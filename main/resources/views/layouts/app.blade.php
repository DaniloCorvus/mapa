<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Mi sistema') }}</title>

    <!-- Bootstrap -->
    <link href="fontawesome/css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/menuof.css" rel="stylesheet">

</head>

<body>

    @include('layouts.nav-principal')

    <div class="container ">
        @yield('content')
    </div>

    <div style="text-align:center" class=""><a href="#">Powered&nbsp; by &nbsp; </a><a href="{{route('info')}}"
            target="_blank" class="text text-dark">Mapa de Procesos Secretaria General
        </a>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.3.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>