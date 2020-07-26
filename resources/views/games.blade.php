@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/games/games.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gameDetails/gameDetails.css') }}">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    @yield('css-resultados')
@endsection

@section('content')

<div class="container text-center my-3">
    <h1 class="game-font">JUEGOS</h1>
</div>

<div class="container">
    <div class="d-flex flex-row justify-content-start w-100 heading my-3">
        <h1 class="pl-3">Filtros</h1>
    </div>
</div>
<div class="container">

    @include('components.flash-message')

    <form action="{{ route('games') }}" method="post">
        {{ csrf_field() }}
        @if(empty($filtrado) || !$filtrado)
        <div class="form-group d-flex">
            <div class="w-50 h-100 mr-3">
                <label>Nombre:</label>
                <input type="text" name="nombre" class="form-control" placeholder="">
                @if ($errors->has('nombre'))
                    <span class="text-danger">{{ $errors->first('nombre') }}</span>
                @endif
            </div>
            <div class="w-50 h-100">
                <label for="generos" class="control-label">Genero(s):</label>
                <select name="generos_id[]" class="form-control" multiple="multiple" id="generos">
                    @foreach ($generos as $i => $genero)
                        <option value="{{ $genero->{"nombre"} }}">{{ $genero->{"nombre"} }}</option>
                    @endforeach
                </select>
                @if ($errors->has('generos_id'))
                    <span class="pl-3 row text-danger">{{ $errors->first('generos_id') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group d-flex">
            <div class="w-50 h-100 mr-3">
                <label for="plataformas" class="control-label">Plataforma(s):</label>
                <select name="plataformas_id[]" class="form-control" multiple="multiple" id="plataformas">
                    @foreach ($plataformas as $i => $plataforma)
                        <option value="{{ $plataforma->{"nombre"} }}">{{ $plataforma->{"nombre"} }}</option>
                    @endforeach
                </select>
                @if ($errors->has('plataformas_id'))
                    <span class="pl-3 row text-danger">{{ $errors->first('plataformas_id') }}</span>
                @endif
            </div>
            <div class="w-50 h-100">
                <label for="editores" class="control-label">Editor(es):</label>
                <select name="editores_id[]" class="form-control" multiple="multiple" id="editores">
                    @foreach ($editores as $i => $editor)
                        <option value="{{ $editor->{"nombre"} }}">{{ $editor->{"nombre"} }}</option>
                    @endforeach
                </select>
                @if ($errors->has('editores_id'))
                    <span class="pl-3 row text-danger">{{ $errors->first('editores_id') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group w-50 mr-auto pr-2">
            <label for="desarrolladores" class="control-label">Desarrollador(es):</label>
            <select name="desarrolladores_id[]" class="form-control" multiple="multiple" id="desarrolladores">
                @foreach ($desarrolladores as $i => $desarrollador)
                    <option value="{{ $desarrollador->{"nombre"} }}">{{ $desarrollador->{"nombre"} }}</option>
                @endforeach
            </select>
            @if ($errors->has('desarrolladores_id'))
                <span class="pl-3 row text-danger">{{ $errors->first('desarrolladores_id') }}</span>
            @endif
        </div>

        <div class="form-group d-flex">
            <div class="w-50 h-100 mr-3">
                <label for="date" class="control-label">Fecha de lanzamiento desde:</label>
                <input id="datep" name="date" type="text" class="form-control" data-provide="datepicker">
                @if ($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
            </div>
            <div class="w-50 h-100">
                <label for="orden">Ordenamiento por fecha:</label>
                <select class="form-control" id="orden" name="orden">
                    <option value=""></option>
                    <option value="DESC">descendiente</option>
                    <option value="ASC">ascendente</option>
                </select>
            </div>
        </div>

        <div class="form-group w-50 mr-auto pr-2">
            <label for="date-hasta" class="control-label">Fecha de lanzamiento hasta:</label>
                <input id="datep" name="date-hasta" type="text" class="form-control" data-provide="datepicker">
                @if ($errors->has('date-hasta'))
                    <span class="text-danger">{{ $errors->first('date-hasta') }}</span>
                @endif
        </div>
        @endif
        <div class="form-group text-center">
            @if(empty($filtrado) || !$filtrado)
            <button class="btn btn-success btn-submit w-25" type="submit">Filtrar</button>
            <a class="btn btn-secondary w-25" href="{{ route('games') }}">Resetear filtros</a>
            @else
            <a class="btn btn-success w-25" href="{{ route('games') }}">Resetear filtros</a>
            @endif

        </div>
    </form>
</div>

{{-- Resultados --}}
<div class="container">
    <div class="d-flex flex-row justify-content-start w-100 heading mt-3">
        @if(empty($filtrado) || !$filtrado)
        <h1 class="pl-1">Juegos</h1>
        @else
        <h1 class="pl-1">Resultados</h1>
        @endif
    </div>
    <div class="card my-3 border-secondary bg-secondary">
        <div class="card-body p-2">
            @if(!empty($juegos) && $juegos->count())
                <div class="card-columns">

                    @foreach ($juegos as $idx => $juego)
                        <div class="card" href="{{ route('game',$juego->id) }}">
                            <img
                            class="card-img-top"
                            src=" {{ ($juego->imagenes->count()) ? "data:image/png;base64,".$juego->imagenes[array_search('principal', array_column($juego->imagenes->toArray(), 'nombre_vista'))]->imagen : asset("images/principal.jpg") }}"
                            alt="Card image cap"
                            >
                            <div class="card-body">
                                <p class="card-text">{{ $juego->nombre }}</p>
                                <hr/>
                                <p class="card-text pt-3 mb-0">Generos</p>
                                @foreach (json_decode($juego->genero) as $g)
                                  <span class="badge badge-pill badge-primary">{{ $g }}</span>
                                @endforeach
                                <p class="card-text pt-3 mb-0">Plataformas</p>
                                @foreach (json_decode($juego->plataforma) as $p)
                                  <span class="badge badge-pill badge-primary">{{ $p }}</span>
                                @endforeach
                                <p class="card-text pt-3 mb-0">Fecha de lanzamiento: {{ $juego->fecha_lanzamiento }}</p>
                            </div>
                          </div>
                    @endforeach
                </div>
            @else
                <h1 class="w-100 text-center"> No se encontraron juegos </h1>
            @endif

            @if(!empty($juegos) && $juegos->count())
                <div class="text-center">
                    {!! $juegos->links() !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/select2.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}" defer></script>
    <script src="{{ asset('js/games/games.js') }}"></script>
    @yield('scripts-resultados')
@endsection
