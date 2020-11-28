@extends('layouts.app')
@section('content')
<div class="row d-flex justify-content-center">
    <div class="row row d-flex justify-content-center content ">
        <img src="/img/brr.png" alt="" style="
            width: 18rem;
            height: 13rem;
            border-radius: 50%;
            background-size: cover; 
            background-position: center center; 
            margin: 0 auto .9rem; ">
    </div>

    <div class=" w-100"></div>

    <div class=" text-center ">
        <h1 class="title text-uppercase">{{$titulo}}</h1>
    </div>

    <div class="w-100"></div>
    @foreach ($categorias as $key => $categoria)

    @switch($key+1)
    @case(1)
    <div class="dropdown m-0">
        <ul class="menu bg-dark">
            <li class="text-center">
                <a class="uno" href="{{route('categorias.index',$categoria->slug)}}">
                    <i class=" i my-2 fa fa-cogs" aria-hidden="true"></i>
                    {{$categoria->nombre}}
                </a>
                <ul class="menu">
                    @foreach ($categoria->procesos as $proceso)
                    <li class="text-center">
                        <a href="{{route('proceso.index',[$categoria->slug, $proceso->slug])}}">Proceso:
                            {{$proceso->nombre}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
    @break

    @case(2)
    <div class="dropdown m-0">
        <ul class="menu rojo">
            <li class="text-center">
                <a class="uno" href="{{route('categorias.index',$categoria->slug)}}">
                    <i class=" i fa fa-sign-language m-2" aria-hidden="true"></i>
                    {{$categoria->nombre}}
                </a>
                <ul class="menu">
                    @foreach ($categoria->procesos as $proceso)
                    <li class="text-center">
                        <a href="{{route('proceso.index',[$categoria->slug, $proceso->slug])}}">Proceso:
                            {{$proceso->nombre}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
    @break

    @case(3)
    <div class="dropdown m-0">
        <ul class="menu verde">
            <li class="text-center">
                <a class="uno" href="{{route('categorias.index',$categoria->slug)}}">
                    <i class=" i my-2 fa fa-balance-scale" aria-hidden="true"></i>
                    {{$categoria->nombre}}
                </a>
                <ul class="menu">
                    @foreach ($categoria->procesos as $proceso)
                    <li class="text-center">
                        <a href="{{route('proceso.index',[$categoria->slug, $proceso->slug])}}">Proceso:
                            {{$proceso->nombre}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
    @break

    @case(4)
    <div class="dropdown m-0">
        <ul class="menu azul">
            <li class="text-center">
                <a class="uno" href="{{route('categorias.index',$categoria->slug)}}">
                    <i class=" i fa fa-check my-2" aria-hidden="true"></i>
                    {{$categoria->nombre}}
                </a>
                <ul class="menu">
                    @foreach ($categoria->procesos as $proceso)
                    <li class="text-center">
                        <a href="{{route('proceso.index',[$categoria->slug, $proceso->slug])}}">Proceso:
                            {{$proceso->nombre}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
    @break
    @case(5)
    <div class="dropdown m-0">
        <ul class="menu salmon">
            <li class="text-center">
                <a class="uno" href="{{route('categorias.index',$categoria->slug)}}">
                    <i class=" i fa fa-check my-2" aria-hidden="true"></i>
                    {{$categoria->nombre}}
                </a>
                <ul class="menu">
                    @foreach ($categoria->procesos as $proceso)
                    <li class="text-center">
                        <a href="{{route('proceso.index',[$categoria->slug, $proceso->slug])}}">Proceso:
                            {{$proceso->nombre}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
    @break
    @case(6)
    <div class="dropdown m-0">
        <ul class="menu orange">
            <li class="text-center">
                <a class="uno" href="{{route('categorias.index',$categoria->slug)}}">
                    <i class=" i fa fa-check my-2" aria-hidden="true"></i>
                    {{$categoria->nombre}}
                </a>
                <ul class="menu">
                    @foreach ($categoria->procesos as $proceso)
                    <li class="text-center">
                        <a href="{{route('proceso.index',[$categoria->slug, $proceso->slug])}}">Proceso:
                            {{$proceso->nombre}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
    @break

    @default
    <div class="dropdown m-0">
        <ul class="menu cyan">
            <li class="text-center">
                <a class="uno" href="{{route('categorias.index',$categoria->slug)}}">
                    <i class=" i my-2 fa fa-book my-1"></i>
                    {{$categoria->nombre}}
                </a>
                <ul class="menu">
                    @foreach ($categoria->procesos as $proceso)
                    <li class="text-center">
                        <a href="{{route('proceso.index',[$categoria->slug, $proceso->slug])}}">Proceso:
                            {{$proceso->nombre}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
    @break

    @endswitch
    @endforeach

    <div class="row w-100">
        <div class="col-md-12">
            @auth
            @if(Auth::user()->hasRole('admin'))
            <div class="text-center m-3">

                <a href class="btn btn-primary btn-rounded mb-3" data-toggle="modal"
                    data-target="#modalArchivoCreateFormNormagrama">
                    Normograma secretaria general
                </a>

                <a href class="btn btn-primary btn-rounded mb-3" data-toggle="modal"
                    data-target="#modalArchivoCreateFormGuia">
                    Guia interactiva secretaria general
                </a>

            </div>
            @endif
            @endauth
            @include('otros.guia_interactiva')
            @include('otros.normograma')
        </div>
    </div>

    <div class="w-100"></div>

    <div class="row mt-3">
        <div class="md-12 ">
            @if (isset($files))
            @foreach ($files as $item)
            <div class="d-flex justify-content-center">
                <a href="{{url('/downloadotros/'.$item->file_path)}}" class="btn btn-success btn-rounded btn-sm m-2 ">
                    <i class="fa fa-file-excel" aria-hidden="true"></i>
                    {{$item->nombre}}</a>
                @auth
                @if(Auth::user()->hasRole('admin'))
                <a href="{{route('otros.delete', $item->id)}}" class="btn btn-danger btn-rounded btn-sm m-2 ">X</a>
                @endauth
                @endif
            </div>
            @endforeach
            @endif
        </div>
    </div>

</div>
@stop