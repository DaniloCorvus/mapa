<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalMacroProcesoRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar MacroProceso
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formMacroProcesoRegister" method="POST" action="{{route('macroprocesos.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="proceso_id" value="{{$proceso}}">

                            <div class="form-group col-md-12">
                                <label class="text-dark"> Nombre </label>
                                <input type="text" class="form-control" required="required" name="nombre"
                                    placeholder="Eje: Procesos...">
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark"> Descricipcion </label>
                                <textarea type="text" rows="10" class="form-control" required="required"
                                    name="descripcion" placeholder="Descripcion ..."></textarea>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary btn-sm " id="btnSaveMacroProceso"
                                    value="Enviar">
                                <button type="button" class="btn btn-outline-dark btn-sm"
                                    data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>