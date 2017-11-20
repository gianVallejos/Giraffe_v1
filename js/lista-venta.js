function mostrarDetalleVenta(php_data){
    var venta = JSON.parse(php_data);
    var idVenta = venta["id"];
    console.log(idVenta);

    $('#nro-venta').text("00-0" + venta["id"]);
    $('#fecha-txt').text(venta["fecha"]);
    $('#cajero-txt').text(venta["cajero"]);
    $('#monto-venta-txt').text('S/ ' + venta["monto"]);
    if( venta["pago"] != null ){
      $('#monto-cliente-txt').text('S/ ' + venta["pago"]);
    }

    $.ajax({
        type: 'GET',
        url: '/Giraffe_v1/api-v1/get-detalle-venta/'+ idVenta,
        data: {},
        success: function(data){
            var detalle_venta = JSON.parse(data);
            showInTable(detalle_venta, venta["monto"]);
        },
        error: function(){
            alertMessage('Error', 'Error al obtener detalles de venta', 'error');
        }
    });

    $('#detalle-venta-modal').modal('toggle');
}

function showInTable(detalle_venta, venta_monto){
    console.log(detalle_venta, venta_monto);
    var string = '', foot = '';

    for(var i = 0; i < detalle_venta.length; i++ ){
      string += "<tr>";
        string += "<td class='text-center'>"+ (i+1) +"</td>";
        string += "<td class='text-center'>"+ detalle_venta[i]["cantidad"] +"</td>";
        string += "<td class='text-center'>"+ detalle_venta[i]["nombre"] + " " + mostrarDetalle(detalle_venta[i]["descripcion"]) + "</td>";
        string += "<td class='text-center'>"+ detalle_venta[i]["precio"] +"</td>";
        string += "<td class='text-center'>"+ round(parseFloat(detalle_venta[i]["precio"]) * parseFloat(detalle_venta[i]["cantidad"]), 2) +"</td>";
      string += "</tr>";
    }

    $('#detalle-venta-table > tbody ').empty();
    $('#detalle-venta-table > tbody ').append(string);

    foot += '<tr>';
    foot +=    '<td></td><td></td><td></td><td></td><td class="text-center"><strong>S/ ' + venta_monto +'</strong></td>';
    foot += '</tr>';

    $('#detalle-venta-table > tfoot').empty();
    $('#detalle-venta-table > tfoot').append(foot);
}
