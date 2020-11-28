let btnSaveDetalle = document.getElementById("btnSaveDetalle");
let btnUpdateDetalle = document.getElementById("btnUpdateDetalle");

let formDetalleRegister = document.getElementById('formDetalleRegister');
formDetalleRegister.addEventListener('submit', ajaxFormRegisterDetalle);

let formDetalleUpdate = document.getElementById('formDetalleUpdate');
formDetalleUpdate.addEventListener('submit', ajaxFormUpdateDetalle);

document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dtDetalle = $('#dataTabledetalles').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,
        paginate: false,
        info: false,

        ajax: `${SITEURL}/administrativo/detalles/categoria/${categoria}`,

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
function ajaxFormRegisterDetalle(event) {
    event.preventDefault();

    btnSaveDetalle.value = "Enviando...";
    const dataRegister = new FormData(formDetalleRegister);

    fetch(formDetalleRegister.action, {
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
                        dtDetalle.draw();
                        document.getElementById("btnSaveDetalle").value = "Enviar";
                        $('#formDetalleRegister').trigger("reset");
                        $('#modalDetalleRegister').modal('hide');
                    });
                    document.getElementById("btnSaveDetalle").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formDetalleRegister.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnSaveDetalle").value = "Enviar";
                    });
                    break;
                default:
                    throw response.json().then(error => {
                        console.log(error);
                        // for (var clave in error) {
                        //     console.log(error[clave]);
                        // }
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

// Traer datos de Detalle
function editarDetalle(ente_id) {

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
                        formDetalleUpdate.id.value = success.id;
                        formDetalleUpdate.nombre.value = success.nombre;
                        formDetalleUpdate.descripcion.value = success.descripcion;
                        $('#modalDetalleUpdate').modal('show')
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
function ajaxFormUpdateDetalle(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formDetalleUpdate);
    btnUpdateDetalle.value = "Enviando..."

    fetch(formDetalleUpdate.action, {
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
                        dtDetalle.draw();
                        document.getElementById("btnUpdateDetalle").value = "Enviar";
                        $('#formDetalleUpdate').trigger("reset");
                        $('#modalDetalleUpdate').modal('hide');
                    });
                    document.getElementById("btnUpdateDetalle").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formDetalleUpdate.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnUpdateDetalle").value = "Enviar";
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

// Eliminar Detalle
function eliminarDetalle(ente_id) {
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
                                    dtDetalle.draw();
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
function verSubDetalle(ente_id) {
    var url = `${SITEURL}/detalles/${ente_id}`
    window.location.href = url;
};
