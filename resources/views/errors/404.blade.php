<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ URL::asset('favicon.png') }}" type="image/x-icon"/>
    <title>Gaming Place</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style type="text/css">
        @font-face {
            font-family: "GameFont";
            src: url('{{ URL::asset('fonts/AmazOOSTROVItalic.woff') }}');
        }
    </style>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/404/404.css') }}">

</head>
<body class="text-white">
    <div class="flex-center-vertical ">
        <div class="flex-center position-ref">
            <div class="code">
                404
            </div>

            <div class="message" style="padding: 10px;">
                Not Found
            </div>
        </div>

        <div class="flex-center" style="padding: 10px;">
            <span class="game-font">© Gaming Place</span>
        </div>
        <div class="flex-center" style="padding: 10px;">
            <a id="back" class="btn btn-primary">
                ¿Volvemos?
            </a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/404.js') }}" defer></script>
</body>
</html>
