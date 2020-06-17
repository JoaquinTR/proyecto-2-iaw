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
                            <input type="text" name="nombre" class="form-control">
                            @if ($errors->has('nombre'))
                                <span class="text-danger">{{ $errors->first('nombre') }}</span>
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
                            <input type="text" name="nombre" class="form-control">
                            @if ($errors->has('nombre'))
                                <span class="text-danger">{{ $errors->first('nombre') }}</span>
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
                            <input type="text" name="nombre" class="form-control">
                            @if ($errors->has('nombre'))
                                <span class="text-danger">{{ $errors->first('nombre') }}</span>
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
                            <input type="text" name="nombre" class="form-control">
                            @if ($errors->has('nombre'))
                                <span class="text-danger">{{ $errors->first('nombre') }}</span>
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
