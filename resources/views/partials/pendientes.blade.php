<table id="personalInfo" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
  <thead>
    <tr>
      <th>Descripcion</th>
      <th>Fecha que se asingno</th>
      <th>Fecha que se realizo</th>
      <th>Revisión</th>
    </tr>
  </thead>
    <tbody>
      @foreach($pendientes as $ticket)          
      <tr>
        <td>{{$ticket->descripcion}}</td> <!--Descripcion-->
        <td>{{$ticket->fecha_envio}}</td> <!--Fecha que se asingno-->
        <td>{{$ticket->fecha_completada}}</td> <!--Fecha que se realizo-->  
        <td><button type="button" id="modal" class="btn btn-primary" data-toggle="modal" data-target="#revision">
Revisar</button></td>
      </tr>
      @endforeach
    </tbody>
 </table>


 <!-- Modal -->
<div class="modal fade" id="revision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">revision de ticket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-4">
         <label for="nombre_solicitante">nombre solicitante</label>
          <input id="nombre_solicitante" type="text" placeholder="Nombre del plantel" class="form-control" name="nombre_solicitante" value="" maxlength="35" readonly>
        </div>
        <div class="col-md-4">
         <label for="fecha_solicitud">Fecha de solicitud</label>
          <input id="fecha_solicitud" type="date" class="form-control" name="fecha_solicitud" readonly>
        </div>
        <div class="col-md-4">
         <label for="desc">Descripción</label>
          <textarea id="desc" name="desc" placeholder="Descripción de la tarea" rows="3" cols="100" readonly></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  


  $( "#modal" ).click(function() {

    var route = "/consulta/areas/1"  

   

    $.get(route, function(res){
       //aqui va si si encuentra resultados
       for( i = 0; i < res.length;i++){
         console.log("La fila  "+ res[i].nombre_area)

         $("#nombre_solicitante").val(res[i].id);
         
       }
   
     
    }).fail(function(res) {
      // aqui si falla dejar vacio
    });

});
</script>