<div class="text-lg-right text-nowrap">

    <a class="btn btn-primary" href="{{route('users.show', $id)}}">
        <i class="fa fa-fw fa-eye"></i>
    </a>

    <a class="btn btn-xs btn-icon btn-danger delete-usser" href="javascript:void(0)" onclick="eliminarUser({{$id}})"
        data-toggle="tooltip" title="Eliminar">
        <i class="fa fa-fw fa-trash"></i>
    </a>

</div>
