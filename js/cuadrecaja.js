$(document).ready(function(){
  var monedas = [-1, 0.10, 0.20, 0.5, 1, 2, 5, 10, 20, 50, 100, 200];

  var monto_general;
  var monto_inicio_dia;
  var monto_total;

  $('#cnt-1, #cnt-2, #cnt-3, #cnt-4, #cnt-5, #cnt-6, #cnt-7, #cnt-8, #cnt-9, #cnt-10, #cnt-11').keyup(function(){
      var val_input = $(this).val();
      calculateMontoInput($(this), val_input);
  });

  $('#cnt-1, #cnt-2, #cnt-3, #cnt-4, #cnt-5, #cnt-6, #cnt-7, #cnt-8, #cnt-9, #cnt-10, #cnt-11').on('keyup, keydown, change', function(){
      var val_input = $(this).val() || 0;
      $(this).val(val_input);
      calculateMontoInput($(this), val_input);
  });

  $('#montoInicial').change(function(){
      var montoInicial = $('#montoInicial').val() || 0;
      $('#montoInicial').val(montoInicial);

      mostrarInicioDia(montoInicial);
  });

  $('#montoInicial').keyup(function(){
      var montoInicial = $('#montoInicial').val();
      mostrarInicioDia(montoInicial);
  });

  $('#formCuadreCaja').submit(function(event){
      event.preventDefault();

      var monto_general = $('#monto-general').text();
      var data = $('#formCuadreCaja').serializeArray();

      var monto_total = parseFloat($('#monto-total').text());
      if( monto_total == 0 ){
          swal({
            title: "Advertencia",
            text: "Debes ingresar el dinero con el que vas a cerrar la caja",
            type: "warning",
            closeOnConfirm: false
          },
          function(){
            swal.close();
            $('#montoInicial').focus();
          });
      }else{
          $.ajax({
              type: 'GET',
              url: 'http://localhost/Giraffe_v1/api-v1/save-cuadrar-caja',
              dataType: 'json',
              contentType: "application/json; charset=utf-8",
              data: {
                  data: data,
                  monto_general: monto_general
              },
              success: function(data){
                  var estado = data;
                  console.log(estado);
                  if( data["0"]["ESTADO"] > 0 ){
                    swal({
                      title: "Correcto",
                      text: "Cierre de Caja Correcto",
                      type: "success",
                      closeOnConfirm: false
                    },
                    function(){
                      swal.close();
                      window.location.replace("http://localhost/Giraffe_v1/ventas");
                    });
                  }else{
                    swal({
                      title: "Advertencia",
                      text: "No puede cerrar caja si no hay ventas registradas",
                      type: "warning",
                      closeOnConfirm: false
                    },
                    function(){
                      swal.close();
                      $('#montoInicial').focus();
                    });
                  }


              },
              error: function(){
                  swal ( "Error!" ,  "Ha ocurrido un problema. Contactar con el webmaster" ,  "error" );
              }
          });
      }
  });

  function calculateMontoInput(thisObject, val_input){
    var id_input = thisObject.attr('name');

    id_input = id_input.replace("m", '');

    var monto_input = '#monto-' + id_input;

    var monto_actual = parseFloat(monedas[parseInt(id_input)]) * parseFloat(val_input);

    $(monto_input).val(round(monto_actual, 2));

    calculateMontoGeneral(monto_actual);
  }

  function calculateMontoGeneral(monto_actual){

      var monto_general = 0;
      for( var ind = 1; ind <= 11; ind++ ){
          monto_general += parseFloat( $('#monto-' + ind).val() );
      }
      if( isNaN(monto_general) ){
          monto_general = 0;
      }
      $('#monto-general').text(round(monto_general, 2));

      calcularMontoTotal();
  }

  function mostrarInicioDia(montoInicial){
      $('#monto-inicio-dia').text(round(montoInicial, 2));

      calcularMontoTotal();
  }

  function calcularMontoTotal(){
      monto_general = $('#monto-general').text();
      monto_inicio_dia = $('#monto-inicio-dia').text();
      monto_total = round(parseFloat(monto_general) + parseFloat(monto_inicio_dia), 2);
      $('#monto-total').text( monto_total );
  }

});
