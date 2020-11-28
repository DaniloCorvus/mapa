<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" id="csrf_token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mi sistema') }}</title>

    {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> --}}

    <link href="{{asset('/css/custom/argon-dashboard.css')}}" rel="stylesheet">

    <link href="{{asset('css/custom/nucleo.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('css/datatablecss/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/datatablecss/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('css/datatablecss/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/fontawesome/css/all.min.css')}}" rel="stylesheet" type="text/css" />


</head>

<style>
    .table td {
        white-space: nowrap;
        text-overflow: ellipsis;
        word-break: break-all;
        overflow: hidden;
    }

    .table.dataTable.dtr-inline.collapsed>tbody>tr>td.details-control:first-child:before {
        display: none;
    }

    .table.dataTable th,
    .table.dataTable td {
        white-space: normal;
    }

    .child {
        table-layout: fixed color: black
    }

    .child td {
        word-wrap: break-word;
        white-space: normal !important;
    }

    .selectpicker {
        width: 100%;
    }

    .select2-container {
        margin-top: 1em;
    }
</style>

<body class="">

    @auth
    {{-- @include('layouts.side') --}}
    @endauth

    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark " id="navbar-main">
            <div class="container-fluid">
                @auth
                @include('layouts.nav')
                @endauth
            </div>
        </nav>
        <!-- End Navbar -->
        <!-- Header -->
        <div class="header bg-gradient-primary mb-3 p-5">
            <div class="container-fluid">
                <div class="header-body">
                </div>
            </div>
        </div>
        <!-- Page content -->

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col">
                    <div class="card shadow">

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const SITEURL = ''
    </script>
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/datatablejs/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/datatablejs/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/datatablejs/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>

    @stack('scripts')

</body>

</html>