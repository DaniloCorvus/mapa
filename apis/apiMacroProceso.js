let btnSaveMacroProceso = document.getElementById("btnSaveMacroProceso");
let btnUpdateMacroProceso = document.getElementById("btnUpdateMacroProceso");

let formMacroProcesoRegister = document.getElementById('formMacroProcesoRegister');
formMacroProcesoRegister.addEventListener('submit', ajaxFormRegisterMacroProceso);

let formMacroProcesoUpdate = document.getElementById('formMacroProcesoUpdate');
formMacroProcesoUpdate.addEventListener('submit', ajaxFormUpdateMacroProceso);

document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    // $.fn.dataTable.ext.errMode = 'none';
    dtMacroProceso = $('#dataTablemacroprocesos').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,
        paginate: false,
        info: false,

        ajax: `${SITEURL}/administrativo/macroprocesos/${proceso}`,

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
function ajaxFormRegisterMacroProceso(event) {
    event.preventDefault();

    btnSaveMacroProceso.value = "Enviando...";
    const dataRegister = new FormData(formMacroProcesoRegister);

    fetch(formMacroProcesoRegister.action, {
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
                        dtMacroProceso.draw();
                        document.getElementById("btnSaveMacroProceso").value = "Enviar";
                        $('#formMacroProcesoRegister').trigger("reset");
                        $('#modalMacroProcesoRegister').modal('hide');
                    });
                    document.getElementById("btnSaveMacroProceso").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formMacroProcesoRegister.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnSaveMacroProceso").value = "Enviar";
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

// Traer datos de MacroProceso
function editarMacroProceso(ente_id) {

    const url = `${SITEURL}/macroprocesos/${ente_id}/edit`

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
                        formMacroProcesoUpdate.id.value = success.id;
                        formMacroProcesoUpdate.nombre.value = success.nombre;
                        formMacroProcesoUpdate.descripcion.value = success.descripcion;
                        $('#modalMacroProcesoUpdate').modal('show')
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
function ajaxFormUpdateMacroProceso(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formMacroProcesoUpdate);
    btnUpdateMacroProceso.value = "Enviando..."

    fetch(formMacroProcesoUpdate.action, {
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
                        dtMacroProceso.draw();
                        document.getElementById("btnUpdateMacroProceso").value = "Enviar";
                        $('#formMacroProcesoUpdate').trigger("reset");
                        $('#modalMacroProcesoUpdate').modal('hide');
                    });
                    document.getElementById("btnUpdateMacroProceso").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formMacroProcesoUpdate.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnUpdateMacroProceso").value = "Enviar";
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

// Eliminar MacroProceso
function eliminarMacroProceso(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = `${SITEURL}/macroprocesos/${ente_id}`
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
                                    dtMacroProceso.draw();
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


// // ver 
// function verMacroProceso(ente_id) {
//     var url = `${SITEURL}/macroprocesos/${ente_id}`
//     window.location.href = url;
// };

// ver 
function verDetalles(ente_id) {
    var url = `${SITEURL}/administrativo/detalles/macroproceso/${ente_id}`
    window.location.href = url;
};
