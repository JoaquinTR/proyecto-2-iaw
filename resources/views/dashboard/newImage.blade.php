@extends('dashboard')

@section('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection

@section('seleccion-perfil')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Agregar nueva imagen a un juego
                    <a type="button" class="close" href="{{ route('dashboard') }}">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>

                <div class="card-body">

                    @include('components.flash-message')

                    <form method="POST" action="{{ route('dashboard.image.new') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Nombre:</label>
                            <input id="nombre" type="text" name="nombre" class="form-control" placeholder="">
                            @if ($errors->has('nombre'))
                                <span class="text-danger">{{ $errors->first('nombre') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Id del juego:</label>
                            <input id="juego_id" type="text" name="juego_id" class="form-control" placeholder="">
                            @if ($errors->has('juego_id'))
                                <span class="text-danger">{{ $errors->first('juego_id') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Selector de imágen:</label>
                            <input id="file" type="file" name="imagen" class="form-control">
                            @if ($errors->has('imagen'))
                                <span class="text-danger">{{ $errors->first('imagen') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button name="store_image" class="btn btn-success btn-submit" value="save">Finalizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/select2.min.js') }}" defer></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}" defer></script>
{{-- <script src="{{ asset('js/newImage/newImage.js') }}" defer></script> --}}
@endsection
