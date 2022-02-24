<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (session('info'))
                    <div class="alert alert-success">
                        <strong>{{session('info')}}</strong>
                    </div>
                @endif
               <!--Tarjetas -->
    <div class="bg-gray-100 flex items-center justify-center bg-gray-100">
        <div class="max-w-7xl w-full mx-auto py-6 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row w-full lg:space-x-2 space-y-2 lg:space-y-0 mb-2 lg:mb-4">



                <div class="w-full lg:w-1/5">
                    <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-blue-400">
                        <div class="flex items-center">
                            <div class="icon w-14 p-3.5 bg-blue-400 text-white rounded-full mr-3">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11v 8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3" />
                                </svg>
                            </div>
                            <div class="flex flex-col justify-center">
                               
                                    <div class="text-lg">{{$completados->count()}}</div>
                               
                                <div class="text-sm text-gray-400">Completadas</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/5">
                    <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-yellow-400">
                        <div class="flex items-center">
                            <div class="icon w-14 p-3.5 bg-yellow-400 text-white rounded-full mr-3">
                                <svg class="h-8 w-8 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="7" />  <polyline points="12 9 12 12 13.5 13.5" />  <path d="M16.51 17.35l-.35 3.83a2 2 0 0 1-2 1.82H9.83a2 2 0 0 1-2-1.82l-.35-3.83m.01-10.7l.35-3.83A2 2 0 0 1 9.83 1h4.35a2 2 0 0 1 2 1.82l.35 3.83" /></svg>
                            </div>
                            <div class="flex flex-col justify-center">
                               
                                    <div class="text-lg">{{$pendientes->count()}}</div>
                         
                                <div class="text-sm text-gray-400">Pendientes</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/5">
                    <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-yellow-400">
                        <div class="flex items-center">
                            <div class="icon w-14 p-3.5 bg-yellow-400 text-white rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" ><path d="M12,0A11.972,11.972,0,0,0,4,3.073V1A1,1,0,0,0,2,1V4A3,3,0,0,0,5,7H8A1,1,0,0,0,8,5H5a.854.854,0,0,1-.1-.021A9.987,9.987,0,1,1,2,12a1,1,0,0,0-2,0A12,12,0,1,0,12,0Z"/><path d="M12,6a1,1,0,0,0-1,1v5a1,1,0,0,0,.293.707l3,3a1,1,0,0,0,1.414-1.414L13,11.586V7A1,1,0,0,0,12,6Z"/></svg>
                            </div>
                            <div class="flex flex-col justify-center">
                               
                                    <div class="text-lg">{{$validacion->count()}}</div>
                         
                                <div class="text-sm text-gray-400">Validacion</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/5">
                    <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-red-400">
                        <div class="flex items-center">
                            <div class="icon w-14 p-3.5 bg-red-400 text-white rounded-full mr-3">
                                <svg id="Layer_1" viewBox="0 0 24 24"  data-name="Layer 1"><path d="m23.957 16.457-3.043 3.043 3.043 3.043-1.414 1.414-3.043-3.043-3.043 3.043-1.414-1.414 3.043-3.043-3.043-3.043 1.414-1.414 3.043 3.043 3.043-3.043zm-21.957-4.457a10 10 0 1 1 19.949 1h2c.028-.331.051-.662.051-1a12 12 0 1 0 -12 12c.338 0 .669-.023 1-.051v-2a9.992 9.992 0 0 1 -11-9.949zm9-6v4.586l-2.707 2.707 1.414 1.414 3.293-3.293v-5.414z"/></svg>
                            </div>
                            <div class="flex flex-col justify-center">
                               
                                    <div class="text-lg">{{$perdido->count()}}</div>
                         
                                <div class="text-sm text-gray-400">Perdidos</div>
                            </div>
                        </div>
                    </div>
                </div>

                

                <div class="w-full lg:w-1/5">
                    <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-red-400">
                        <div class="flex items-center">
                            <div class="icon w-14 p-3.5 bg-red-400 text-white rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                            </div>
                            <div class="flex flex-col justify-center">
                               
                                    <div class="text-lg">{{$cancelado->count()}}</div>
                            
                                <div class="text-sm text-gray-400">Canceladas</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <br><br>
                    <a href="{{route('ticket.create')}}">
                        <button class="btn btn-primary">
                            <i>Generar ticket</i>
                        </button>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- fin Tarjetas -->

    <!-- Nav  -->

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Completadas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Pendientes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Canceladas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-validation" role="tab" aria-controls="pills-validation" aria-selected="false">Validación</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-out" role="tab" aria-controls="pills-validation" aria-selected="false">Perdidas</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">@include('partials.completadas')</div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">@include('partials.pendientes')</div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">@include('partials.canceladas')</div>
  <div class="tab-pane fade" id="pills-validation" role="tabpanel" aria-labelledby="pills-contact-tab">@include('partials.validacion')</div>
  <div class="tab-pane fade" id="pills-out" role="tabpanel" aria-labelledby="pills-contact-tab">@include('partials.perdidas')</div>
</div>

    <!-- fin Nav -->
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $( "button#modal" ).click(function() {

    var route = "/consulta/ticket/"+ $(this).val(); 

   $("#id_ticket").val($(this).val());

    $.get(route, function(res){
       //aqui va si si encuentra resultados
   
     
       $("#nombre_solicitante").val(res.correo);
       $("#fecha_solicitud").val(res.fecha_envio);
       $("#desc").text(res.descripcion);
       
         

   
     
    }).fail(function(res) {
      // aqui si falla dejar vacio
    });

});
  $('button#modal1').click(function() {

    var route = "/consulta/ticket/"+ $(this).val(); 

   $("#id_ticket").val($(this).val());
   $("#ligaDescarga").attr('href','ticket/'+ $(this).val());

    $.get(route, function(res){
       //aqui va si si encuentra resultados
   
        console.log(res);
       $("#nombre_solicitante2").val(res.correo);
       $("#fecha_solicitud2").val(res.fecha_envio);
       $("#descripcion").text(res.descripcion);
       $("#descripcion2").text(res.descripcionCompletada);

       if(!res.evidencia)
       {
                $("#ligaDescarga").attr('hidden',true);
       }
       else
       {
        $("#ligaDescarga").attr('hidden',false);
       }
       
         

   
     
    }).fail(function(res) {
      // aqui si falla dejar vacio
    });

});
    </script>
</x-app-layout>
