@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
@endsection

@section('body')


@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('components.flash-message')
            </div>
        </div>
    </div>


    <div class="w-100 bg-dark mb-3 pb-3 shadow">
        <div class="pt-3 text-center w-100 text-light">
            <h1 class="game-font"> RECIENTES</h1>
        </div>
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($juegos_nuevos_recientes as $i => $juego)
                <li data-target="#carousel" data-slide-to="{{ $i }}" class="{{$i == 0 ? 'active' : '' }}"></li>
            @endforeach
          </ol>
        <div class="carousel-inner">
            @foreach($juegos_nuevos_recientes as $i => $juego)
                <div class="carousel-item {{$i == 0 ? 'active' : '' }}">

                    <a href='{{ route('game',$juego->id) }}' class="">
                        <img class="d-block w-50" src="{{ ($juego->imagenes->count()) ? "data:image/png;base64, ".$juego->imagenes[array_search('principal', array_column($juego->imagenes->toArray(), 'nombre_vista'))]->imagen : asset('images/principal.jpg') }}" alt="First slide">
                    </a>

                    <div class="carousel-caption d-none d-md-block">
                        <div class="bg-dark">
                            <h5>{{ $juego->nombre }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

    <div class="w-100">
        <div id="p-container" class="py-3 d-flex justify-content-between">

            <div id="p-comentarios" class="mb-3 d-flex bg-dark w-50 h-100 mx-5 card top-comentarios shadow-lg">
                <div class="card-header text-center">
                    <h1 class="game-font text-light">MAS COMENTADOS</h1>
                </div>
                <div class="list-group bg-dark">
                    @foreach($juegos_mas_comentados as $juego)
                        <a href="{{ route('game',$juego->id) }}" class="list-group-item bg-light text-dark">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="list-group-item-heading">{{ $juego->nombre }}</h6>
                                    <div class="d-flex justify-content-between">
                                        <div class="pull-left">
                                            <h6>Calificaciones</h6>
                                        </div>

                                    </div>
                                </div>

                                <div class="">
                                    <h1 class="game-font l-space align-middle">{{ $juego->cant_calificaciones }}</h1>
                                </div>
                            </div>
                        </a>
                    @endforeach

                  </div>
            </div>

            <div id="p-rating" class="mb-3 d-flex flex-column bg-dark w-50 h-100 mx-5 card top-rating shadow-lg">
                <div class="card-header text-center">
                    <h1 class="game-font text-light">TOP 5</h1>
                </div>
                @foreach($juegos_rating as $juego)
                    <a href="{{ route('game',$juego->id) }}" class="list-group-item bg-light text-dark">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="list-group-item-heading">{{ $juego->nombre }}</h6>
                                <div class="d-flex justify-content-between">
                                    <div class="pull-left">
                                        <h6>Puntaje</h6>
                                    </div>

                                </div>
                            </div>

                            <div class="">
                                <h1 class="game-font l-space align-middle">{{ round($juego->rating,1) }}</h1>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>





@endsection

@section('scripts')
<script>
    $(window).resize(function(){

        if ($(window).width() <= 750) {

            $('#p-container').addClass('flex-column');
            $('#p-comentarios').removeClass('w-50');
            $('#p-comentarios').addClass('mr-3');
            $('#p-comentarios').addClass('w-75');
            $('#p-rating').removeClass('w-50');
            $('#p-rating').addClass('w-75');
            $('#p-rating').addClass('mr-3');

        }else{
            $('#p-container').removeClass('flex-column');
            $('#p-comentarios').addClass('w-50');
            $('#p-comentarios').removeClass('w-75');
            $('#p-comentarios').removeClass('mr-3');
            $('#p-rating').addClass('w-50');
            $('#p-rating').removeClass('w-75');
            $('#p-rating').removeClass('mr-3');

        }

    });
</script>
@endsection
