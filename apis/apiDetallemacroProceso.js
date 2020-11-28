let btnSaveDetalleMacroProceso = document.getElementById("btnSaveDetalleMacroProceso");
let btnUpdateDetalleMacroProceso = document.getElementById("btnUpdateDetalleMacroProceso");

let formDetalleMacroProcesoRegister = document.getElementById('formDetalleMacroProcesoRegister');
formDetalleMacroProcesoRegister.addEventListener('submit', ajaxFormRegisterDetalleMacroProceso);

let formDetalleMacroProcesoUpdate = document.getElementById('formDetalleMacroProcesoUpdate');
formDetalleMacroProcesoUpdate.addEventListener('submit', ajaxFormUpdateDetalleMacroProceso);

document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    // $.fn.dataTable.ext.errMode = 'none';
    dtDetalleMacroProceso = $('#dataTabledetallesmacroproceso').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,
        paginate: false,
        info: false,

        ajax: `${SITEURL}/administrativo/detalles/macroproceso/${macroproceso}`,

        columns: [
            {
                data: 'macroproceso.nombre',
                name: 'macroproceso.nombre'
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
function ajaxFormRegisterDetalleMacroProceso(event) {
    event.preventDefault();

    btnSaveDetalleMacroProceso.value = "Enviando...";
    const dataRegister = new FormData(formDetalleMacroProcesoRegister);

    fetch(formDetalleMacroProcesoRegister.action, {
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
                        dtDetalleMacroProceso.draw();
                        document.getElementById("btnSaveDetalleMacroProceso").value = "Enviar";
                        $('#formDetalleMacroProcesoRegister').trigger("reset");
                        $('#modalDetalleMacroProcesoRegister').modal('hide');
                    });
                    document.getElementById("btnSaveDetalleMacroProceso").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formDetalleMacroProcesoRegister.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnSaveDetalleMacroProceso").value = "Enviar";
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

// Traer datos de DetalleMacroProceso
function editarDetalleMacroProceso(ente_id) {

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
                        formDetalleMacroProcesoUpdate.id.value = success.id;
                        formDetalleMacroProcesoUpdate.nombre.value = success.nombre;
                        formDetalleMacroProcesoUpdate.descripcion.value = success.descripcion;
                        $('#modalDetalleMacroProcesoUpdate').modal('show')
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
function ajaxFormUpdateDetalleMacroProceso(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formDetalleMacroProcesoUpdate);
    btnUpdateDetalleMacroProceso.value = "Enviando..."

    fetch(formDetalleMacroProcesoUpdate.action, {
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
                        dtDetalleMacroProceso.draw();
                        document.getElementById("btnUpdateDetalleMacroProceso").value = "Enviar";
                        $('#formDetalleMacroProcesoUpdate').trigger("reset");
                        $('#modalDetalleMacroProcesoUpdate').modal('hide');
                    });
                    document.getElementById("btnUpdateDetalleMacroProceso").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formDetalleMacroProcesoUpdate.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnUpdateDetalleMacroProceso").value = "Enviar";
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

// Eliminar DetalleMacroProceso
function eliminarDetalleMacroProceso(ente_id) {
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
                                    dtDetalleMacroProceso.draw();
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
