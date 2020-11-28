@extends('layouts.main')

@section('content')

<div class="container mt-3 p-3">

    
    <div class="justify-content-left">
        <a href="javascript:history.back()" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title=""
            data-original-title="Regresar">
            <i class="fa fa-reply-all  btn-icon text-primary"></i>
        </a>
    </div>

    <div class="row justify-content-center p-3">

        <table class="p-3 text text-dark font-italic " style="width:100%; ">
            <tbody>
                <tr>
                    <td width="5%" style="padding:5px;">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                    </td>
                    <td class="text text-uppercase">

                        <b>
                            {{ $categoria->nombre . ' ➜ '.
                         'PROCESO  ' .$proceso->nombre . ' ➜ '.
                         'SUB PROCESO  ' .  $subproceso->nombre .' ➜ '.
                         'DOCUMENTOS DE ' .  $minicategoria->nombre
                        }}
                        </b>

                    </td>
                </tr>
                <tr></tr>
            </tbody>
        </table>

        @auth
        @if(Auth::user()->hasRole('admin'))
        <div>
            <a href class="btn btn-primary btn-rounded my-2 btn-sm " data-toggle="modal" data-target="#modalArchivoCreateForm">
                Nuevo documento
            </a>
        </div>
        @endif
        @endauth

        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-borderless" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre del Archivo</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Descargar</th>
                        @auth
                        @if(Auth::user()->hasRole('admin'))
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                        @endif
                        @endauth

                    </tr>
                </thead>
                <tbody>
                    @foreach($archivos as $key => $archivo)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$archivo->nombre}}</td>
                        <td>{{$archivo->descripcion}}</td>
                        <td> <a href="{{url('/downloadfiles/'.$archivo->pdf_path)}}">
                                <i class="fa fa-file" aria-hidden="true">
                                </i>
                                {{$archivo->pdf_path}}</a></td>

                        @auth
                        @if(Auth::user()->hasRole('admin'))
                        <td width="10px"> <button type="button" class="btn btn-info btn-sm"
                                onclick="editarArchivo({{$archivo->id}})">Editar</button>
                        </td>
                        <td width="10px"> <button type="button" class="btn btn-danger btn-sm delete-archivo"
                                data-id={{$archivo->id}}>Eliminar</button></td>
                        @endif
                        @endauth
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('archivos.create')
        @include('archivos.edit')
    </div>
</div>
@endsection


@section('script')
{{-- <script type="text/javascript" src="{{asset('/js/validaciones.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/archivo.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/updatefile.js')}}"></script> --}}
@endsection
