let btnSaveSubProceso = document.getElementById("btnSaveSubProceso");
let btnUpdateSubProceso = document.getElementById("btnUpdateSubProceso");

let formSubProcesoRegister = document.getElementById('formSubProcesoRegister');
formSubProcesoRegister.addEventListener('submit', ajaxFormRegisterSubProceso);

let formSubProcesoUpdate = document.getElementById('formSubProcesoUpdate');
formSubProcesoUpdate.addEventListener('submit', ajaxFormUpdateSubProceso);

document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    // $.fn.dataTable.ext.errMode = 'none';
    dtSubProceso = $('#dataTablesubprocesos').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,
        paginate: false,
        info: false,

        ajax: `${SITEURL}/administrativo/subprocesos/${proceso}`,

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
function ajaxFormRegisterSubProceso(event) {
    event.preventDefault();

    btnSaveSubProceso.value = "Enviando...";
    const dataRegister = new FormData(formSubProcesoRegister);

    fetch(formSubProcesoRegister.action, {
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
                        toastr.info('Success:', success);
                        dtSubProceso.draw();
                        document.getElementById("btnSaveSubProceso").value = "Enviar";
                        $('#formSubProcesoRegister').trigger("reset");
                        $('#modalSubProcesoRegister').modal('hide');
                    });
                    document.getElementById("btnSaveSubProceso").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formSubProcesoRegister.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnSaveSubProceso").value = "Enviar";
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

// Traer datos de SubProceso
function editarSubProceso(ente_id) {

    const url = `${SITEURL}/subprocesos/${ente_id}/edit`

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
                        formSubProcesoUpdate.id.value = success.id;
                        formSubProcesoUpdate.nombre.value = success.nombre;
                        formSubProcesoUpdate.descripcion.value = success.descripcion;
                        $('#modalSubProcesoUpdate').modal('show')
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
function ajaxFormUpdateSubProceso(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formSubProcesoUpdate);
    btnUpdateSubProceso.value = "Enviando..."

    fetch(formSubProcesoUpdate.action, {
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
                        dtSubProceso.draw();
                        document.getElementById("btnUpdateSubProceso").value = "Enviar";
                        $('#formSubProcesoUpdate').trigger("reset");
                        $('#modalSubProcesoUpdate').modal('hide');
                    });
                    document.getElementById("btnUpdateSubProceso").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formSubProcesoUpdate.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnUpdateSubProceso").value = "Enviar";
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

// Eliminar SubProceso
function eliminarSubProceso(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = `${SITEURL}/subprocesos/${ente_id}`
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
                                    dtSubProceso.draw();
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


// ver 
function verSubProceso(ente_id) {
    var url = `${SITEURL}/subprocesos/${ente_id}`
    window.location.href = url;
};

// ver 
function verDetalles(ente_id) {
    var url = `${SITEURL}/administrativo/detalles/subproceso/${ente_id}`
    window.location.href = url;
};
