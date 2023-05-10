
    <br>
   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                    <!-- ******************************   Inicia tabla Mis Tickets   *****************************************-->

        <div class="card-header">
            <center>
                <h2>Mis Tickets</h2>
            </center>
        </div>
        <div class="card-header">
            <center>
                <h2>Asignados por Mi</h2>
            </center>
        </div>
      <table id="mistickets" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
          <tr class="bg-gray-800">
            <th class="px-5 py-2">
              <span class="text-gray-300">Id_Ticket</span>
            </th>
            <th class="px-5 py-2">
              <span class="text-gray-300">Asignado a</span>
            </th>
            <th class="px-5 py-2">
              <span class="text-gray-300">Descripcion del Ticket</span>
            </th>
            <th class="px-5 py-2">
              <span class="text-gray-300">Fecha que se asigno</span>
            </th>
            <th class="px-5 py-2">
              <span class="text-gray-300">Status</span>
            </th>
            <th class="px-5 py-2">
              <span class="text-gray-300">Fecha del Status</span>
            </th>
          </tr>
        </thead>
        <tbody class="bg-gray-200">
            @foreach($misTickets as $tickets)
                  <tr style=" font-size: 78.5%;">
                      <td class="px-5 py-2">{{$tickets->id_ticket}}</td>
                      <td class="px-5 py-2">{{$tickets->responsable->name}}</td>
                      <td class="px-5 py-2">{{$tickets->descripcion}}</td>
                      <td class="px-5 py-2">{{$tickets->fecha_envio}}</td>
                      <td class="px-5 py-2">{{$tickets->status->status}}</td>
                      <td class="px-5 py-2">{{$tickets->created_at}}</td>
                      
                      
                    
                      
                  </tr>
              @endforeach

        </tbody>
      </table>

      <br>
  <!-- **********************************   fin tabla ***************************************-->


                   
            </div>
            <br>

                

        </div>

    </div>



