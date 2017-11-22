function mostrarDetallePersonal(php_data) {
    console.log(JSON.parse(php_data));
    data = JSON.parse(php_data);
    $('#email-txt').text(data["email"]);
    $('#nombres-txt').text(data["nombres"] + " " + data["apellidos"]);
    $('#dni-txt').text(data["dni"]);
    $('#fechanacimiento-txt').text(data["fechanacimiento"]);
    $('#telefono-txt').text(data["telefono"]);
    $('#genero-txt').text(data["genero"]);
    $('#direccion-txt').text(data["direccion"]);
}

function mostrarDetalleCliente(php_data) {
    console.log(JSON.parse(php_data));
    data = JSON.parse(php_data);
    $('#nombres-txt').text(data["nombres"] + " " + data["apellidos"]);
    $('#dni-txt').text(data["dni"]);
    $('#email-txt').text(data["email"]);
    $('#direccion-txt').text(data["direccion"]);
    $('#fechanacimiento-txt').text(data["fechanacimiento"]);
    $('#genero-txt').text(data["genero"]);
    $('#telefono-txt').text(data["telefono"]);
    $('#celular-txt').text(data["celular"]);
}

function mostrarDetalleKardex(php_data) {
    console.log(JSON.parse(php_data));
    data = JSON.parse(php_data);
    $('#nombre-txt').text(data["nombre"]);
    $('#concepto-txt').text(data["concepto"]);
    $('#fecha-txt').text(data["fecha"]);
    $('#factura-txt').text(data["factura"]);
    $('#cantidad-txt').text(data["cantidad"]);
    $('#preciounitario-txt').text(data["preciounitario"]);
    $('#cantidadexistencia-txt').text(data["cantidadexistencia"]);
}