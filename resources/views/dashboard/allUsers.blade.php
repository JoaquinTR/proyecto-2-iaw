@extends('dashboard')

@section('seleccion-perfil')

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                Lista de Usuarios
                <a type="button" class="close" href="{{ route('dashboard') }}">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>

            <div class="card-body pl-1">

                @include('components.flash-message')

                {{-- Tabla cargada utilizando datatables (ver scripts al pie de página) --}}
                <table id="dt-user" class="table table-striped table-sm table-bordered table-dark">
                    <thead>
                        <tr>
                            <th class='text-center'>id</th>
                            <th class='text-center'>nombre</th>
                            <th class='text-center'>email</th>
                            <th class='text-center'>tipo</th>
                            <th class='text-center'>verificado</th>
                            <th class='text-center'>fecha creación</th>
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
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('datatables/datatables.min.js') }}"></script>
<script type="text/javascript">
    var url = '{!! route('dashboard.usuarios.ajax') !!}';

    //la siguiente plantilla la utilizo como acciones dentro de la datatable
    //el string :id va a ser reemplazado via js por el id de la fila!
    var plantillaForm = `<form action="{{ route('dashboard.usuarios.adminificar',":id") }}" method="post" style="display: inline-block">
                                    @csrf
                                    <div class="btn-group" role="group" aria-label="opciones">

                                        <button class="btn btn-success btn-sm"" type="submit" title="Hacer administrador.">
                                            <i class="fas fa-gavel"></i>
                                        </button>

                                    </div>
                                  </form>`;
</script>
{{-- Código principal de esta página --}}
<script src="{{ asset('js/allUsers/allUsers.js') }}"></script>
@endsection
