<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ Session::token() }}"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandro's books</title>
    <link rel="stylesheet" href="{{ asset('css/plugins/materialize.min.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/font-awesome.min.css') }}">
    @if (!Request::is('admin/*') && !Request::is('admin') && !Request::is('login') && !Request::is('password/*'))
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/owl.carousel.min.css') }}"> 
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/simplelightbox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=1.1">   
    @endif
    @yield('header')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    @if ((!Request::is('admin/*') && !Request::is('admin') && !Request::is('login')) && !Request::is('password/*') && ($Mode == 'black'))
    <body class="night-mode">
    @else
    <body>
    @endif

    @if (!Request::is('admin/*') && !Request::is('admin') && !Request::is('login') && !Request::is('password/*'))
        @include('shared.header')
    @endif

    <!-- content start -->
    
    @yield('content')

    <!-- content end -->

    @if (!Request::is('admin/*') && !Request::is('admin') && !Request::is('login') && !Request::is('password/*') && !Request::is('works/*'))
        @include('shared.footer')
    @endif

    <script src="{{ asset('js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/plugins/materialize.min.js') }}"></script>
    <script src="{{ asset('js/plugins/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/plugins/simple-lightbox.min.js') }}"></script>
    <script src="{{ asset('js/plugins/aos.js') }}"></script>
    @yield('footer')
    <script src="{{ asset('js/script.js') }}?v=1.1"></script>
    </body>
</html>
