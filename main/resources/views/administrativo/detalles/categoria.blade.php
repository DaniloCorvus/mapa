@extends('layouts.admin')
@section('content')

<div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

    <a href="javascript:history.back()" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title=""
        data-original-title="Regresar">
        <i class="fa fa-reply btn btn-icon text-info"></i>
    </a>

    <a href="javascript:void(0)" class="tooltip-wrapper" data-toggle="modal" data-placement="top"
        data-target="#modalDetalleRegister" title="Registrar">
        <i class="fa fa-edit btn btn-icon text-success"></i>
    </a>

    <h5 class="m-2">
        <i class="fa fa-group"></i> Detalle
    </h5>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="export-table-wrapper table-responsive">
                    <table class="table table-bordered " style="color:black" id="dataTabledetalles" width="100%"
                        cellspacing="0">
                        <thead class="thead">
                            <tr>
                                <th>Categoria</th>
                                <th>Nombre de Detalle</th>
                                <th>Descripcion</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@include('administrativo.detalles.formCategoriaUpdate')
@include('administrativo.detalles.formCategoriaRegister')

@stop

@push('scripts')
<script>const categoria = @JSON($categoria) </script>
<script src="{{ asset('./apis/apiDetalle.js') }}"></script>
@endpush