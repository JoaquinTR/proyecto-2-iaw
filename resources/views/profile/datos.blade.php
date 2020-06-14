@extends('profile')

@section('seleccion-perfil')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modificar Datos</div>

                <div class="card-body">

                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                    @endif

                    <form method="POST" action="{{ url('/profile/modify') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="name" class="form-control" placeholder="{{ Auth::user()->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <strong>Email:</strong>
                            <input type="text" name="email" class="form-control" placeholder="{{ Auth::user()->email }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
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
