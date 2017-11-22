var nroProductosCartShopping = 0;
var cartShopping = new Array();
var actualIdVenta = -1;
var number_event = -1;

var mv;
var st;
var igv;

function addProductToCart(actualProducto){
  if( number_event != 13 ){
    var producto = JSON.parse(actualProducto);

    var ind_actual = productIdExistInCart(producto["id"], cartShopping, nroProductosCartShopping);

    if( ind_actual == -1 ){
      cartShopping[nroProductosCartShopping] = [producto["id"], producto["nombre"], producto["descripcion"], producto["precio"], 1];
      nroProductosCartShopping++;
    }else{
      cartShopping[ind_actual][4] = parseFloat(cartShopping[ind_actual][4]) + 1;
    }
    var evt = window.event || arguments.callee.caller.arguments[0];

    mostrarCartShopping(cartShopping, nroProductosCartShopping);
  }
  number_event = -1;
}

function productIdExistInCart(producto_id, cartShopping, nroProductosCartShopping){
  	if( nroProductosCartShopping == 0) return -1;

  	for(var ind = 0; ind < nroProductosCartShopping; ind++ ){
  	   if( cartShopping[ind][0] == producto_id ) return ind;
  	}
  	return -1;
}

function deleteProductFromCart(product_id){
    console.log(product_id);
  	if( nroProductosCartShopping == 0 ){
      swal('Error', 'Cart Shopping is Empty', 'Warning');
    }

  	var ind_actual = productIdExistInCart(product_id, cartShopping, nroProductosCartShopping);
  	if( ind_actual == -1 ){
  	    swal('Error', 'There is not product to delete', 'Warning');
  	}else{
        if( cartShopping[ind_actual][4] == 1 ){
      	    cartShopping.splice(ind_actual, 1);
      	    nroProductosCartShopping--;
        }else{
            cartShopping[ind_actual][4] = parseFloat(cartShopping[ind_actual][4]) - 1;
        }
  	}

  	mostrarCartShopping(cartShopping, nroProductosCartShopping);
}

function mostrarCartShopping(cartShopping, nroProductosCartShopping){
  resetTable();

	var montoDeVenta = 0;
	for( var ind = 0; ind < nroProductosCartShopping; ind++ ){
		var montoDeProducto = parseFloat(cartShopping[ind][3]) * parseFloat(cartShopping[ind][4]);
		var script = '<tr>' +
            				'<td>' + cartShopping[ind][4] + '</td>' +
            				'<td class="text-left">' + cartShopping[ind][1] +
            				'<br><span>' + mostrarDetalle(cartShopping[ind][2]) + '</span></td>' +
            				'<td id="precio">' + round(montoDeProducto, 2) + '</td>' +
            				'<td>' +
                        '<a href="#" onclick="deleteProductFromCart('+ cartShopping[ind][0] +')" class="btn-giraffe-icon flaticon-rounded-remove-button">' +
                    '</td>' +
			           '</tr>';
		montoDeVenta += montoDeProducto;
		$('#CartShoppingTable tr:last').after(script);
	}
	addTotalVenta(montoDeVenta);
}

