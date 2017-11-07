var montoDeVenta = 0;
var nroProductosCartShopping = 0;
var cartShopping = new Array();

var mv;
var st;
var igv;

function addProductToCart(actualProducto){
    var producto = JSON.parse(actualProducto);

    cartShopping[nroProductosCartShopping] = [producto["id"], producto["nombre"], producto["descripcion"], producto["precio"]];

    var aux = nroProductosCartShopping + ", " + producto["id"];
    var script = '<tr id="'+ nroProductosCartShopping + "-" + producto["id"] + '">' +
                    // '<td>'+ cnt +'</td>' +
                    '<td class="text-left">'+ producto["nombre"]+'<br><span>'+ mostrarDetalle(producto["descripcion"]) + '</span></td>' +
                    '<td id="precio">'+ producto["precio"]+'</td>' +
                    // '<td>' +
                    // '<a href="#" onclick="removeProductFromCart('+ aux +')" class="btn-giraffe-icon flaticon-rounded-remove-button"></a>'
                    // '</td>' +
                  '<tr>';
    $('#CartShoppingTable tr:last').after(script);

    nroProductosCartShopping++;
    montoDeVenta += parseFloat(producto["precio"]);

    addTotalVenta(montoDeVenta);
}

function round(num,dec){
    return Number(num).toFixed(2);
}

function addTotalVenta(montoDeVenta){
    mv = round(montoDeVenta, 2);
    st = round(montoDeVenta/1.18, 2);
    igv = round(st * 0.18, 2);

    $('#subtotal').text("S/ " + st);
    $('#igv').text("S/ " + igv);
    $('#total').text("S/ " + mv);
}

function removeProductFromCart(nroProductosCartShopping, id){
    idRow = nroProductosCartShopping + "-" + id;
    precio = parseFloat($('#CartShoppingTable #'+ idRow +' #precio').text());

    montoDeVenta -= precio;
    addTotalVenta(montoDeVenta);

    $('#CartShoppingTable #' + idRow).remove();

    cartShopping.splice(nroProductosCartShopping, 1);

    console.log(cartShopping);
    console.log(nroProductosCartShopping);

}

function buscarProducto(){
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablaProductos");
    tr = table.getElementsByTagName("tr");

    for(i = 0; i < tr.length; i++){
        td = tr[i].getElementsByTagName("td")[1];
        if(td){
            if(td.innerHTML.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display = "";
            }else{
                tr[i].style.display = "none";
            }
        }
    }
}

function mostrarDetalle(detalle){
    if( detalle == null ){
        return '';
    }
    return detalle;
}

