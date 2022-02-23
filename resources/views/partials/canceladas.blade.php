<table id="personalInfo" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
  <thead>
    <tr>
      <th>Descripcion</th>
      <th>Fecha que se asingno</th>
      <th>Fecha que se realizo</th>
    </tr>
  </thead>
    <tbody>
      @foreach($cancelado as $ticket)    
      <tr>
        <td>{{$ticket->descripcion}}</td> <!--Descripcion-->
        <td>{{$ticket->fecha_envio}}</td> <!--Fecha que se asingno-->
        <td>{{$ticket->fecha_completada}}</td> <!--Fecha que se realizo-->             
      </tr>
      @endforeach
    </tbody>
 </table>