function resetTable(){
    var script = '<thead>' +
                    '<tr>' +
                        '<th class="text-center">Cant.</th>' +
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

    $('#monto-pago').keyup(function(){
        vueltoFunction();
    });

    $("#monto-pago").on("keyup keydown change",function(event){
        vueltoFunction();
    });

    $('#modalPagar').on('shown.bs.modal', function () {
        $('#btn-print-voucher').focus();
    });

    $('body').keypress(function(e){
        number_event = e.which;

        if( number_event == 13 && $('#monto-pago').is(":focus") ){
            $('#btn-pagar').focus();
        }else if( ($("element").data('bs.modal') || {}).isShown && number_event == 13 ){
            resetDataOfPages();
            $('#modal').modal('toggle');            
        }else if( number_event == 13 ){
            $('#monto-pago').focus();
        }else if( number_event == 9 ){
            $('#vouchercontent').printThis();
        }

    });

    function vueltoFunction(){
        var vuelto = parseFloat(mv - parseFloat($('#monto-pago').val())) || 0;

        vuelto = vuelto * -1;
        if( vuelto < 0 ){
          $('#monto-vuelto').css("color", "#f00");
        }else{
          $('#monto-vuelto').css("color", "#000");
        }
        $('#monto-vuelto').val(round(vuelto, 2));
    }

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
      var montoCliente = $('#monto-pago').val();

      if( cartShopping.length == 0 ){
          swal({
              title: "No hay productos",
              text: "Debe agregar productos a la cesta de venta para efectuar la operación.",
              type: "warning",
              closeOnConfirm: false
          },
            function(){
                swal.close();
                $('#myInput').focus();
          });

      }else if( montoCliente == '' ){
          swal({
              title: "Pago del cliente está vacío",
              text: "Debe agregar un monto de pago por parte del cliente",
              type: "warning",
              closeOnConfirm: false
          },
            function(){
                swal.close();
                $('#monto-pago').focus();
          });
      }else if( parseFloat(montoCliente) < parseFloat(mv) ){
        swal({
            title: "Atención con el vuelto",
            text: "El pago del cliente debe ser mayor o igual al monto total de productos",
            type: "warning",
            closeOnConfirm: false
        },
          function(){
              swal.close();
              $('#monto-pago').focus();
        });
      }else{
        // console.log(cartShopping);
          $.ajax({
              type: 'GET',
              url: 'http://localhost/giraffe/public/api-v1/save-venta',
              dataType: 'json',
              contentType: "application/json; charset=utf-8",
              data: {
                  cartShopping: cartShopping
              },
              success: function(data){
                  actualIdVenta = data["idVenta"];
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
      var fecha = dt.getDate() + '-' +  writeMonth() + '-' + dt.getFullYear();
      var hora = dt.getHours() + ":" + dt.getMinutes();
      var montoCliente = $('#monto-pago').val();
      var vuelto = $('#monto-vuelto').val();

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
                        '<div class="col-md-2 col-xs-2 text-left">CANT.</div>' +
                        '<div class="col-md-6 col-xs-6 text-left">PRODUCTO</div>' +
                        '<div class="col-md-4 col-xs-4 text-right">PRECIO (S/)</div>' +
                      '</div>';

                  for(var i = 0; i < cartShopping.length; i++){
                      var precio = parseFloat(cartShopping[i][4]) * parseFloat(cartShopping[i][3]);
                      string += '<div class="row text-left" style="padding-left: 7px;">';
                      string += '<div class="col-md-1 col-xs-1 text-center">' + cartShopping[i][4] + '</div>';
                      string += '<div class="col-md-6 col-xs-6">' + cartShopping[i][1] + ' ' + mostrarDetalle(cartShopping[i][2]) + '</div>';
                      string += '<div class="col-md-4 col-xs-4 text-right">' + round(precio, 2) + '</div>';
                      string += '</div>';

                  }
      string +=
                       '<div class="row" style="padding-top: 19px;">' +
                            '<div class="col-md-8 col-xs-8 text-right">SUBTOTAL: </div>' +
                            '<div class="col-md-4 col-xs-4 text-center" >S/ '+ st +'</div>' +
                       '</div>' +
                       '<div class="row">' +
                            '<div class="col-md-8 col-xs-8 text-right">IGV: </div>' +
                            '<div class="col-md-4 col-xs-4 text-center" >S/ '+ igv +'</div>' +
                       '</div>' +
                       '<div class="row" style="font-weight: bold;">' +
                            '<div class="col-md-8 col-xs-8 text-right">TOTAL: </div>' +
                            '<div class="col-md-4 col-xs-4 text-center" >S/ ' + mv +'</div>' +
                       '</div>' +
                       '<div class="row">' +
                            '<div class="col-md-8 col-xs-8 text-right">Paga con: </div>' +
                            '<div class="col-md-4 col-xs-4 text-center" >S/ ' + round(montoCliente, 2) +'</div>' +
                       '</div>' +
                       '<div class="row">' +
                            '<div class="col-md-8 col-xs-8 text-right">Vuelto: </div>' +
                            '<div class="col-md-4 col-xs-4 text-center" >S/ ' + round(vuelto, 2) +'</div>' +
                       '</div>';
      $('#vouchercontent').html(string);
    }
    function round(num,dec){
        return Number(num).toFixed(2);
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
                            '<th class="text-center">Cant.</th>' +
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

        if( actualIdVenta == -1 ){
            actualIdVenta = $('#idVenta').text();
        }
        actualIdVenta = parseFloat(actualIdVenta) + 1;
        $('#idVenta').text(actualIdVenta);

        $('#monto-pago').val('');

        $('#monto-vuelto').val('');

        addTotalVenta(montoDeVenta);
    }


});
