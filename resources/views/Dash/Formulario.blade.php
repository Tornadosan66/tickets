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
                                <h3>Generando ticket</h3>
                            </center>
                        </div>
                        <form method="POST" action="{{ route('ticket.store') }}" aria-label="{{ __('ticket') }}" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-12">
                                        <br>
                                        <center>
                                            <h4>Generando ticket</h4>
                                        </center>
                                    </div>
                                    
                                  
                                    <div class="col-md-3">
                                        <label for="plantel">Plantel</label>
                                        <select  required autofocus id="plantel" name="plantel" class="form-control selectpicker "data-live-search="true">
                                            <option value="">Seleciona una opcion</option>
                                            @foreach($planteles as $plantel)
                                                <option value="{{$plantel->id}}">{{$plantel->nombre_plantel}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="area">Area</label>
                                        <select required autofocus id="area" name="area" class="form-control selectpicker "data-live-search="true">
                                                <option value="">Seleciona una opcion</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="tareas">Tareas</label>
                                        <select   id="tareas" name="tareas" class="form-control selectpicker "data-live-search="true">
                                                <option value="">Seleciona una opcion</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Usuarios">Usuarios</label>
                                        <select required autofocus id="Usuarios" name="Usuarios" class="form-control selectpicker "data-live-search="true">
                                                <option value="" >Seleciona una opcion</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <label for="fecha_envio">Fecha envio</label>
                                        <br>
                                        <input type="date" name="fecha_envio" value="<?php echo date("Y-m-d");?>" readonly>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="desc">Descripción</label>
                                        <textarea required autofocus id="desc" name="desc" placeholder="Descripción de la tarea" rows="3" cols="100"></textarea>
                                    </div>

                                </div>

                            </div>


                            <div class="card-footer">
                                <div class="col-md-12">
                                    <center>
                                        <button type="submit" id="guardar" class="btn btn-success">
                                            <i class="fas fa-save"></i>&nbsp;&nbsp;{{ __('Guardar') }}
                                        </button>
                                        <a href="{{route('dashboard')}}">
                                            <button type="button" class="btn btn-default" >
                                                <i class="fas fa-undo-alt"></i>&nbsp;&nbsp;{{ __('Cancelar') }}
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