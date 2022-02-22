$( "#plantel" ).change(function() {

    var route = "/consulta/areas/" + $('#plantel').val();



    $.get(route, function(res){
       //aqui va si si encuentra resultados
     console.log(res)
    }).fail(function(res) {
    	// aqui si falla dejar vacio
    });

});