@extends('profile')

@section('seleccion-perfil')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modificar contraseña</div>

                <div class="card-body">

                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                    @endif

                    <form method="POST" action="{{ url('/profile/contraseña') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Nueva contraseña:</label>
                            <input type="password" name="password" class="form-control" placeholder="">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Repita la contraseña:</label>
                            <input type="password" name="passwordr" class="form-control" placeholder="repetir contraseña">
                            @if ($errors->has('passwordr'))
                                <span class="text-danger">{{ $errors->first('passwordr') }}</span>
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
