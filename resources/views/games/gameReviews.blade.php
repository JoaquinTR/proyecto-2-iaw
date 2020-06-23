@extends('games.game')

@section('css-game')
<link rel="stylesheet" href="{{ asset('css/gameDetails/gameDetails.css') }}">
<link rel="stylesheet" href="{{ asset('css/gameReviews/gameReviews.css') }}">
@endsection

@section('seleccion')
<div class="container">

    <div class="mx-3 mt-5">
        @include('components.flash-message')
        <div class="d-flex flex-row justify-content-start w-100 heading mt-3">
            <h1 class="pl-1">Panel</h1>
        </div>
        <div class="card my-3 border-secondary">
            <div class="d-flex">
                <h5 class="w-50 card-header pull-left border-r border-secondary">Calificar</h5>
                <h5 class="w-50 card-header pull-right border-secondary">Estadísticas</h5>
            </div>
            <div class="card-body p-0">
                <div class="d-flex">
                    <div class="flex-column w-50 border-r">
                        <form id="form-edit" method="POST" action="{{ route('calificacion.nueva',$juego->id) }}">
                            {{ csrf_field() }}

                            <div class="container  my-3">

                                <div class="progress bg-dark round">
                                    <div id="puntaje-meter" class="progress-bar" role="progressbar" style="width: 0%; background-color: orange;" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <input id="puntaje" name="puntaje" type="hidden" value="">

                                <div class="d-flex w-100 mt-1 rounded bg-dark text-light mb-3">
                                    <div class="w-100 hover text-center border border-secondary rounded-left">1</div>
                                    <div class="w-100 hover text-center border border-secondary">2</div>
                                    <div class="w-100 hover text-center border border-secondary">3</div>
                                    <div class="w-100 hover text-center border border-secondary">4</div>
                                    <div class="w-100 hover text-center border border-secondary">5</div>
                                    <div class="w-100 hover text-center border border-secondary">6</div>
                                    <div class="w-100 hover text-center border border-secondary">7</div>
                                    <div class="w-100 hover text-center border border-secondary">8</div>
                                    <div class="w-100 hover text-center border border-secondary">9</div>
                                    <div class="w-100 hover text-center border border-secondary rounded-right">10</div>
                                </div>

                                @if ($errors->has('puntaje'))
                                    <span class="text-danger">{{ $errors->first('puntaje') }}</span>
                                @endif

                                <div class="form-group">
                                    <label>Descripcion:</label>
                                    <input type="text" name="descripcion" class="form-control" placeholder="">
                                    @if ($errors->has('descripcion'))
                                        <span class="text-danger">{{ $errors->first('descripcion') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Reseña:</label>
                                    <textarea name="reseña" class="form-control" placeholder=""></textarea>
                                    @if ($errors->has('reseña'))
                                        <span class="text-danger">{{ $errors->first('reseña') }}</span>
                                    @endif
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="select">Tipo de reseña</label>
                                    </div>
                                    <select name="tipo" class="custom-select" id="select">
                                        <option selected value="">Opciones...</option>
                                        <option value="jugador">Jugador</option>
                                        <option value="casual">Casual</option>
                                    </select>
                                </div>
                                @if ($errors->has('tipo'))
                                        <span class="text-danger">{{ $errors->first('tipo') }}</span>
                                    @endif

                                <div class="form-group mb-3">
                                    @guest
                                    <button title="Por favor, logueate para calificar." class="btn btn-success btn-submit disabled" form="form-edit" disabled>Finalizar</button>
                                    @else
                                    <button class="btn btn-success btn-submit" form="form-edit">Finalizar</button>
                                    @endguest

                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="flex-column w-50">
                        <div class="container my-2 h-100">
                            <div class="d-flex mt-1 rounded text-light mb-3  h-100">
                                <ol class="list-group w-100  h-100" >

                                    @foreach ($calificaciones as $idx => $count)
                                    <li class="d-flex flex-row  h-100">
                                        <span class="text-center text-dark" style="width: 25%;">
                                            {{ $idx }} ({{ $count }})
                                        </span>
                                        <span style="width: 75%;">
                                            <div class="progress bg-dark round">
                                                <div id="meter-{{ $idx }}" class="progress-bar" role="progressbar" style="width: {{ ($count>0) ? (100*$count)/$total : 0 }}%; background-color: orange;" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </span>
                                    </li>
                                    @endforeach

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @auth   {{-- solo si está logeado --}}
    <div class="mx-3 mt-5">
        <div class="d-flex flex-row justify-content-start w-100 heading mt-3">
            <h1 class="pl-1">Mis calificaciones de este juego</h1>
        </div>
        <div class="my-3">
            <div class="card-columns">
                @foreach ($mis_calificaciones as $idx => $calificacion)
                    <div class="card">
                        <div class="card-header p-2">
                            <h5 class="card-title text-center mb-1">{{ $calificacion->descripcion }}</h5>
                        </div>
                        <h4 class="card-title bg-dark text-center game-font text-light">{{ $calificacion->puntaje }}</h4>
                        <div class="card-body">
                            <p class="card-text">{{ $calificacion->reseña }}</p>
                            <p class="card-text text-right"><small class="text-muted">{{ $calificacion->created_at }}</small></p>
                        </div>
                    </div>
                @endforeach
            <div>
        </div>
    </div>
    @endauth

    <div class="mx-3 mt-5">
        <div class="d-flex flex-row justify-content-start w-100 heading mt-3">
            <h1 class="pl-1">Calificaciones de usuarios</h1>
        </div>
        <div class="card my-3 border-secondary">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link {{ ($filtro == 'recientes') ? 'active' : '' }}" href="{{ route('game.review',['id'=>$juego->id,'filtro'=>'recientes']) }}">Recientes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ ($filtro == 'viejos') ? 'active' : '' }}" href="{{ route('game.review',['id'=>$juego->id,'filtro'=>'viejos']) }}">Más viejas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ ($filtro == 'calif_alta') ? 'active' : '' }}" href="{{ route('game.review',['id'=>$juego->id,'filtro'=>'calif_alta']) }}">Mejor puntaje</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ ($filtro == 'calif_baja') ? 'active' : '' }}" href="{{ route('game.review',['id'=>$juego->id,'filtro'=>'calif_baja']) }}">Menor puntaje</a>
                  </li>
                </ul>
            </div>
            <div class="card-body p-2">
                @if(!empty($calif_users) && $calif_users->count())
                    <div class="card-columns">

                        @foreach ($calif_users as $idx => $calificacion)
                            <div class="card">
                                <div class="card-header p-2">
                                    <h5 class="card-title text-center mb-1">{{ $calificacion->descripcion }}</h5>
                                </div>
                                <h4 class="card-title bg-dark text-center game-font text-light">{{ $calificacion->puntaje }}</h4>
                                <div class="card-body">
                                    <p class="card-text">{{ $calificacion->reseña }}</p>
                                    <p class="card-text d-flex justify-content-between">
                                        <small class="">{{ $calificacion->users->name }}</small>
                                        <small class="text-muted">{{ $calificacion->created_at }}</small>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h1 class="w-100 text-center"> No hay comentarios aún</h1>
                @endif

                @if(!empty($calif_users) && $calif_users->count())
                    <div class="text-center">
                        {!! $calif_users->links() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts-game')
<script src="{{ asset('js/gameReviews/gameReviews.js') }}"></script>
@endsection
