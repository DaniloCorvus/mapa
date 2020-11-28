let btnSaveDetallesubProceso = document.getElementById("btnSaveDetallesubProceso");
let btnUpdateDetallesubProceso = document.getElementById("btnUpdateDetallesubProceso");

let formDetallesubProcesoRegister = document.getElementById('formDetallesubProcesoRegister');
formDetallesubProcesoRegister.addEventListener('submit', ajaxFormRegisterDetallesubProceso);

let formDetallesubProcesoUpdate = document.getElementById('formDetallesubProcesoUpdate');
formDetallesubProcesoUpdate.addEventListener('submit', ajaxFormUpdateDetallesubProceso);

document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    // $.fn.dataTable.ext.errMode = 'none';
    dtDetallesubProceso = $('#dataTabledetallessubproceso').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,
        paginate: false,
        info: false,

        ajax: `${SITEURL}/administrativo/detalles/subproceso/${subproceso}`,

        columns: [
            {
                data: 'subproceso.nombre',
                name: 'subproceso.nombre'
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
function ajaxFormRegisterDetallesubProceso(event) {
    event.preventDefault();

    btnSaveDetallesubProceso.value = "Enviando...";
    const dataRegister = new FormData(formDetallesubProcesoRegister);

    fetch(formDetallesubProcesoRegister.action, {
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
                        dtDetallesubProceso.draw();
                        document.getElementById("btnSaveDetallesubProceso").value = "Enviar";
                        $('#formDetallesubProcesoRegister').trigger("reset");
                        $('#modalDetallesubProcesoRegister').modal('hide');
                    });
                    document.getElementById("btnSaveDetallesubProceso").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formDetallesubProcesoRegister.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnSaveDetallesubProceso").value = "Enviar";
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

// Traer datos de DetallesubProceso
function editarDetallesubProceso(ente_id) {

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
                        formDetallesubProcesoUpdate.id.value = success.id;
                        formDetallesubProcesoUpdate.nombre.value = success.nombre;
                        formDetallesubProcesoUpdate.descripcion.value = success.descripcion;
                        $('#modalDetallesubProcesoUpdate').modal('show')
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
function ajaxFormUpdateDetallesubProceso(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formDetallesubProcesoUpdate);
    btnUpdateDetallesubProceso.value = "Enviando..."

    fetch(formDetallesubProcesoUpdate.action, {
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
                        dtDetallesubProceso.draw();
                        document.getElementById("btnUpdateDetallesubProceso").value = "Enviar";
                        $('#formDetallesubProcesoUpdate').trigger("reset");
                        $('#modalDetallesubProcesoUpdate').modal('hide');
                    });
                    document.getElementById("btnUpdateDetallesubProceso").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formDetallesubProcesoUpdate.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnUpdateDetallesubProceso").value = "Enviar";
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

// Eliminar DetallesubProceso
function eliminarDetallesubProceso(ente_id) {
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
                                    dtDetallesubProceso.draw();
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
