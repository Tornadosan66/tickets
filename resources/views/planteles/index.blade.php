<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <!--aqui empieza el desmais -->
                @if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>
    
@endif
                <div class="col-md-12 text-center">
                    <div class="card" style="box-shadow: 0 5px 5px 0 rgba(0,0,0,0.5);">
                        <div class="card-header">
                            <h2> GESTION Planteles</h2>
                        </div>
                        <div class="card-body">
                           @can('planteles.create')
                                <h3>
                                    <a href="{{route('planteles.create')}}" style="color:#037DB4;"><i class="far fa-plus-square"></i>&nbsp;&nbsp;Plantel</a>
                                </h3>
                         @endcan
                            <table id="personalInfo" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th>plantel</th>
                                   @can('planteles.edit')
                                        <th>Editar</th>
                                        @endcan
                                  @can('planteles.destroy')
                                        <th>Eliminar</th>
                                   @endcan
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($planteles as $plantel)
                                    <tr>

                                        <td>{{$plantel->nombre_plantel}}</td>

                                        @can('planteles.edit')
                                            <td>
                                                <a href="{{route('planteles.edit',$plantel->id)}}">
                                                    <button class="btn btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>
                                            </td>
                                       @endcan
                                       @can('planteles.destroy')
                                            <td>
                                                <form method="POST" id="formEliminar" action="" aria-label="{{ __('Noticia') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" id="borrar" value="{{route('planteles.destroy',$plantel->id)}}" name="borrar" class="btn btn-danger"
                                                            onclick="  var r = confirm('Estas seguro que deseas Eliminarlo?');
                                                        if (r == true) {
                                                            $('#formEliminar').attr('action',this.value).submit();
                                                        } else {
                                                            return false;
                                                        }">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            @endcan
                                        
                                    </tr>
                                
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--aqui termina -->


            </div>
        </div>
    </div>
</x-app-layout>
<script defer src="{{asset('js/jquery/jquery.dataTables.min.js')}}" ></script>
<script defer src="{{asset('js/jquery/dataTables.bootstrap4.min.js')}}" ></script>
<script defer src="{{asset('js/jquery/dataTables.fixedHeader.min.js')}}" ></script>
<script defer src="{{asset('js/jquery/dataTables.responsive.min.js')}}" ></script>
<script defer src="{{asset('js/jquery/responsive.bootstrap.min.js')}}" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#personalInfo').DataTable({
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
