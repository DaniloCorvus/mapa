@extends('layouts.app')
@section('content')

<div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

    <a href="javascript:history.back()" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title=""
        data-original-title="Regresar">
        <i class="fa fa-reply btn btn-icon text-primary"></i>
    </a>

    @auth
    <a href="javascript:void(0)" class="tooltip-wrapper" data-toggle="modal" data-placement="top"
        data-target="#modalHistoriaRegister" title="Registrar">
        <i class="fa fa-edit btn btn-icon text-success"></i>
    </a>
    @endauth

    <div class="card-header bg-transparent">
        <h3 class="mb-0">{{$order->serial}}</h3>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="export-table-wrapper table-responsive">
                    <table class="table table-bordered dT" style="color:black" id="dataTableHistoria" width="100%"
                        cellspacing="0">
                        <thead class="thead">
                            <tr>
                                <th>S. No</th>
                                <th>Responsable</th>
                                <th>Accion</th>
                                <th>Fecha Ingreso</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.historias.formRegisterHistoria')

@stop
@push('scripts')
<script src="{{ asset('/apis/apiHistorial.js') }}"></script>
@endpush
