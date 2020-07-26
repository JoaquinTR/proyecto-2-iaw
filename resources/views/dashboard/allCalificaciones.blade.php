@extends('dashboard')

@section('seleccion-perfil')

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                Lista de calificaciones
                <a type="button" class="close" href="{{ route('dashboard') }}">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>

            <div class="card-body pl-1">

                <div id="modal-info" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Contenido</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div id="modal-info-body" class="modal-body">
                          <p id="modal-info-content"></p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">cerrar</button>
                        </div>
                      </div>
                    </div>
                </div>

                @include('components.flash-message')

                {{-- Tabla cargada utilizando datatables (ver scripts al pie de página) --}}
                <table id="dt-calificacion" class="table table-striped table-sm table-bordered table-dark">
                    <thead>
                        <tr>
                            <th class='text-center'>id</th>
                            <th class='text-center'>id usuario</th>
                            <th class='text-center'>id juego</th>
                            <th class='text-center'>descripcion</th>
                            <th class='text-center'>reseña</th>
                            <th class='text-center'>puntaje</th>
                            <th class='text-center'>tipo</th>
                            <th class='text-center'>fecha</th>
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
    var url = '{!! route('dashboard.calificacion.all.ajax') !!}';
</script>
{{-- Código principal de esta página --}}
<script src="{{ asset('js/allCalificaciones/allCalificaciones.js') }}"></script>
@endsection
