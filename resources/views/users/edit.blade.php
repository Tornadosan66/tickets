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
                                <h3>Editar Usuario</h3>
                            </center>
                        </div>
                        
                        <form method="POST" action="{{ route('usuarios.update',$usuarios->id)  }}" aria-label="{{ __('Usuario') }}" enctype="multipart/form-data">


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
                                        <label for="email">Correo</label>
                                        <input id="email" type="text" placeholder="email" class="form-control" name="email" value="{{$usuarios->email}}"  autofocus maxlength="50">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">Nombres</label>
                                        <input id="name" type="text" placeholder="name" class="form-control" name="name" value="{{$usuarios->name}}" maxlength="35" autofocus>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="password">Contraseña</label>
                                        <input id="password" type="password" placeholder="Si no se desea cambiar dejar vacio" class="form-control" name="password"  maxlength="35" autofocus>
                                    </div>
                                    @if(Auth::user()->getRoleNames()[0] == 'Superusuario')
                                    <div class="col-md-4">
                                        <label for="rol">Rol</label>
                                        <select  id="rol" name="rol" class="form-control selectpicker "data-live-search="true">
                                            @foreach($roles as $rol)
                                                
                                                @if($usuarios->getRoleNames()[0] == $rol->name)
                                                <option selected="" value="{{$rol->id}}">{{$rol->name}}</option>
                                                @else
                                                <option value="{{$rol->id}}">{{$rol->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="plantel">Plantel</label>
                                        <select  id="plantel" name="plantel" class="form-control selectpicker "data-live-search="true">
                                            @foreach($planteles as $plantel)
                                                @if($usuarios->plantel_id == $plantel->id)
                                                    <option selected value="{{$plantel->id}}">{{$plantel->nombre_plantel}}</option>
                                                 @else
                                                    <option value="{{$plantel->id}}">{{$plantel->nombre_plantel}}</option>
                                                @endif
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    
                                    <div class="col-md-4">
                                        <label for="area">Area</label>
                                        <select  id="area" name="area" class="form-control selectpicker "data-live-search="true">
                                            @foreach($areas as $area)
                                                @if($usuarios->area_id == $area->id)
                                                    <option selected value="{{$area->id}}">{{$area->nombre_area}}</option>
                                                @else    
                                                    <option value="{{$area->id}}">{{$area->nombre_area}}</option>
                                                @endif
                                                
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
                <script defer src="{{asset('public/js/cliente/cliente.js')}}"></script>

                <!--aqui termina -->


            </div>
        </div>
    </div>
</x-app-layout>