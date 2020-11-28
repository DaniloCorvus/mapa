<div class="card">

<form method="POST" id="formArchivoUpdate" action="{{route('archivos.update')}}" files="true" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="modal fade" id="modalArchivoUpdateForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <input type="hidden" name="id" id="id" value="">

                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold" id="title-archivo">Nuevo Archivo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="form-group">
                            <label for="title">Titulo (*) </label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter titulo">
                        </div>

                        <div class="form-group">
                            <label for="description">Descripcion</label>
                            <textarea type="text" class="form-control" id="description" name="description"
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

                            <label for="file_pdf" class="subir btn btn-outline-dark btn-round btn-xs">
                                <i class="fas fa-cloud-upload-alt"></i> Archivo de pdf
                            </label>

                            <input id="file_pdf" name="pdf" type="file" style='display: none;' />


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
