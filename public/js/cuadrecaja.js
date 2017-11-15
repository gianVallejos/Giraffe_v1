$(document).ready(function(){
  var monedas = [-1, 0.10, 0.20, 0.5, 1, 2, 5, 10, 20, 50, 100, 200];

  $('#cnt-1, #cnt-2, #cnt-3, #cnt-4, #cnt-5, #cnt-6, #cnt-7, #cnt-8, #cnt-9, #cnt-10, #cnt-11').keyup(function(){
      var val_input = $(this).val();
      calculateMontoInput($(this), val_input);
  });

  $('#cnt-1, #cnt-2, #cnt-3, #cnt-4, #cnt-5, #cnt-6, #cnt-7, #cnt-8, #cnt-9, #cnt-10, #cnt-11').on('keyup, keydown, change', function(){
      var val_input = $(this).val() || 0;
      $(this).val(val_input);
      calculateMontoInput($(this), val_input);
  });

  function calculateMontoInput(thisObject, val_input){
    var id_input = thisObject.attr('name');

    var monto_input = '#monto-' + id_input;

    var monto_actual = parseFloat(monedas[parseInt(id_input)]) * parseFloat(val_input);

    $(monto_input).val(round(monto_actual, 2));

    calculateMontoTotal(monto_actual);
  }

  function calculateMontoTotal(monto_actual){
      var monto_general = 0;
      for( var ind = 1; ind <= 11; ind++ ){
          monto_general += parseFloat( $('#monto-' + ind).val() );
      }
      if( isNaN(monto_general) ){
          monto_general = 0;
      }
      $('#monto-general').text(round(monto_general, 2));
  }

});
