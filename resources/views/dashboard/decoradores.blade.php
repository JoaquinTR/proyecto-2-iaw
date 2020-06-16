@php
    if(Auth::user()->isAdmin()){
        $layout = 'dashboard';
    }else{
        $layout = 'profile';
    }
@endphp

@extends($layout)

@section('seleccion-perfil')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cargar decoradores</div>

                <div class="card-body">

                    @include('components.flash-message')

                    <form method="POST" action="{{ url('/decoradores/genero') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Nombre genero:</label>
                            <input type="text" name="genero" class="form-control">
                            @if ($errors->has('genero'))
                                <span class="text-danger">{{ $errors->first('genero') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success btn-submit">Crear Genero</button>
                        </div>

                    </form>

                    <form method="POST" action="{{ url('/decoradores/plataforma') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Nombre plataforma:</label>
                            <input type="text" name="plataforma" class="form-control">
                            @if ($errors->has('plataforma'))
                                <span class="text-danger">{{ $errors->first('plataforma') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success btn-submit">Crear Editor</button>
                        </div>

                    </form>

                    <form method="POST" action="{{ url('/decoradores/editor') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Nombre editor:</label>
                            <input type="text" name="editor" class="form-control">
                            @if ($errors->has('editor'))
                                <span class="text-danger">{{ $errors->first('editor') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success btn-submit">Crear Editor</button>
                        </div>

                    </form>

                    <form method="POST" action="{{ url('/decoradores/desarrollador') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Nombre desarrollador:</label>
                            <input type="text" name="desarrollador" class="form-control">
                            @if ($errors->has('desarrollador'))
                                <span class="text-danger">{{ $errors->first('desarrollador') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success btn-submit">Crear desarrollador</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
