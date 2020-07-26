@extends('dashboard')

@section('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection

@section('seleccion-perfil')
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div class="card mb-3">
                <div class="card-header bg-primary text-light">
                    {{ $pedido->nombre }}
                </div>
                <div class="card-body bg-dark text-light">
                    @include('components.flash-message')
                    <h5 class="card-title">{{"Generos: ".$pedido->genero }}</h5>
                    <h5 class="card-title">{{"Plataformas: ".$pedido->plataforma }}</h5>
                    <h5 class="card-title">{{"Desarrolladores: ".$pedido->desarrollador }}</h5>
                    <h5 class="card-title">{{"Editores: ".$pedido->editor }}</h5>
                    <p class="card-text">{{$pedido->descripcion }}</p>
                    <h5 class="card-title">{{$pedido->fecha_lanzamiento }}</h5>
                </div>
                <div class="card-footer bg-dark text-light text-muted">
                   {{ $pedido->created_at }}
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary text-light">
                    Tomar pedido
                    <a type="button" class="close" href="{{ route('dashboard') }}">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('dashboard.pedido.tomar.create') }}">
                        {{ csrf_field() }}
                        <input id="pedido_id" name="pedido_id" type="hidden" value="{{ $pedido->id }}">

                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="nombre" class="form-control" placeholder="" value="{{ $pedido->nombre }}">
                            @if ($errors->has('nombre'))
                                <span class="text-danger">{{ $errors->first('nombre') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Descripción:</label>
                            <input type="text" name="desc" class="form-control" placeholder="" value="{{ $pedido->descripcion }}">
                            @if ($errors->has('desc'))
                                <span class="text-danger">{{ $errors->first('desc') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
                            <label for="date" class="control-label">Fecha de lanzamiento:</label>
                            <input id="datep" name="date" type="text" class="form-control" data-provide="datepicker" value="{{ $pedido->fecha_lanzamiento }}">
                            @if ($errors->has('date'))
                                <span class="text-danger">{{ $errors->first('date') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
                            <button class="btn btn-success btn-submit">Finalizar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/select2.min.js') }}" defer></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}" defer></script>
<script src="{{ asset('js/tomarPedido/tomarPedido.js') }}" defer></script>
@endsection
