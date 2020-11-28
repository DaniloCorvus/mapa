function editarArchivo(ente_id) {
    const url = SITEURL + '/archivos/' + ente_id + '/edit'
    const formArchivoUpdate = document.getElementById('formArchivoUpdate');
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
                    formArchivoUpdate.id.value = success.id;
                    formArchivoUpdate.title.value = success.nombre;
                    formArchivoUpdate.description.value = success.descripcion;
                    $('#modalArchivoUpdateForm').modal('show')
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });
};

