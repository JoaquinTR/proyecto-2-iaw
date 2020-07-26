@extends('dashboard')

@section('seleccion-perfil')

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                Lista de pedidos de juegos
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

                @include('components.confirmacion')
                @include('components.flash-message')

                {{-- Tabla cargada utilizando datatables (ver scripts al pie de página) --}}
                <table id="dt-pedido" class="table table-striped table-sm table-bordered table-dark h6" style="width: 100% ">
                    <thead>
                        <tr>
                            <th class='text-center'>id</th>
                            <th class='text-center'>id usuario</th>
                            <th class='text-center'>nombre</th>
                            <th class='text-center'>fecha lanzamiento</th>
                            <th class='text-center'>Genero</th>
                            <th class='text-center'>descripcion</th>
                            <th class='text-center'>plataforma</th>
                            <th class='text-center'>editor</th>
                            <th class='text-center'>desarrollador</th>
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
    var url = '{!! route('dashboard.pedido.all.ajax') !!}';
    //la siguiente plantilla la utilizo como acciones dentro de la datatable
    //el string :id va a ser reemplazado via js por el id de la fila, si cambio una ruta
    //el cambio se refleja automáticamente
    var plantillaForm = `<form name="form_:id" action="{{ route('dashboard.pedido.delete',":id") }}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <div class="btn-group" role="group" aria-label="opciones">

                                        <a href="{{ route('dashboard.pedido.tomar',":id") }}" class="btn btn-primary btn-sm" title="tomar pedido">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button id="submit_:id" form="form_:id" class="btn btn-danger btn-sm" title="borrar" onclick="showConfirmacion(this)">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

                                    </div>
                                  </form>`;
</script>
{{-- Código principal de esta página --}}
<script src="{{ asset('js/allPedidos/allPedidos.js') }}"></script>
@endsection
