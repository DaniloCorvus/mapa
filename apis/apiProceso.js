let btnSaveProceso = document.getElementById("btnSaveProceso");
let btnUpdateProceso = document.getElementById("btnUpdateProceso");

let formProcesoRegister = document.getElementById('formProcesoRegister');
formProcesoRegister.addEventListener('submit', ajaxFormRegisterProceso);

let formProcesoUpdate = document.getElementById('formProcesoUpdate');
formProcesoUpdate.addEventListener('submit', ajaxFormUpdateProceso);

document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dtProceso = $('#dataTableprocesos').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,
        paginate: false,
        info: false,

        ajax: `${SITEURL}/administrativo/procesos/${categoria}`,

        columns: [{
                data: 'categoria.nombre',
                name: 'categoria.nombre'
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
function ajaxFormRegisterProceso(event) {
    event.preventDefault();

    btnSaveProceso.value = "Enviando...";
    const dataRegister = new FormData(formProcesoRegister);

    fetch(formProcesoRegister.action, {
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
                        dtProceso.draw();
                        document.getElementById("btnSaveProceso").value = "Enviar";
                        $('#formProcesoRegister').trigger("reset");
                        $('#modalProcesoRegister').modal('hide');
                    });
                    document.getElementById("btnSaveProceso").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formProcesoRegister.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnSaveProceso").value = "Enviar";
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

// Traer datos de Proceso
function editarProceso(ente_id) {

    const url = `${SITEURL}/procesos/${ente_id}/edit`

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
                        formProcesoUpdate.id.value = success.id;
                        formProcesoUpdate.categoria_id.value = success.categoria_id;
                        formProcesoUpdate.nombre.value = success.nombre;
                        formProcesoUpdate.descripcion.value = success.descripcion;
                        $('#modalProcesoUpdate').modal('show')
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
function ajaxFormUpdateProceso(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formProcesoUpdate);
    btnUpdateProceso.value = "Enviando..."

    fetch(formProcesoUpdate.action, {
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
                        dtProceso.draw();
                        document.getElementById("btnUpdateProceso").value = "Enviar";
                        $('#formProcesoUpdate').trigger("reset");
                        $('#modalProcesoUpdate').modal('hide');
                    });
                    document.getElementById("btnUpdateProceso").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formProcesoUpdate.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnUpdateProceso").value = "Enviar";
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

// Eliminar Proceso
function eliminarProceso(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = `${SITEURL}/procesos/${ente_id}`
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
                                    dtProceso.draw();
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
    var url = `${SITEURL}/procesos/${ente_id}`
    window.location.href = url;
};


// ver 
function verMacroProceso(ente_id) {
    var url = `${SITEURL}/administrativo/macroprocesos/${ente_id}`
    window.location.href = url;
};

// ver 
function verDetalles(ente_id) {
    var url = `${SITEURL}/administrativo/detalles/proceso/${ente_id}`
    window.location.href = url;
};
