<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ Session::token() }}"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Geolab Sandro</title>
        <link rel="stylesheet" href="{{ asset('css/plugins/materialize.min.css') }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/plugins/font-awesome.min.css') }}">
    @if (!Request::is('admin/*') && !Request::is('admin'))
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">   
    @endif
    @yield('header')
    </head>
    <body>
    
    <!-- content start -->
    
    @yield('content')

    <!-- content end -->
    
    <script src="{{ asset('js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/plugins/materialize.min.js') }}"></script>
    @yield('footer')
    <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
