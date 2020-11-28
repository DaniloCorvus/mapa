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

        <table class="p-3 text text-dark font-weight-bold" style="width:100%; ">
            <tbody>
                <tr>
                    <td width="5%" style="padding:5px;">
                        <i class="fa fa-folder-open " aria-hidden="true"></i>
                    </td>
                    <td style="padding:5px;" class="text text-uppercase">
                        <b>{{ $categoria->nombre . ' ➜ '. 'PROCESO  ' .  $proceso->nombre . ' ➜ '.  $macroproceso->nombre }}</b>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-borderless" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <td colspan="2">

                        </td>
                    </tr>
                </thead>
                <tbody>
                    {{-- // /macroprocesos/{categoria}/{proceso}/{macroproceso}/{minicategoria} --}}
                    @foreach ($macroproceso->minicategorias as $item => $minicategoria )
                    <tr>
                        <td class="text text-danger font-weight-bold" scope="row">{{$item+1}}</td>
                        <td>
                            <a class="text text-dark font-weight-normal" href="{{route('macroproceso.details', [$categoria->slug, $proceso->slug, $macroproceso->slug, $minicategoria->slug])}}">
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
    </div>
</div>

@endsection
