// $(document).ready(function(){

function changeText(obj) {
    var trackNumber = document.getElementById("trackNumber");
    switch (trackType.selectedIndex) {
        case 0:
            trackNumber.placeholder = "Ingresa el número de orden del servicio";
            trackNumber.type = "text";
            trackNumber.attributes["type"] = "text";
            trackNumber.setAttribute('type', 'text');
            break;
        case 1:
            trackNumber.placeholder = "Ingresa el número de Referencia del equipo";
            trackNumber.type = "text";
            trackNumber.attributes["type"] = "text";
            trackNumber.setAttribute('type', 'text');
            break;
        case 2:
            trackNumber.placeholder = "Ingresa el número de Cedula";
            trackNumber.type = "number";
            trackNumber.attributes["type"] = "number";
            trackNumber.setAttribute('type', 'number');
            break;
        case 3:
            trackNumber.placeholder = "Ingresa el número de Nit";
            trackNumber.type = "text";
            trackNumber.attributes["type"] = "text";
            trackNumber.setAttribute('type', 'text');
            break;
        case 4:
            trackNumber.placeholder = "Ingresa el número de pasaporte";
            trackNumber.type = "text";
            trackNumber.attributes["type"] = "text";
            trackNumber.setAttribute('type', 'text');
            break;
        case 5:
            trackNumber.placeholder = "Ingresa el número de Serial del equipo";
            trackNumber.type = "number";
            trackNumber.attributes["type"] = "number";
            trackNumber.setAttribute('type', 'number');
            break;
    }
}

