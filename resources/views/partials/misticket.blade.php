<table id="misTicketInfo" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
  <thead>
    <tr>
      <th>#Ticket</th>
      <th>Descripcion</th>
      <th>Fecha que se asingno</th>
      <th>Asignada a </th>
      <th>Status</th>
    </tr>
  </thead>
    <tbody>
      @foreach($misticket as $ticket)          
      <tr>
        <td>{{$ticket->id}}</td>
        <td>{{$ticket->descripcion}}</td> <!--Descripcion-->
        <td>{{$ticket->fecha_envio}}</td> <!--Fecha que se asingno-->
        <td>{{$ticket->responsable->email}}</td> 
        <td>{{$ticket->status->status}}</td>
      </tr>
      @endforeach
    </tbody>
 </table>


 




<script defer src="{{asset('js/jquery/jquery.dataTables.min.js')}}" ></script>
<script defer src="{{asset('js/jquery/dataTables.bootstrap4.min.js')}}" ></script>
<script defer src="{{asset('js/jquery/dataTables.fixedHeader.min.js')}}" ></script>
<script defer src="{{asset('js/jquery/dataTables.responsive.min.js')}}" ></script>
<script defer src="{{asset('js/jquery/responsive.bootstrap.min.js')}}" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#misTicketInfo').DataTable({
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
