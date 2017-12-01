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

/* Buscar Reporte Venta */
$('#form-buscarVentas').submit(function (event) {
    event.preventDefault();

    var fechaInicial = $('#fechainicial').val();
    var fechaFinal = $('#fechafinal').val();
    var personalId = $('#personalId').val();

    console.log(personalId, fechaInicial, fechaFinal);

    if (fechaInicial == "" && fechaFinal == "" && personalId != -1) {
        $.ajax({
            type: 'GET',
            url: 'http://localhost/Giraffe_v1/api-v1/get-buscarReporteVentaPersonaId/' + personalId,
            dataType: 'json',
            contentType: "application/json; charset=utf-8",

            success: function (data) {
                dataPdf = data;
                console.log(data);
                agregarATabla(data, 'tablaVentas');
            },
            error: function () {
                swal('Atención', 'Ha ocurrido un problema. Contactar con el webmaster', 'warning');
            }
        });
    } else if (fechaInicial != "" && fechaFinal != "" && personalId == -1) {
        if (validarFechas(fechaInicial, fechaFinal)) {
            $.ajax({
                type: 'GET',
                url: 'http://localhost/Giraffe_v1/api-v1/get-buscarReporteVentaDates/' + fechaInicial + '/' + fechaFinal,
                dataType: 'json',
                contentType: "application/json; charset=utf-8",

                success: function (data) {
                    console.log(data);
                    agregarATabla(data, 'tablaVentas');
                },
                error: function () {
                    swal('Atención', 'Ha ocurrido un problema. Contactar con el webmaster', 'warning');
                }
            });
        }
    } else if (fechaInicial != "" && fechaFinal != "" && personalId != -1) {
        if (validarFechas(fechaInicial, fechaFinal)) {
            $.ajax({
                type: 'GET',
                url: 'http://localhost/Giraffe_v1/api-v1/get-buscarReporteVenta/' + fechaInicial + '/' + fechaFinal + '/' + personalId,
                dataType: 'json',
                contentType: "application/json; charset=utf-8",

                success: function (data) {
                    dataPdf = data;
                    console.log(data);
                    agregarATabla(data, 'tablaVentas');
                },
                error: function () {
                    swal('Atención', 'Ha ocurrido un problema. Contactar con el webmaster', 'warning');
                }
            });
        }
    } else if (fechaInicial == "" && fechaFinal == "" && personalId == -1) {

        $.ajax({
            type: 'GET',
            url: 'http://localhost/Giraffe_v1/api-v1/get-buscarReporteVentaPersonaId/' + personalId,
            dataType: 'json',
            contentType: "application/json; charset=utf-8",

            success: function (data) {
                dataPdf = JSON.parse(data);
                console.log(data);
                agregarATabla(data, 'tablaVentas');
            },
            error: function () {
                swal('Atención', 'Ha ocurrido un problema. Contactar con el webmaster', 'warning');
            }
        });

    }

})
;

$('#btn-download-reporte').click(function (event) {
    event.preventDefault();

    var fechaInicial = $('#fechainicial').val();
    var fechaFinal = $('#fechafinal').val();
    var personalId = $('#personalId').val();

    if (fechaInicial == "" && fechaFinal == ""){
        fechaInicial = -1;
        fechaFinal = -1;
    }

    console.log(personalId, fechaInicial, fechaFinal);

    $.ajax({
        type: 'GET',
        url: 'http://localhost/Giraffe_v1/api-v1/put-downloadpdf/',
        dataType: 'json',
        data: {fechainicial: fechaInicial,
               fechafinal: fechaFinal,
               personaid: personalId},
        contentType: "application/json; charset=utf-8",
        success: function () {
            // swal('Enviado');
        },
        error: function () {
            swal('Atención', 'Ha ocurrido un problema. Contactar con el webmaster', 'warning');
        }
    });
});

function agregarATabla(data, table_id) {

    var rowsContent = '';
    var list = data[ind];
    for (var ind = 0; ind < data.length; ind++) {
        rowsContent += '<tr>' +
            '<td scope="row" class="text-center">' + (ind + 1) + '</td>' +
            '<td class="text-center">' + data[ind]["fecha"] + '</td>' +
            '<td class="text-center">' + data[ind]["cajero"] + '</td>' +
            '<td class="text-center">' + data[ind]["monto"] + '</td>' +
            '<td class="text-center">' +
            '<button class="btn btn-xs btn-success" onclick="mostrarDetalleVentaList(' + data[ind]["id"] + ')" data-toggle="modal" data-target="#myModal">' + 'Detalle Venta' + '</button>' +
            '</td>' +
            '</tr>';
    }

    $('#' + table_id + ' tbody').empty();
    $('#' + table_id + ' tbody').append(rowsContent);

}

function validarFechas(date_inicio, date_fin) {
    if (date_inicio == '') {
        swal('Alerta', 'Para buscar debe seleccionar una fecha inicial', 'warning', 1000);
        return false;
    }

    if (date_fin == '') {
        swal('Alerta', 'Para buscar debe seleccionar una fecha final', 'warning', 1000);
        $('#fechafinal').focus();
        return false;
    }

    return true;
}