<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalProcesoRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar Proceso
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formProcesoRegister" method="POST" action="{{route('procesos.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-md-12">
                                <label class="text-dark" for="categoria_id">Categorias</label>
                                <select class="select-modalVehiculoRegister-propietario form-control"
                                    data-live-search="true" required="required" name="categoria_id">
                                    @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>


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
                                <input type="submit" class="btn btn-outline-primary btn-sm " id="btnSaveProceso"
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