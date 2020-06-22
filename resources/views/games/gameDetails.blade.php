@extends('games.game')

@section('css-game')
    <style>
        .heading{
            border-left: 4px solid var(--primary);
        }
        .list-group-item{
            background-color: transparent !important;
        }
        .badge h5{
            margin: 0 !important;
        }
    </style>
@endsection

@section('seleccion')
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

    <div class="d-flex align-content-start flex-wrap bd-highlight mb-3">
        @foreach ($juego->imagenes as $img)
            <img title="{{ $img->nombre_vista }}" class="img-thumbnail m-3" src="{{ "data:image/png;base64, ".$img->imagen }}" alt="First slide" style="height: 150px;">
        @endforeach
    </div>
</div>

@endsection
