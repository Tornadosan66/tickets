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
                                <h3>Crear Usuario</h3>
                            </center>
                        </div>
                        <form method="POST" action="{{ route('usuarios.store') }}" aria-label="{{ __('Usuarios') }}" enctype="multipart/form-data">


                            <div class="card-body">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-12">
                                        <br>
                                        <center>
                                            <h4>Datos generales</h4>
                                        </center>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email">Correo Electronico</label>
                                        <input id="email" type="email" placeholder="email" class="form-control" name="email" value="{{old('email')}}" required autofocus maxlength="50">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">Nombres</label>
                                        <input id="name" type="text" placeholder="name" class="form-control" name="name" value="{{old('name')}}" maxlength="35" required autofocus>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="password">Contraseña</label>
                                        <input id="password" type="text" placeholder="password" class="form-control" name="password" value="{{old('password')}}" maxlength="35" required autofocus>
                                    </div>
                                    @if(Auth::user()->getRoleNames()[0] == 'Superusuario')
                                    <div class="col-md-4">
                                        <label for="rol">Rol</label>
                                        <select required autofocus id="rol" name="rol" class="form-control selectpicker "data-live-search="true">
                                            @foreach($roles as $rol)
                                                <option value="{{$rol->id}}">{{$rol->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="plantel">Plantel</label>
                                        <select  required autofocus id="plantel" name="plantel" class="form-control selectpicker "data-live-search="true">
                                            <option value="">Seleciona una opción</option>
                                            @foreach($planteles as $plantel)
                                                <option value="{{$plantel->id}}">{{$plantel->nombre_plantel}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif

                                    <div class="col-md-4">
                                        <label for="area">Area</label>
                                        <select required autofocus  id="area" name="area" class="form-control selectpicker "data-live-search="true">
                                            <option value="">Seleciona una opción</option>
                                            @if(Auth::user()->getRoleNames()[0] == 'Supervisor')
                                                @foreach($areas as $area)
                                                    <option value="{{$area->id}}">{{$area->nombre_area}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="supervisorRectoria">Supervisor Rectoria</label>
                                        <select   id="supervisorRectoria" name="supervisorRectoria" class="form-control selectpicker "data-live-search="true">
                                            <option value="">Seleciona una opción</option>
                                            @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                                            @endforeach
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
                                        <a href="{{route('usuarios.index')}}">
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
                <script type="text/javascript">
                    $( "#plantel" ).change(function() {

                    var route = "/consulta/areas/" + $('#plantel').val();

                    $("#area option").remove()

                    $("#area").append("<option value = 0>Seleciona una opcion</option>")
                    $("#area").selectpicker('refresh');
                    //value="res[i].">nombre_area</

                    $.get(route, function(res){
                    //aqui va si si encuentra resultados
                    for( i = 0; i < res.length;i++){
                        console.log("La fila  "+ res[i].nombre_area)


                        $("#area").append("<option value = "+res[i].id+">"+res[i].nombre_area+"</option>")
                    }
                        $("#area").selectpicker('refresh');
    
                    }).fail(function(res) {
                        // aqui si falla dejar vacio
                    });

                });
                </script>

                <!--aqui termina -->


            </div>
        </div>
    </div>
</x-app-layout>