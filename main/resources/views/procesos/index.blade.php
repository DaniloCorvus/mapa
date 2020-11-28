@extends('layouts.main')

@section('content')

<div class="container mt-3 p-3">

    <div class="justify-content-left">
        <a href="javascript:history.back()" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title=""
            data-original-title="Regresar">
            <i class="fa fa-reply-all btn-icon text-primary"></i>
        </a>
    </div>


    <div class="row justify-content-center p-3">

        <table class="p-3 text text-dark font-italic font-weight-bold" style="width:100%; ">
            <tbody>
                <tr>
                    <td width="5%" style="padding:5px;">
                        <i class="fa fa-folder-open " aria-hidden="true"></i>
                    </td>
                    <td style="padding:5px;" class="text text-uppercase">
                        <b>{{ $categoria->nombre . ' ➜ '. 'PROCESO  ' .  $proceso->nombre }}</b>
                    </td>
                </tr>
            </tbody>
        </table>

        @if (isset($proceso) && count($proceso->minicategorias)>0)
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-borderless" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <td colspan="2">

                        </td>
                    </tr>
                </thead>
                <tbody>
                    {{-- /proceso/{categoria}/{proceso}/{minicategoria} --}}
                    @foreach ($proceso->minicategorias as $item => $minicategoria )
                    <tr>
                        <td>
                            <a class="text text-dark font-italic font-weight-bold"
                                href="{{route('proceso.details', [$categoria->slug, $proceso->slug, $minicategoria->slug])}}">
                                <i class="fa fa-folder" aria-hidden="true">
                                </i>
                                {{$minicategoria->nombre }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if (isset($proceso) && count($proceso->macroprocesos)>0)
        <div class="table-responsive text-nowrap">
            <table class="table-borderless table table-hover" cellspacing="0">
                <thead>
                    <tr>
                        <td class="font-italic font-weight-bold" colspan="2" style="color:#1565C0; font-size: 1rem">
                            Macroprocesos Misionales
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proceso->macroprocesos as $item => $macroproceso )
                    @if ($item <=3) <tr class="w-100">
                        <td>
                            <a class="text text-dark font-italic font-weight-bold"
                                href="{{route('macroprocesos.show',[$categoria->slug, $proceso->slug,$macroproceso->slug])}}">
                                <i class="fa fa-folder" aria-hidden="true">
                                </i>
                                {{$macroproceso->nombre }}
                            </a>
                        </td>
                        </tr>
                        @else
                        @endif
                        @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table-borderless table table-hover" cellspacing="0">
                <thead>
                    <tr>
                        <td class="font-italic font-weight-bold" colspan="2" style="color:#1565C0; font-size: 1rem">
                            Macroprocesos de Apoyo
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proceso->macroprocesos as $item => $macroproceso )
                    @if ($item > 3)
                    <tr class="w-100">
                        <td>
                            <a class="text text-dark font-italic font-weight-bold"
                                href="{{route('macroprocesos.show',[$categoria->slug, $proceso->slug,$macroproceso->slug])}}">
                                <i class="fa fa-folder" aria-hidden="true">
                                </i>
                                {{$macroproceso->nombre }}
                            </a>
                        </td>
                    </tr>
                    @else
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif


        @if (isset($proceso) && count($proceso->subprocesos)>0)
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-borderless" cellspacing="0">
                <thead>
                    <tr>
                        <td class="font-italic font-weight-bold" colspan="2" style="color:#1565C0; font-size:1rem;">
                            Sub Procesos
                        </td>
                    </tr>
                </thead>
                <tbody>
                    {{-- '/subproceso/{categoria}/{proceso}/{subproceso}' --}}
                    @foreach ($proceso->subprocesos as $item => $subproceso )
                    <tr>
                        <td>
                            <a class="text text-dark font-italic font-weight-bold"
                                href="{{route('subprocesos.show', [$categoria->slug, $proceso->slug, $subproceso->slug])}}">
                                <i class="fa fa-folder" aria-hidden="true">
                                </i>
                                {{'SUB PROCESO  '. $subproceso->nombre }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

    </div>
    {{-- </div> --}}

    @endsection