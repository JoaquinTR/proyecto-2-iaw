@extends('dashboard')

@section('seleccion-perfil')
<style>
  .push-top {
    margin-top: 50px;
  }
</style>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Cargar decoradores</div>

            <div class="card-body">

                @include('components.flash-message')

                <table class="table table-striped table-sm table-dark">
                    <thead>
                        <tr class="">
                            <td scope="col">id</td>
                            <td scope="col">Nombre</td>
                            <td scope="col">Imagen</td>
                            <td scope="col">Fecha Lanzamiento</td>
                            <td scope="col">Descripcion</td>
                            <td scope="col">Plataforma</td>
                            <td scope="col">Editor</td>
                            <td scope="col">Desarrollador</td>
                            <td class="text-center">Opciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($juegos as $juego)
                        <tr>
                            <td scope="row">{{$juego->id}}</td>
                            <td scope="row">{{$juego->nombre}}</td>
                            <td>{{$juego->imagen}}</td>
                            <td>{{$juego->fecha_lanzamiento}}</td>
                            <td class="p-0">
                                <div class="position-relative p-3">
                                    <a href="#" class="text-info stretched-link">
                                        {{substr($juego->descripcion,0,20)."[...]"}}
                                    </a>
                                </div>
                            </td>
                            <td class="p-0">
                                <div class="position-relative p-3">
                                    <a href="#" class="text-info stretched-link">
                                        {{substr($juego->plataforma,0,20)."[...]"}}
                                    </a>
                                </div>
                            </td>
                            <td class="p-0">
                                <div class="position-relative p-3">
                                    <a href="#" class="text-info stretched-link">
                                        {{substr($juego->editor,0,20)."[...]"}}
                                    </a>
                                </div>
                            </td>
                            <td class="p-0">
                                <div class="position-relative p-3">
                                    <a href="#" class="text-info stretched-link">
                                        {{substr($juego->desarrollador,0,20)."[...]"}}
                                    </a>
                                </div>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('dashboard.game.delete',$juego->id) }}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <div class="btn-group" role="group" aria-label="opciones">

                                        <a href="{{ route('dashboard.game.edit',$juego->id) }}" class="btn btn-primary btn-sm"">
                                            <i class="far fa-edit"></i>
                                        </a>

                                        <button class="btn btn-danger btn-sm"" type="submit">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

                                    </div>
                                  </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>

@endsection
