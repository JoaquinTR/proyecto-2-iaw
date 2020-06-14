@extends('layouts.app')

@section('content')
    <div class="ml-5 d-flex flex-row">
        <div class="justify-content-left">
            <div class="card">
                <div class="card-header">
                    Perfil de usuario
                </div>
                <div class="">
                    <div class="p-2 d-flex flex-column">
                        <div class="">
                            Nombre: {{ Auth::user()->name }}
                        </div>
                        <div class="">
                            E-mail: {{ Auth::user()->email }}
                        </div>
                    </div>
                    <hr/>
                    <div class="p-2 d-flex flex-column">
                        <div class="mb-2">
                            <a class="btn btn-primary btn-block" href="{{ route('modify') }}">
                                Modificar datos
                            </a>
                        </div>
                        @if(! Auth::user()->isVerified())
                            <div class="mb-2">
                                <a class="btn btn-primary btn-block" href="{{ route('verify') }}">
                                    Validar cuenta
                                </a>
                            </div>
                        @endif
                        <div class="mb-2">
                            <a class="btn btn-primary btn-block" href="{{ route('contraseña') }}">
                                Cambiar contraseña
                            </a>
                        </div>
                        <div class="">
                            <a class="btn btn-primary  btn-block" href="{{ route('password.request') }}">
                                Resetear contraseña
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-fill">
            @yield('seleccion-perfil')
        </div>
    </div>


@endsection
