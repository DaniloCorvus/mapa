var SITEURL = document.location.origin;
var formEmpresaRegister = document.getElementById('formEmpresaRegister');
formEmpresaRegister.addEventListener('submit', ajaxFormRegisterEmpresas);


//Envio de datos ajax
function ajaxFormRegisterEmpresas(event) {

    event.preventDefault();

    document.getElementById("btnSaveEmpresa").value = "Enviando...";

    const dataRegister = new FormData(formEmpresaRegister);

    fetch(formEmpresaRegister.action, {
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
                    // console.log(success);
                    location.reload();
                })
                document.getElementById("btnSaveEmpresa").value = "Enviar";
            } else {
                response.json().then(error => {
                    Object.keys(error.errors).forEach(key => {
                        toastr.error('Error', error.errors[key])
                    })
                    // console.log(error);
                });
                document.getElementById("btnSaveEmpresa").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        })
}

// Traer datos de cliente

document.addEventListener('DOMContentLoaded', function () {

    const url = SITEURL + '/empresa/'
    fetch(url, {
            // method: 'GET',
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => {
            if (response.ok) {
                response.json().then(success => {
                    formEmpresaRegister.id.value = success.id;
                    formEmpresaRegister.nombre.value = success.nombre;
                    formEmpresaRegister.nit.value = success.nit;
                    formEmpresaRegister.email.value = success.email;
                    formEmpresaRegister.direccion.value = success.direccion;
                    formEmpresaRegister.telefono.value = success.telefono;
                    formEmpresaRegister.publicidad.value = success.publicidad;
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });

});
