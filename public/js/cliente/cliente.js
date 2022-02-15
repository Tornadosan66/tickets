





$( "#guardar" ).click(function() {
fechaInicio = $("#fechaInicio").val();

fechaInicio = fechaInicio.replace('-','');
fechaInicio = fechaInicio.replace('-','');

hasta = fechaInicio.substr(0, fechaInicio.length-4)

hasta = parseInt(hasta) + parseInt($("#plazo").val());

$("#hasta").val(hasta+ $('#fechaInicio').val().substr(4, $('#fechaInicio').val().length));


});