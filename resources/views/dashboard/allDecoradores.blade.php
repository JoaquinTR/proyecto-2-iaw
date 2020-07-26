@extends('dashboard')

@section('seleccion-perfil')

<div class="container">
    <div class="row">
        <div class="card w-75">
            <div class="card-header">
                Listas de decoradores
                <a type="button" class="close" href="{{ route('dashboard') }}">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>

            <div class="card-body pl-1">

                @include('components.confirmacion')
                @include('components.flash-message')

                <div class="content px-3 pb-3">
                    <a href="{{ route('dashboard.decoradores.new') }}" class="btn btn-primary btn-sm" title="nuevo juego">
                        <i class="far fa-edit"></i> Cargar nuevo Decorador
                    </a>
                </div>

                <div class="pb-3">
                    <div><h5><strong>Generos</strong></h5></div>
                    {{-- Tabla cargada utilizando datatables (ver scripts al pie de página) --}}
                    <table id="dt-generos" class="table table-striped table-sm table-bordered table-dark ">
                        <thead>
                            <tr>
                                <th class='text-center'>id</th>
                                <th class='text-center'>nombre</th>
                                <th class='text-center'>control</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <hr/>

                <div class="pb-3">
                    <div><h5><strong>Plataformas</strong></h5></div>
                    {{-- Tabla cargada utilizando datatables (ver scripts al pie de página) --}}
                    <table id="dt-plataformas" class="table table-striped table-sm table-bordered table-dark">
                        <thead>
                            <tr>
                                <th class='text-center'>id</th>
                                <th class='text-center'>nombre</th>
                                <th class='text-center'>control</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <hr/>

                <div class="pb-3">
                    <div><h5><strong>Editores</strong></h5></div>
                    {{-- Tabla cargada utilizando datatables (ver scripts al pie de página) --}}
                    <table id="dt-editores" class="table table-striped table-sm table-bordered table-dark">
                        <thead>
                            <tr>
                                <th class='text-center'>id</th>
                                <th class='text-center'>nombre</th>
                                <th class='text-center'>control</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <hr/>

                <div class="pb-3">
                    <div><h5><strong>Desarrolladores</strong></h5></div>
                    {{-- Tabla cargada utilizando datatables (ver scripts al pie de página) --}}
                    <table id="dt-desarrolladores" class="table table-striped table-sm table-bordered table-dark">
                        <thead>
                            <tr>
                                <th class='text-center'>id</th>
                                <th class='text-center'>nombre</th>
                                <th class='text-center'>control</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('datatables/datatables.min.js') }}"></script>
<script type="text/javascript">

    //urls de búsqueda de datos.
    var urlGeneros = '{!! route('dashboard.decoradores.genero.ajax')  !!}';
    var urlPlataformas = '{!! route('dashboard.decoradores.plataforma.ajax')  !!}';
    var urlEditores = '{!! route('dashboard.decoradores.editor.ajax')  !!}';
    var urlDesarrolladores = '{!! route('dashboard.decoradores.desarrollador.ajax')  !!}';

    //la siguiente plantilla la utilizo como acciones dentro de la datatable
    //el string :id va a ser reemplazado via js por el id de la fila!
    var plantillaForm = `<form name="form_:id:tipo" action="{{ route('dashboard.decoradores.delete',["id"=>":id","tipo"=>":tipo"]) }}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <div class="btn-group" role="group" aria-label="opciones">

                                        <button id="submit_:id" form="form_:id:tipo" class="btn btn-danger btn-sm" title="borrar" onclick="showConfirmacion(this)">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

                                    </div>
                                  </form>`;
</script>
{{-- Código principal de esta página --}}
<script src="{{ asset('js/allDecoradores/allDecoradores.js') }}"></script>
@endsection
