<div class="card">

    <form method="POST" id="formArchivo" action="{{route('archivos.store')}}" files="true"
        enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modalArchivoCreateForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold" id="title-archivo">Nuevo Archivo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="form-group">
                            <label for="title">Titulo (*) </label>
                            <input type="text" class="form-control" name="title" placeholder="Enter titulo">

                            <input type="hidden" class="form-control" name="categoria_id" value="{{$categoria->id}}">
                            @if (isset($proceso))
                            <input type="hidden" class="form-control" name="proceso_id" value="{{$proceso->id}}">
                            @endif
                            @if (isset($subproceso))
                            <input type="hidden" class="form-control" name="subproceso_id" value="{{$subproceso->id}}">
                            @endif
                            @if (isset($macroproceso))
                            <input type="hidden" class="form-control" name="macroproceso_id"
                                value="{{$macroproceso->id}}">
                            @endif
                            <input type="hidden" class="form-control" name="minicategoria_id"
                                value="{{$minicategoria->id}}">

                        </div>

                        <div class="form-group">
                            <label for="description">Descripcion</label>
                            <textarea type="text" class="form-control" name="description"
                                placeholder="Enter descripcion"></textarea>
                        </div>

                        <div class="form-group col-md-12">

                            <div class="progress m-2">
                                <div class="bar"></div>
                                <div class=" percent">
                                    0%
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">

                            <label for="Archivo">
                                <i class="fa fa-cloud-upload-alt"></i> Archivo (*) :
                            </label>

                            <label for="file-pdf" class="subir btn btn-outline-dark btn-round btn-xs">
                                <i class="fas fa-cloud-upload-alt"></i> Archivo de pdf
                            </label>

                            <input id="file-pdf" name="pdf" type="file" style='display: none;' />


                        </div>

                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-danger"> Save </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>