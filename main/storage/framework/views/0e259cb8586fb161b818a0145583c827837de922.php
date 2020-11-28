<form method="POST" id="formArchivoNormagrama" action="<?php echo e(route('otros.store')); ?>" files="true"
    enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="modalArchivoCreateFormNormagrama" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold" id="title-archivo">Nuevo Normagrama</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="form-group">
                        <label for="title">Titulo (*) </label>
                        <input readonly type="text" class="form-control" name="title" placeholder="Enter titulo"
                            value="Normograma secretaria general">

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

                        <label for="file-normograma" class="subir btn btn-outline-dark btn-round btn-xs">
                            <i class="fas fa-cloud-upload-alt"></i> Archivo
                        </label>

                        <input id="file-normograma" name="file" type="file" style='display: none;'/>


                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-danger"> Save </button>
                </div>
            </div>
        </div>
    </div>

</form>


<?php /**PATH C:\laragon\www\mapa\main\resources\views/otros/normograma.blade.php ENDPATH**/ ?>