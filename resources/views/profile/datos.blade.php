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
                <div class="card-header">Modificar Datos</div>

                <div class="card-body">

                    @include('components.flash-message')

                    <form method="POST" action="{{ url('/profile/modify/name') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="name" class="form-control" placeholder="{{ Auth::user()->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success btn-submit">Cambiar Nombre</button>
                        </div>

                    </form>

                    <form method="POST" action="{{ url('/profile/modify/email') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="text" name="email" class="form-control" placeholder="{{ Auth::user()->email }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success btn-submit">Cambiar email</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
