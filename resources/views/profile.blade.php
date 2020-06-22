@extends('layouts.app')

@section('content')
    <div class="ml-5 mt-3 d-flex flex-row">
        <div class="justify-content-left">
            <div class="card">
                <div class="card-header">
                    Perfil de usuario
                </div>
                <div class="">

                    <div class="p-2 d-flex flex-column">
                        <div class="">
                            Nombre:
                        </div>
                        <div class="text-center">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="">
                            E-mail:
                        </div>
                        <div class="text-center">
                            {{ Auth::user()->email }}
                        </div>
                    </div>

                    <hr/>

                    <div class="p-2 d-flex flex-column">
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
