<table id="validacionInfo" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
  <thead>
    <tr>
      <th>Descripcion</th>
      <th>Fecha que se asingno</th>
      <th>Asignada a </th>
      <th>Revisión</th>
    </tr>
  </thead>
    <tbody>
      @foreach($validacion as $ticket)
      <tr>
        <td>{{$ticket->descripcion}}</td> <!--Descripcion-->
        <td>{{$ticket->fecha_envio}}</td> <!--Fecha que se asingno-->
        <td>{{$ticket->responsable->email}}</td> 
        @can('planteles.index')
        <td><button type="button" id="modal1" class="btn btn-primary" value="{{$ticket->id}}" data-toggle="modal" data-target="#validacion">
Revisar</button></td>@endcan
      </tr>
      @endforeach
    </tbody>
 </table>


 <!-- Modal -->
<div class="modal fade" id="validacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
         <label for="nombre_solicitante2">nombre solicitante</label>
          <input id="nombre_solicitante2" type="text" placeholder="Nombre del plantel" class="form-control" name="nombre_solicitante2" value="" maxlength="35" readonly>
        </div>
        <div class="col-md-6">
         <label for="fecha_solicitud2">Fecha de solicitud</label>
          <input id="fecha_solicitud2" type="date" class="form-control" name="fecha_solicitud2" readonly>
        </div>
        <div class="col-md-4">
         <label for="descripcion">Descripción a Realizar</label>
          <textarea id="descripcion" name="descripcion" placeholder="Descripción de la tarea" rows="3" cols="50" readonly></textarea>
        </div>
        <form method="POST" action="{{ route('terminar.ticket') }}" aria-label="{{ __('ticket') }}" accept-charset="UTF-8" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id_ticket" id="id_ticket"></input>
        <div class="col-md-4">
         <label for="descripcion2">Descripción que hizo</label>
          <textarea id="descripcion2" name="descripcion2" placeholder="Descripción de lo que hizo" rows="3" cols="50"></textarea>
        </div>
        
        <div class="form-group">
          <label class="col-md-4 control-label">Evidencia</label>
          <div class="col-md-6">
            <a id="ligaDescarga" href="/ticket/" target="_blank">
              <button type="button" class="btn btn-secondary">Descargar evidencia</button>
            </a>
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
        $('#validacionInfo').DataTable({
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