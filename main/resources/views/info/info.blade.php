<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mapa de Procesos') }}</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('/img/mapa.jpg');
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
    </style>

</head>
<body>
</body>

</html>