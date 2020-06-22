@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/game/game.css') }}">
@yield('css-game')
@endsection

@section('content')
    <div class="w-100 fondo" style="background: url(data:image/png;base64,{!! $imagen_fondo !!}) no-repeat left center; background-size: cover;">
        <div class="d-flex flex-column  justify-content-end align-items-baseline h-100">

            <div class="d-flex w-100 my-auto">
                <div class="w-75 d-flex">
                    <div class="w-25 mr-5 d-flex flex-column justify-content-center">
                        <div class="w-100 pl-3">
                            <img class="w-100" src="data:image/png;base64,{!! $imagen_principal !!}">
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-start">
                        <div class="mt-auto text-light text-shadow">
                            <h1>{{ $juego->nombre }}</h1>
                        </div>
                        <div class="mb-auto text-light text-shadow">
                            <h4>Fecha de lanzamiento: {{ $juego->fecha_lanzamiento }}</h4>
                        </div>
                    </div>
                </div>
                <div class="w-25 d-flex justify-content-end">
                    <div class="my-auto d-flex flex-column">
                        <div id="outer" class="my-auto d-flex text-light bg-light circular mr-5 justify-content-center align-items-center">
                            <div class="d-flex text-light bg-dark circular-inner justify-content-center align-items-center">
                                <h1 id="rating" class="game-font mb-0"> {{ round($juego->rating,1) }} </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100">
                <ul class="nav nav-tabs pl-5 border-bottom border-dark">
                    <li class="nav-item bg-light border-top border-dark border-2 active border-left border-right">
                      <a class="nav-link active" href="{{ route('game.detalles',$juego->id) }}">Detalles</a>
                    </li>
                    <li class="nav-item bg-light border-top border-dark border-2 border-right">
                      <a class="nav-link" href="{{ route('game.review',$juego->id) }}">Calificaciones</a>
                  </ul>
            </div>

        </div>
    </div>

    <div class="content">
        @yield('seleccion')
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/game/game.js') }}"></script>
@yield('scripts-game')
@endsection
