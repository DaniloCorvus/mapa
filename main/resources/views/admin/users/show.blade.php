@extends('layouts.admin')
@section('content')

<div class="ml-auto d-flex align-items-center secondary-menu text-center m-2 bg-transparent">

    <a href="javascript:history.back()" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title=""
        data-original-title="Regresar">
        <i class="fa fa-reply btn btn-icon text-primary"></i>
    </a>

    <a href="javascript:void(0)" class="tooltip-wrapper" data-toggle="modal" data-placement="top"
        data-target="#modalUser_RoleRegister" title="Registrar">
        <i class="fa fa-edit btn btn-icon text-success"></i>
    </a>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="export-table-wrapper table-responsive">
                    <table class="table table-bordered dT" style="color:black" id="dataTableRol" width="100%"
                        cellspacing="0">
                        <thead class="thead">
                            <tr>
                                <th>S. No</th>
                                <th>Roll</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.roles.partials.formRegister')

<input type="hidden" name="user_id" id="user_id" value={{$user->id}}>

@stop
@push('scripts')
<script src="{{ asset('/apis/apiRol.js') }}"></script>
@endpush
