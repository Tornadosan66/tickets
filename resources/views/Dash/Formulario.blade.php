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
                                    @method('PUT')
                                    <div class="col-md-12">
                                        <br>
                                        <center>
                                            <h4>Generando ticket</h4>
                                        </center>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="area">Plantel</label>
                                        <input id="area" type="text" placeholder="Si esto se ve, todavia no hay plantel" class="form-control" name="name" value="{{Auth::user()->plantel->nombre_plantel}}" maxlength="35" required autofocus disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="area">Area</label>
                                        <input id="area" type="text" placeholder="Si esto se ve, todavia no hay area" class="form-control" name="name" value="{{Auth::user()->area->nombre_area}}" maxlength="35" required autofocus disabled>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="responsable">Responsable</label>
                                        <input id="responsable" type="text" placeholder="Si esto se ve, todavia no hay responsable" class="form-control" name="responsable" value="" maxlength="35" required autofocus disabled>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="responsable">Usuarios</label>
                                        <input id="responsable" type="text" placeholder="Si esto se ve, todavia no hay responsable" class="form-control" name="responsable" value="" maxlength="35" required autofocus disabled>
                                    </div>

                                    <div class="col-md-5">
                                        <label for="fecha_envio">Fecha envio</label>
                                        <br>
                                        <input type="date" name="fecha_envio" value="<?php echo date("Y-m-d");?>" disabled>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="tiempo_realizar">Tiempo a realizar</label>
                                        <br>
                                        <input type="date" name="tiempo_realizar" min="<?php echo date("Y-m-d");?>" max="2022-12-31" value="<?php echo date("Y-m-d");?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="desc">Descripción</label>
                                        <textarea id="desc" name="desc" placeholder="Descripción de la tarea" rows="3" cols="100"></textarea>
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
                <script defer src="{{asset('public/js/cliente/cliente.js')}}"></script>

                <!--aqui termina -->


            </div>
        </div>
    </div>
</x-app-layout>