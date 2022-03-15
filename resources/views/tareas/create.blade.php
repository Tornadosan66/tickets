<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl max-l-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  shadow-xl sm:rounded-lg">

                <!--aqui empieza el desmais -->

                <div class="col-md-12">
                    <div class="card" style="box-shadow: 0 5px 5px 0 rgba(0,0,0,0.5);">
                        <div class="card-header">
                            <center>
                                <h3>Establecer tarea</h3>
                            </center>
                        </div>
                        <form method="POST" action="{{ route('tareas.store') }}" aria-label="{{ __('tareas') }}" enctype="multipart/form-data">


                            <div class="card-body">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-12">
                                        <br>
                                        <center>
                                            <h4>Sobre la tarea</h4>
                                        </center>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="tarea">Sobre la tarea</label>
                                        <input id="tarea" type="text" placeholder="tarea" class="form-control" name="tarea" 
                                        value="{{old('tarea')}}" maxlength="35" required autofocus>
                                    </div>
                                    
                                   <div class="col-md-4">
                                        <label for="area">Areas</label>
                                        <select  id="area" name="area" class="form-control selectpicker "data-live-search="true">
                                            <option value="">Selecciona un area</option>
                                            @foreach($areas as $area)
                                                <option value="{{$area->id}}">{{$area->nombre_area}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                      <div class="col-md-4">
                                        <label for="Usuarios">Usuarios</label>
                                        <select  id="Usuarios" name="Usuarios" class="form-control selectpicker "data-live-search="true">
                                            <option>Selecciona un Usuario</option>
                                          
                                        </select>
                                    </div>



                                </div>

                            </div>


                            <div class="card-footer">
                                <div class="col-md-12">
                                    <center>
                                        <button type="submit" id="guardar" class="btn btn-success">
                                            <i class="fas fa-save"></i>&nbsp;&nbsp;{{ __('Guardar') }}
                                        </button>
                                        <a href="{{route('tareas.index')}}">
                                            <button type="button" class="btn btn-default" >
                                                <i class="fas fa-undo-alt"></i>&nbsp;&nbsp;{{ __('Regresar') }}
                                            </button>
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </form>
                        <!-- formulario -->
                    </div>
                </div>



                <!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

                <!-- Latest compiled and minified JavaScript -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

                <!-- (Optional) Latest compiled and minified JavaScript translation files -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
              <script defer src="{{asset('js/tickets/tickets.js')}}"></script>

                <!--aqui termina -->


            </div>
        </div>
    </div>
</x-app-layout>