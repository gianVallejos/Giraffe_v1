function mostrarDetallePersonal(php_data) {

    // console.log(JSON.parse(php_data));

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

    // console.log(JSON.parse(php_data));

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

function mostrarDetalleVenta(php_data) {
    var venta = JSON.parse(php_data);
    var idVenta = venta["id"];
    console.log(idVenta);

    $('#nro-venta').text("00-0" + venta["id"]);
    $('#fecha-txt').text(venta["fecha"]);
    $('#cajero-txt').text(venta["cajero"]);
    $('#monto-venta-txt').text('S/ ' + venta["monto"]);
    if (venta["pago"] != null) {
        $('#monto-cliente-txt').text('S/ ' + venta["pago"]);
    }

    $.ajax({
        type: 'GET',
        url: '/Giraffe_v1/api-v1/get-detalle-venta/' + idVenta,
        data: {},
        success: function (data) {
            var detalle_venta = JSON.parse(data);
            showInTable(detalle_venta, venta["monto"]);
        },
        error: function () {
            alertMessage('Error', 'Error al obtener detalles de venta', 'error');
        }
    });

    $('#detalle-venta-modal').modal('toggle');
}

function showInTable(detalle_venta, venta_monto) {
    console.log(detalle_venta, venta_monto);
    var string = '', foot = '';

    for (var i = 0; i < detalle_venta.length; i++) {
        string += "<tr>";
        string += "<td class='text-center'>" + (i + 1) + "</td>";
        string += "<td class='text-center'>" + detalle_venta[i]["cantidad"] + "</td>";
        string += "<td class='text-center'>" + detalle_venta[i]["nombre"] + " " + mostrarDetalle(detalle_venta[i]["descripcion"]) + "</td>";
        string += "<td class='text-center'>" + detalle_venta[i]["precio"] + "</td>";
        string += "<td class='text-center'>" + round(parseFloat(detalle_venta[i]["precio"]) * parseFloat(detalle_venta[i]["cantidad"]), 2) + "</td>";
        string += "</tr>";
    }

    $('#detalle-venta-table > tbody ').empty();
    $('#detalle-venta-table > tbody ').append(string);

    foot += '<tr>';
    foot += '<td></td><td></td><td></td><td></td><td class="text-center"><strong>S/ ' + venta_monto + '</strong></td>';
    foot += '</tr>';

    $('#detalle-venta-table > tfoot').empty();
    $('#detalle-venta-table > tfoot').append(foot);
}
