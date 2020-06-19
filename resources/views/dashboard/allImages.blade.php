@extends('dashboard')

@section('css')
<style>
    #imagen{
        max-width: 100%;
    }
</style>
@endsection

@section('seleccion-perfil')

<div id="modal-img" class="modal" tabindex="-1" role="dialog">
    <div class="modal-header bg-dark">
        <h5 class="modal-title text-light">Contenido</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
     </div>
    <div class="modal-body imagen justify-content-center">
        <img id="imagen" src="" alt="Imagen seleccionada" />
    </div>
    <div class="modal-footer justify-content-center bg-dark">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
    </div>
  </div>

<div class="container">
    <div class="row">
        <div class="card w-75">
            <div class="card-header">
                Lista de imágenes
                <a type="button" class="close" href="{{ route('dashboard') }}">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>

            <div class="card-body pl-1">

                @include('components.confirmacion')
                @include('components.flash-message')

                <div class="content px-3 pb-3">
                    <a href="{{ route('dashboard.image.new') }}" class="btn btn-primary btn-sm" title="nuevo juego">
                        <i class="far fa-edit"></i> Cargar nueva imágen
                    </a>
                </div>

                {{-- Tabla cargada utilizando datatables (ver scripts al pie de página) --}}
                <table id="dt-images" class="table table-striped table-sm table-bordered table-dark">
                    <thead>
                        <tr>
                            <th class='text-center'>id</th>
                            <th class='text-center'>nombre</th>
                            <th class='text-center'>juego_id</th>
                            <th class='text-center'>link imagen</th>
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
    var images = {!! json_encode($images); !!}; //paso los datos parseados como json
    var urlVer = '{!! route('dashboard.image.ver',":id") !!}';

    //la siguiente plantilla la utilizo como acciones dentro de la datatable
    //el string :id va a ser reemplazado via js por el id de la fila!
    var plantillaForm = `<form name="form_:id" action="{{ route('dashboard.image.delete',":id") }}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <div class="btn-group" role="group" aria-label="opciones">
                                        <button class="btn btn-danger btn-sm" form="form_:id" title="borrar" onclick="showConfirmacion(this)">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

                                    </div>
                                  </form>`;
</script>
{{-- Código principal de esta página --}}
<script src="{{ asset('js/images/allImages.js') }}"></script>
@endsection
