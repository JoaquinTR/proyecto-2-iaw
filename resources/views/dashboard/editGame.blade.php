@extends('dashboard')

@section('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection

@section('seleccion-perfil')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Editar juego</div>

                <div class="card-body">

                    @include('components.flash-message')

                    <form id="form-edit" method="POST" action="{{ route('dashboard.game.edit',$id) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="nombre" class="form-control" placeholder="">
                            @if ($errors->has('nombre'))
                                <span class="text-danger">{{ $errors->first('nombre') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Descripción:</label>
                            <input type="text" name="desc" class="form-control" placeholder="">
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
                            <input id="datep" name="date" type="text" class="form-control" data-provide="datepicker">
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

                    </form>

                    <div class="form-group">
                        <button class="btn btn-success btn-submit" form="form-edit">Finalizar</button>
                        <a class="btn btn-secondary" href="{{ route('dashboard.game.all') }}">Cancelar</a>
                        <button class="btn btn-secondary" id="reset-form">Resetear campos</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/select2.min.js') }}" defer></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}" defer></script>
<script type="text/javascript">
    var url = '{!! route('dashboard.game.ajax',$id) !!}'
</script>
<script src="{{ asset('js/editGame/editGame.js') }}" defer></script>
@endsection
