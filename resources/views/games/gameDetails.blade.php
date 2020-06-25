@extends('games.game')

@section('css-game')
<link rel="stylesheet" href="{{ asset('css/gameDetails/gameDetails.css') }}">
@endsection

@section('seleccion')

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
    <div class="d-flex flex-row justify-content-start w-100 heading my-3">
        <h1 class="pl-3">Detalles</h1>
    </div>
    <div class="d-flex flex-row justify-content-start w-100 my-3">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <h5> Generos: </h5>
                <div class="pl-3">
                    @foreach (json_decode($juego->genero) as $item)
                     <span class="badge badge-primary"><h5>{{ $item }}</h5></span>
                    @endforeach
                </div>
            </li>
            <li class="list-group-item">
                <h5>Plataformas:</h5>
                <div class="pl-3">
                    @foreach (json_decode($juego->plataforma) as $item)
                     <span class="badge badge-primary"><h5>{{ $item }}</h5></span>
                    @endforeach
                </div>
            </li>
            <li class="list-group-item">
                <h5>Descripción:</h5>
                <br>
                <div class="pl-3">{{ $juego->descripcion }}
                </div>
            </li>
        </ul>
    </div>
    <div class="d-flex flex-row justify-content-start w-100 heading my-3">
        <h1 class="pl-3">Imágenes</h1>
    </div>

    <div class="d-flex align-content-start flex-wrap bd-highlight mb-3 bg-secondary rounded">
        @foreach ($juego->imagenes as $img)
            <img title="{{ $img->nombre_vista }}" class="img-thumbnail m-3" src="{{ "data:image/png;base64, ".$img->imagen }}" alt="First slide" style="height: 150px;">
        @endforeach
        @foreach ($juego->imagenes as $img)
            <img title="{{ $img->nombre_vista }}" class="img-thumbnail m-3" src="{{ "data:image/png;base64, ".$img->imagen }}" alt="First slide" style="height: 150px;">
        @endforeach
        @foreach ($juego->imagenes as $img)
            <img title="{{ $img->nombre_vista }}" class="img-thumbnail m-3" src="{{ "data:image/png;base64, ".$img->imagen }}" alt="First slide" style="height: 150px;">
        @endforeach
        @foreach ($juego->imagenes as $img)
            <img title="{{ $img->nombre_vista }}" class="img-thumbnail m-3" src="{{ "data:image/png;base64, ".$img->imagen }}" alt="First slide" style="height: 150px;">
        @endforeach
        @if(!$juego->imagenes->count())
            <h1 class="w-100 text-center text-light"> Aún no hay imágenes.</h1>
        @endif
    </div>
</div>

@endsection

@section('scripts-game')
<script src="{{ asset('js/gameDetails/gameDetails.js') }}"></script>
@endsection
