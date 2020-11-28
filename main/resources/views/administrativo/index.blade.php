@extends('layouts.admin')
@section('content')

<div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

    <a href="javascript:history.back()" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title=""
        data-original-title="Regresar">
        <i class="fa fa-reply btn btn-icon text-info"></i>
    </a>

    <a href="javascript:void(0)" class="tooltip-wrapper" data-toggle="modal" data-placement="top"
        data-target="#modalCategoriaRegister" title="Registrar">
        <i class="fa fa-edit btn btn-icon text-success"></i>
    </a>

    <h5 class="m-2">
        <i class="fa fa-group"></i> categorias
    </h5>

</div>


<div class="row">
    <div class="col-lg-12">
        @if (session('status'))
    
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Excelente!</strong> {{ session('status') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    
        @endif
        <div class="card card-statistics">


            <div class="card-body">

                <form action="{{route('empresa.update')}}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="col-md-6">
                        <label for="" class="">Titulo principal</label>
                        <input type="text" name="title" class="form-control">
                        <button type="submit" class="btn btn-info btn-sm">Enviar</button>
                    </div>

                </form>

                <div class="export-table-wrapper table-responsive">
                    <table class="table table-bordered " style="color:black" id="dataTablecategorias" width="100%"
                        cellspacing="0">
                        <thead class="thead">
                            <tr>
                                <th>S. No</th>
                                <th>Name</th>
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


@include('administrativo.categorias.formUpdate')
@include('administrativo.categorias.formRegister')

@stop

@push('scripts')
<script src="{{ asset('/apis/apiCategoria.js') }}"></script>
@endpush