
document.addEventListener('DOMContentLoaded', function () {
    $.fn.dataTable.ext.errMode = 'none';

    // datatables settings
    var dtUsers = $('#dataTableUsers').DataTable({

        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/users/",

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },

            {
                data: 'action',
                name: 'action',
                orderable: false
            },
        ],
        order: [
            [0, 'asc']
        ],

        language: {
            paginate: {
                first: "",
                previous: " ← ",
                next: " → ",
                last: ""
            },
        }

    });

});


//Envio de datos ajax
function ajaxFormRegisterUsers(event) {

    event.preventDefault();

    document.getElementById("btnSaveUser").value = "Enviando...";

    const dataRegister = new FormData(formUserRegister);

    fetch(formUserRegister.action, {
            method: 'POST',
            body: dataRegister,
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => {
            if (response.ok) {
                response.text().then(success => {
                    toastr.info('Success', success)
                    dtUsers.draw();
                    $('#formUserRegister').trigger("reset");
                    $('#modalUserRegister').modal('hide');
                })
                document.getElementById("btnSaveUser").value = "Enviar";
            } else {
                response.json().then(error => {
                    Object.keys(error.errors).forEach(key => {
                        toastr.error('Error', error.errors[key])
                    })
                    // console.log(error);
                });
                document.getElementById("btnSaveUser").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        })
}

// Traer datos de cliente
function editarUser(ente_id) {
    const url = SITEURL + '/users/' + ente_id + '/edit'
    const formUserUpdate = document.getElementById('formUserUpdate');
    fetch(url, {
            method: 'GET',
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => {
            if (response.ok) {
                response.json().then(success => {
                    formUserUpdate.id.value = success.id;
                    formUserUpdate.nombre.value = success.nombre;
                    formUserUpdate.apellido.value = success.apellido;
                    formUserUpdate.email.value = success.email;
                    formUserUpdate.tipo_identificacion.value = success.tipo_identificacion;
                    formUserUpdate.identificacion.value = success.identificacion;
                    formUserUpdate.direccion.value = success.direccion;
                    formUserUpdate.ciudad.value = success.ciudad;
                    formUserUpdate.departamento.value = success.departamento;
                    formUserUpdate.barrio.value = success.barrio;
                    formUserUpdate.telefono.value = success.telefono;
                    formUserUpdate.opcional_telefono.value = success.opcional_telefono
                    $('#modalUserUpdate').modal('show')
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });
};


//Envio de datos ajax a actualizar
function ajaxFormUpdateUser(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formUserUpdate);
    document.getElementById("btnUpdateUser").value = "Enviando...";

    fetch(formUserUpdate.action, {
            method: 'POST',
            body: dataUpdate,
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => {
            if (response.ok) {
                response.text().then(success => {
                    toastr.info('Success', success)
                    dtUsers.draw();
                    $('#formUserUpdate').trigger("reset");
                    $('#modalUserUpdate').modal('hide');
                    document.getElementById("btnUpdateUser").value = "Enviar";
                })
            } else {
                response.json().then(error => {
                    console.log(error);
                    Object.keys(error.errors).forEach(key =>
                        toastr.error('Error', error.errors[key]))
                })

                document.getElementById("btnUpdateUser").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        });
}

// Eliminar User
function eliminarUser(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/users/' + ente_id
                fetch(url, {
                        method: 'DELETE',
                        mode: "cors",
                        headers: {
                            accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            response.text().then(success => {
                                // dtUsers.draw();
                                toastr.remove()
                                toastr.info('Success:', success);
                                location.reload();
                            });
                        } else {
                            response.text().then(error => {
                                // toastr.remove()
                                // toastr.error('Error:', error);
                                console.log('request failed', error);

                            })
                        }
                    })
                    .catch(error => {
                        console.log('request failed', error);
                    });
            } else {
                toastr.remove()
            }
        }
    });
}

