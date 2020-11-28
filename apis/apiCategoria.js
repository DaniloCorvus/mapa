let btnSaveCategoria = document.getElementById("btnSaveCategoria");
let btnUpdateCategoria = document.getElementById("btnUpdateCategoria");

let formCategoriaRegister = document.getElementById('formCategoriaRegister');
formCategoriaRegister.addEventListener('submit', ajaxFormRegisterCategoria);

let formCategoriaUpdate = document.getElementById('formCategoriaUpdate');
formCategoriaUpdate.addEventListener('submit', ajaxFormUpdateCategoria);

document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dtCategoria = $('#dataTablecategorias').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,
        paginate: false,
        info: false,

        ajax: `${SITEURL}/administrativo/categorias`,

        columns: [{
            data: 'nombre',
            name: 'nombre',
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
function ajaxFormRegisterCategoria(event) {
    event.preventDefault();

    btnSaveCategoria.value = "Enviando...";
    const dataRegister = new FormData(formCategoriaRegister);

    fetch(formCategoriaRegister.action, {
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
                        dtCategoria.draw();
                        document.getElementById("btnSaveCategoria").value = "Enviar";
                        $('#formCategoriaRegister').trigger("reset");
                        $('#modalCategoriaRegister').modal('hide');
                    });
                    document.getElementById("btnSaveCategoria").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formCategoriaRegister.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnSaveCategoria").value = "Enviar";
                    });
                    break;
                default:
                    throw response.json().then(error => {
                        // return new Error(error);
                        for (var clave in error) {
                            console.log(error[clave]);
                        }
                    })
                    // throw response.json().then(error => {
                    //     throw new Error(error); // (*)
                    // })

                    break;
            }
        })
        .catch(error => {
            console.log(JSON.parse(error));
        });
}

// Traer datos de Categoria
function editarCategoria(ente_id) {

    const url = `${SITEURL}/categorias/${ente_id}/edit`

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
                        formCategoriaUpdate.id.value = success.id;
                        formCategoriaUpdate.nombre.value = success.nombre;
                        formCategoriaUpdate.descripcion.value = success.descripcion;
                        $('#modalCategoriaUpdate').modal('show')
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
function ajaxFormUpdateCategoria(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formCategoriaUpdate);
    btnUpdateCategoria.value = "Enviando..."

    fetch(formCategoriaUpdate.action, {
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
                        dtCategoria.draw();
                        document.getElementById("btnUpdateCategoria").value = "Enviar";
                        $('#formCategoriaUpdate').trigger("reset");
                        $('#modalCategoriaUpdate').modal('hide');
                    });
                    document.getElementById("btnUpdateCategoria").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formCategoriaUpdate.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnUpdateCategoria").value = "Enviar";
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

// Eliminar Categoria
function eliminarCategoria(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = `${SITEURL}/categorias/${ente_id}`

                // $.ajax({
                //     url: url,
                //     type: 'DELETE',
                //     headers: {
                //         accept: "application/json",
                //         'X-CSRF-TOKEN': document.querySelector('#csrf_token').getAttribute('content')
                //     },
                //     success: function (respuesta) {
                //         console.log(respuesta.name);
                //     },
                //     error: function (error) {
                //         console.error("No es posible completar la operación", error);
                //     }
                // });

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
                                    dtCategoria.draw();
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
function verProcesos(ente_id) {
    var url = `${SITEURL}/administrativo/categorias/${ente_id}`
    window.location.href = url;
};

// ver 
function verDetalles(ente_id) {
    var url = `${SITEURL}/administrativo/detalles/categoria/${ente_id}`
    window.location.href = url;
};
