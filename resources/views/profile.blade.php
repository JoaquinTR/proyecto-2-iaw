@extends('layouts.app')

@section('content')
    <div class="ml-5 mt-3 d-flex flex-row">
        <div class="justify-content-left w-20">
            <div class="card">
                <div class="card-header">
                    Perfil de usuario
                </div>
                <div class="">

                    <div class="p-2 d-flex flex-column">
                        <div class="">
                            <strong>Nombre:</strong>
                        </div>
                        <div class="text-center">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="">
                            <strong>E-mail:</strong>
                        </div>
                        <div class="text-center">
                            {{ Auth::user()->email }}
                        </div>
                        <div class="">
                            <strong>api_token:</strong>
                        </div>
                        <div class="text-center text-break">
                            {{ Auth::user()->api_token }}
                        </div>
                    </div>

                    <hr/>

                    <div class="p-2 d-flex flex-column">
                        <div class="mb-2">
                            <a class="btn btn-primary btn-block" href="{{ route('token.reset') }}">
                                Resetear token
                            </a>
                        </div>
                        <div class="mb-2">
                            <a class="btn btn-primary btn-block" href="{{ route('modify_data') }}">
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
                            <a class="btn btn-primary btn-block" href="{{ route('modify_passw') }}">
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
