$( "#plantel" ).change(function() {

    var route = "/consulta/areas/" + $('#plantel').val();

    $("#area option").remove()

     $("#area").append("<option value = 0>Seleciona una opcion</option>")
     $("#area").selectpicker('refresh');
    //value="res[i].">nombre_area</

    $.get(route, function(res){
       //aqui va si si encuentra resultados
       for( i = 0; i < res.length;i++){
         console.log("La fila  "+ res[i].nombre_area)


         $("#area").append("<option value = "+res[i].id+">"+res[i].nombre_area+"</option>")
       }
       $("#area").selectpicker('refresh');
     
    }).fail(function(res) {
    	// aqui si falla dejar vacio
    });

});
$("#area").change(function(){
   var route = "/consulta/user/"+$('#area').val();
   $("#Usuarios option").remove()
   $("#Usuarios").append("<option value = 0>Seleciona una opcion</option>")
   $("#Usuarios").selectpicker('refresh');

   $.get(route, function(res){
      for(i = 0; i < res.length; i++){
         console.log("La fila  "+ res[i].name)
         $("#Usuarios").append("<option value = "+res[i].id+">"+res[i].name+"</option>")
      }
      $("#Usuarios").selectpicker('refresh');
   }).fail(function(res){

   });

});