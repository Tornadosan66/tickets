$( document ).ready(function() 
{
    var url = "https://5a220eb4.ngrok.io";
    $("[name='cp']").on('change', function(){
        debugger;
        var cp = $(this).val();
        if(cp.length != 5)
            return;
        
        $.get(url + "/CP/"+cp, function(res){
            $("[name='ciudad']").val(res.Municipio);
            $("[name='estado']").val(res.Estado);

            selectColonias = $("[name='colonia']");
            selectColonias.find('option').remove();
            selectColonias.append('<option data-tokens="vacio" value="">Selecciona una colonia</option>');
            var colonias = res.Colonias;

            $.each(colonias, function(index, colonia) {
                selectColonias.append('<option value="'+colonia.c_Colonia+'">'+colonia.Nombre_del_asentamiento+'</option>');
            });
            selectColonias.selectpicker('refresh');
        });
        
    })
});