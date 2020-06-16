@extends('layouts.app')

@section('content')
    <div class="ml-5 d-flex flex-row">
        <div class="justify-content-left">
            <div class="card">
                <div class="card-header">
                    Administración
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
                        <div class="mt-2">
                            <a class="btn btn-primary btn-block" href="{{ route('modify_data') }}">
                                Modificar datos
                            </a>
                        </div>

                        <div class="mt-2">
                            <a class="btn btn-primary btn-block" href="{{ route('modify_passw') }}">
                                Cambiar contraseña
                            </a>
                        </div>

                        <div class="my-2">
                            <a class="btn btn-primary  btn-block" href="{{ route('password.request') }}">
                                Resetear contraseña
                            </a>
                        </div>
                    </div>

                    <hr/>

                    <div class="p-2 d-flex flex-column">
                        <div class="mt-2">
                            <a class="btn btn-primary  btn-block" href="{{ route('dashboard.game') }}">
                                Cargar juego
                            </a>
                        </div>

                        <div class="mt-2">
                            <a class="btn btn-primary  btn-block" href="{{ route('dashboard.decoradores') }}">
                                Cargar decoradores de juegos
                            </a>
                        </div>

                        <div class="mt-2">
                            <a class="btn btn-primary  btn-block" href="{{ route('dashboard.game') }}">
                                BAN HAMMER
                            </a>
                        </div>

                    </div>

                    <hr/>

                    <div class="p-2 d-flex flex-column">
                        <div class="mt-2">
                            <a class="btn btn-primary  btn-block" href="{{ route('dashboard.game') }}">
                                Ver juegos
                            </a>
                        </div>

                        <div class="mt-2">
                            <a class="btn btn-primary  btn-block" href="{{ route('dashboard.game') }}">
                                Ver decoradores de juegos
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
