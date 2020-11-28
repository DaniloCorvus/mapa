let btnSaveDetalleProceso = document.getElementById("btnSaveDetalleProceso");
let btnUpdateDetalleProceso = document.getElementById("btnUpdateDetalleProceso");

let formDetalleProcesoRegister = document.getElementById('formDetalleProcesoRegister');
formDetalleProcesoRegister.addEventListener('submit', ajaxFormRegisterDetalleProceso);

let formDetalleProcesoUpdate = document.getElementById('formDetalleProcesoUpdate');
formDetalleProcesoUpdate.addEventListener('submit', ajaxFormUpdateDetalleProceso);

document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    // $.fn.dataTable.ext.errMode = 'none';
    dtDetalleProceso = $('#dataTabledetallesproceso').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,
        paginate: false,
        info: false,

        ajax: `${SITEURL}/administrativo/detalles/proceso/${proceso}`,

        columns: [{
                data: 'proceso.nombre',
                name: 'proceso.nombre'
            
            },
            {
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'descripcion',
                name: 'descripcion'
            },
            {
                data: 'action',
                name: 'action',
                searchable: false,
                orderable: false
            },
        ],
    });
})

//Envio de datos ajax
function ajaxFormRegisterDetalleProceso(event) {
    event.preventDefault();

    btnSaveDetalleProceso.value = "Enviando...";
    const dataRegister = new FormData(formDetalleProcesoRegister);

    fetch(formDetalleProcesoRegister.action, {
            method: 'POST',
            body: dataRegister,
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': document.querySelector('#csrf_token').getAttribute('content')
            }
        })
        .then(response => {
            switch (response.status) {
                case 200:
                    response.json().then(success => {
                        // toastr.info('Success:', success);
                        console.log('Success:', success);
                        dtDetalleProceso.draw();
                        document.getElementById("btnSaveDetalleProceso").value = "Enviar";
                        $('#formDetalleProcesoRegister').trigger("reset");
                        $('#modalDetalleProcesoRegister').modal('hide');
                    });
                    document.getElementById("btnSaveDetalleProceso").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formDetalleProcesoRegister.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnSaveDetalleProceso").value = "Enviar";
                    });
                    break;
                default:
                    throw response.json().then(error => {
                        console.log(error);
                        //     for (var clave in error) {
                        //         console.log(error[clave]);
                        //     }
                        // })
                        // throw response.json().then(error => {
                        //     throw new Error(error); // (*)
                    })
                    break;
            }
        })
        .catch(error => {
            console.log(error);
        });
}

// Traer datos de DetalleProceso
function editarDetalleProceso(ente_id) {

    const url = `${SITEURL}/minicategorias/${ente_id}/edit`

    fetch(url, {
            method: 'GET',
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': document.querySelector('#csrf_token').getAttribute('content')
            }
        })
        .then(response => {
            switch (response.status) {
                case 200:
                    response.json().then(success => {
                        formDetalleProcesoUpdate.id.value = success.id;
                        formDetalleProcesoUpdate.nombre.value = success.nombre;
                        formDetalleProcesoUpdate.descripcion.value = success.descripcion;
                        $('#modalDetalleProcesoUpdate').modal('show')
                    });
                    break;
                default:
                    throw response.json().then(error => {
                        // return new Error(error);
                        for (var clave in error) {
                            console.log(error[clave]);
                        }
                    })

                    break;
            }
        })
        .catch(error => {
            console.log('request failed', error);
        });
}


//Envio de datos ajax a actualizar
function ajaxFormUpdateDetalleProceso(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formDetalleProcesoUpdate);
    btnUpdateDetalleProceso.value = "Enviando..."

    fetch(formDetalleProcesoUpdate.action, {
            method: 'POST',
            body: dataUpdate,
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': document.querySelector('#csrf_token').getAttribute('content')
            }
        })
        .then(response => {
            switch (response.status) {
                case 200:
                    response.json().then(success => {
                        toastr.info('Success:', success);
                        dtDetalleProceso.draw();
                        document.getElementById("btnUpdateDetalleProceso").value = "Enviar";
                        $('#formDetalleProcesoUpdate').trigger("reset");
                        $('#modalDetalleProcesoUpdate').modal('hide');
                    });
                    document.getElementById("btnUpdateDetalleProceso").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formDetalleProcesoUpdate.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnUpdateDetalleProceso").value = "Enviar";
                    });
                    break;
                default:
                    throw response.json().then(error => {
                        // return new Error(error);
                        for (var clave in error) {
                            console.log(error[clave]);
                        }
                    })

                    break;
            }
        })
        .catch(error => {
            console.log(error);
        });

}

// Eliminar DetalleProceso
function eliminarDetalleProceso(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = `${SITEURL}/minicategorias/${ente_id}`
                fetch(url, {
                        method: 'DELETE',
                        mode: "cors",
                        headers: {
                            accept: "application/json",
                            'X-CSRF-TOKEN': document.querySelector('#csrf_token').getAttribute('content')
                        }
                    })
                    .then(response => {
                        switch (response.status) {
                            case 200:
                                response.json().then(success => {
                                    dtDetalleProceso.draw();
                                    toastr.remove()
                                    toastr.info('Success:', success);
                                });
                                break;
                            default:
                                throw response.json().then(error => {
                                    // return new Error(error);
                                    for (var clave in error) {
                                        console.log(error[clave]);
                                    }
                                })
                                break;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                toastr.remove()
            }
        }
    });
}


