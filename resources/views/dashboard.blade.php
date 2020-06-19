@extends('layouts.app')

@section('content')
    <div class="ml-3 d-flex flex-row">
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
                            <a class="btn btn-primary  btn-block" href="{{ route('dashboard.game.all') }}">
                                Administrar juegos
                            </a>
                        </div>

                        <div class="mt-2">
                            <a class="btn btn-primary  btn-block" href="{{ route('dashboard.image.all') }}">
                                Administrar imágenes
                            </a>
                        </div>

                        <div class="my-2">
                            <a class="btn btn-primary  btn-block" href="{{ route('dashboard.decoradores.all') }}">
                                Administrar decoradores de juegos
                            </a>
                        </div>
                    </div>

                    <hr/>

                    <div class="p-2 d-flex flex-column">

                        <div class="mt-2">
                            <a class="btn btn-primary  btn-block" href="{{ route('dashboard.usuarios') }}">
                                Ver usuarios
                            </a>
                        </div>

                        <div class="my-2">
                            <a class="btn btn-primary  btn-block" href="{{ route('dashboard.calificacion.all') }}">
                                Ver calificaciones
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
