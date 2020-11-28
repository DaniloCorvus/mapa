@extends('layouts.app')
@section('content')
<!-- Grid row -->
<div class="container">
        @auth
        @if(Auth::user()->hasRole('admin'))
        <div class="text-center m-3">
            <a href class="btn btn-primary btn-rounded mb-3" data-toggle="modal" data-target="#modalVideoCreateForm">
                Nuevo video
            </a>
        </div>
        @endif
        @endauth


    
    <div class="row">
        <div class="card-columns bg-transparent m-3 p-1">
            @foreach ($videos as $item)
            <div class="card bg-transparent">
                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                    <iframe width="200px" height="200px" class="embed-responsive-item" src="{{$item->pdf_path}}" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$item->nombre}}</h5>
                    <p class="card-text">{{$item->descripcion}}</p>
                    <p class="card-text"><small class="text-muted">subido en {{$item->updated_at}}</small></p>

                    @auth
                    @if(Auth::user()->hasRole('admin'))
                    <form action="{{route('video.destroy', $item->id)}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm ">
                        Eliminar
                    </button>

                    </form>
                    @endif
                    @endauth
                    
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@include('videos.create')

@endsection
