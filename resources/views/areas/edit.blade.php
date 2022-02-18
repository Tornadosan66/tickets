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
                                <h3>Editar plantel</h3>
                            </center>
                        </div>
                        <form method="POST" action="{{ route('areas.update',$areas->id) }}" aria-label="{{ __('areas') }}" enctype="multipart/form-data">


                            <div class="card-body">
                                <div class="row">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12">
                                        <br>
                                        <center>
                                            <h4>Datos generales</h4>
                                        </center>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="name">Nombre de area</label>
                                        <input id="name" type="text" placeholder="name" class="form-control" name="name" value="{{$areas->nombre_area}}" maxlength="35" required autofocus>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="plantel">planteles</label>
                                        <select  id="plantel" name="plantel" class="form-control selectpicker "data-live-search="true">
                                            @foreach($planteles as $plantel)

                                                <option value="{{$plantel->id}}">{{$plantel->nombre_plantel}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="supervisor">Supervisor</label>
                                        <select  id="supervisor" name="supervisor" class="form-control selectpicker "data-live-search="true">
                                            @foreach($usuarios as $usuario)
                                            
                                                <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="desc">Descripción</label>
                                        <textarea id="desc" name="desc" rows="3" cols="100"></textarea>
                                    </div>

                                </div>

                            </div>


                            <div class="card-footer">
                                <div class="col-md-12">
                                    <center>
                                        <button type="submit" id="guardar" class="btn btn-success">
                                            <i class="fas fa-save"></i>&nbsp;&nbsp;{{ __('Guardar') }}
                                        </button>
                                        <a href="{{route('areas.index')}}">
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
                <script defer src="{{asset('public/js/cliente/cliente.js')}}"></script>


                <!--aqui termina -->


            </div>
        </div>
    </div>
</x-app-layout>