$(document).ready(function(){
    $(document).ajaxStart(function(){
        $("#load-container").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#load-container").css("display", "none");
    });

    $('#btn-nuevo').click(function(){
        resetDataOfPages();
    });

    $('#btn-pagar').click(function(){
      guardarVenta(cartShopping);
    });

    $.fn.rowCount = function() {
    return $('tr', $(this).find('tbody')).length;
    };

    function guardarVenta(cartShopping){
      if( cartShopping.length == 0 ){
          swal ( "Alerta" ,  "Debe agregar productos a la cesta de venta para efectuar la operación." ,  "warning" );
      }else{
          $.ajax({
              type: 'GET',
              url: 'http://localhost/giraffe/public/api-v1/save-venta',
              dataType: 'json',
              contentType: "application/json; charset=utf-8",
              data: {
                  cartShopping: cartShopping
              },
              success: function(data){
                  console.log(data);
                  $('#modalPagar').modal('toggle');
                  //Generate Voucher HTML
                  generateHTMLVoucher(cartShopping, data['idVenta']);
              },
              error: function(){
                  swal ( "Error!" ,  "Ha ocurrido un problema. Contactar con el webmaster" ,  "error" );
              }
          });
      }
    }

    $("#modalPagar").on("hidden.bs.modal", function () {
        //Reset Data of Pages
        resetDataOfPages();
    });

    function writeMonth(){
        switch(new Date().getMonth()){
            case 0:
              return 'ENE';
            case 1:
              return 'FEB';
            case 2:
              return 'MAR';
            case 3:
              return 'ABR';
            case 4:
              return 'MAY';
            case 5:
              return 'JUN';
            case 6:
              return 'JUL';
            case 7:
              return 'AGO';
            case 8:
              return 'SEP';
            case 9:
              return 'OCT';
            case 10:
              return 'NOV';
            case 11:
              return 'DIC';
        }
    }

    function generateHTMLVoucher(cartShopping, idVenta){
      var total = "0.00";
      var nombre_empresa = "GIRAFFE-Café Helados";
      var ruc = "1045880521";
      var direccion = "Jr. Junin 1101"
      var sede = "Cajamarca";
      var dt = new Date();
      var fecha = dt.getDate() + '' +  writeMonth() + '' + dt.getFullYear();
      var hora = dt.getHours() + ":" + dt.getMinutes();

      var string =   '<div class="row">' +
                        '<div class="col-md-12 col-xs-12 text-center">' +
                          '<span>Ticket de Venta Nro: 0000-'+ idVenta +'</span>' +
                          '<br><span>'+ nombre_empresa +'</span>' +
                          '<br><span>RUC: '+ ruc +'</span>' +
                          '<br><span>'+ direccion + ' - ' + sede +'</span>' +
                        '</div>' +
                     '</div>' +
                     '<div class="row" style="padding-top: 12px;">' +
                        '<div class="col-md-6 col-xs-6 text-left">' +
                           'FECHA:' +
                           '<span>'+ fecha +'</span>' +
                        '</div>' +
                        '<div class="col-md-6 col-xs-6 text-right">' +
                           'HORA:' +
                           '<span>'+ hora +'</span>' +
                        '</div>' +
                      '</div>' +
                      '<div class="row">' +
                        '<div class="col-md-6 col-xs-6 text-left">PRODUCTO</div>' +
                        '<div class="col-md-6 col-xs-6 text-right">PRECIO (S/)</div>' +
                      '</div>' +
                      '<div class="row text-left" style="padding-left: 7px;">';
                  console.log(cartShopping);
                  for(var i = 0; i < cartShopping.length; i++){
                      string += '<div class="col-md-8 col-xs-8">' + cartShopping[i][1] + ' ' + mostrarDetalle(cartShopping[i][2]) + '</div>';
                      string += '<div class="col-md-4 col-xs-4 text-center">' + cartShopping[i][3] + '</div>';
                  }
      string +=
                       '</div>' +
                       '<div class="row" style="padding-top: 19px;">' +
                            '<div class="col-md-8 col-xs-8 text-right">SUBTOTAL: </div>' +
                            '<div class="col-md-4 col-xs-4 text-center" >S/ '+ st +'</div>' +
                       '</div>' +
                       '<div class="row">' +
                            '<div class="col-md-8 col-xs-8 text-right">IGV: </div>' +
                            '<div class="col-md-4 col-xs-4 text-center" >S/ '+ igv +'</div>' +
                       '</div>' +
                       '<div class="row">' +
                            '<div class="col-md-8 col-xs-8 text-right">TOTAL: </div>' +
                            '<div class="col-md-4 col-xs-4 text-center" >S/ ' + mv +'</div>' +
                       '</div>';
      $('#vouchercontent').html(string);
    }

    function mostrarDetalle(detalle){
        if( detalle == null ){
            return '';
        }
        return detalle;
    }

    $('#btn-print-voucher').click(function(){
        $('#vouchercontent').printThis();
    });

    function resetDataOfPages(){
        cartShopping = new Array();
        montoDeVenta = 0;
        nroProductosCartShopping = 0;

        var script = '<thead>' +
                        '<tr>' +
                            '<th class="text-center">Producto</th>' +
                            '<th class="text-center">Precio</th>' +
                            '<th class="col-md-1 col-xs-1"></th>' +
                        '</tr>' +
                    '</thead>' +
                    '<tbody class="text-center">' +
                        '<tr>' +
                        '</tr>' +
                    '</tbody>';

        $('#CartShoppingTable').empty();
        $('#CartShoppingTable').html(script);

        addTotalVenta(montoDeVenta);
    }
});
