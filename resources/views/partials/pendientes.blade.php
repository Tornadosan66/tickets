<table id="pendientesInfo" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
  <thead>
    <tr>
      <th>#ticket</th>
      <th>Descripcion</th>
      <th>Fecha que se asigno</th>
      <th>Asignada a </th>
      <th>Tiempo Restaste para terminar </th>
      <th>Revisión</th>
    </tr>
  </thead>
    <tbody>
      @foreach($pendientes as $key => $ticket)          
      <tr>
        <td>{{$ticket->id}}</td>
        <td>{{$ticket->descripcion}}</td> <!--Descripcion-->
        <td>{{$ticket->fecha_envio}}</td> <!--Fecha que se asingno-->
        @if(Auth::user()->getRoleNames()[0] == 'Superusuario' || Auth::user()->getRoleNames()[0] == 'Usuario')
        <td>{{$ticket->responsable->email}}</td> 
        @else
        <td>{{$ticket->email}}</td> 
        @endif
        <td id="tiempo{{$key}}">{{date("i:s" , $ticket->tiempo_realizar) }}</td> 
        <td><button type="button" id="modal" class="btn btn-primary" value="{{$ticket->id}}" data-toggle="modal" data-target="#revision">
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
        <div class="col-md-6">
         <label for="nombre_solicitante">nombre solicitante</label>
          <input id="nombre_solicitante" type="text" placeholder="Nombre del plantel" class="form-control" name="nombre_solicitante" value="" maxlength="35" readonly>
        </div>
        <div class="col-md-6">
         <label for="fecha_solicitud">Fecha de solicitud</label>
          <input id="fecha_solicitud" type="date" class="form-control" name="fecha_solicitud" readonly>
        </div>
        <div class="col-md-6">
         <label for="tarea">Tarea</label>
          <input id="tarea" type="text" placeholder="Tarea" class="form-control" name="tarea" value="" maxlength="35" readonly>
        </div>
        <div class="col-md-4">
         <label for="desc">Descripción a Realizar</label>
          <textarea id="desc" name="desc" placeholder="Descripción de la tarea" rows="3" cols="50" readonly></textarea>
        </div>
        <form method="POST" action="{{ route('revision.ticket') }}" aria-label="{{ __('ticket') }}" accept-charset="UTF-8" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id_ticket" id="id_ticket"></input>
        <div class="col-md-4">
         <label for="desc2">Descripción que hizo</label>
          <textarea id="desc2" name="desc2" placeholder="Descripción de lo que hizo" rows="3" cols="50" required autofocus></textarea>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Evidencia</label>
          <div class="col-md-6">
            <input type="file" class="form-control" name="file" >
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>




<script defer src="{{asset('js/jquery/jquery.dataTables.min.js')}}" ></script>
<script defer src="{{asset('js/jquery/dataTables.bootstrap4.min.js')}}" ></script>
<script defer src="{{asset('js/jquery/dataTables.fixedHeader.min.js')}}" ></script>
<script defer src="{{asset('js/jquery/dataTables.responsive.min.js')}}" ></script>
<script defer src="{{asset('js/jquery/responsive.bootstrap.min.js')}}" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#pendientesInfo').DataTable({
            "language": {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });
    } );
</script>
