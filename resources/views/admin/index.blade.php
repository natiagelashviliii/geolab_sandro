@extends('index')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/fileinput.css') }}">
    @yield('sub_header')
@endsection

@section('content')

<section class="row">
    <header class="admin-header">
        <ul class="admin-menu">
            <li><a @if(Request::is('admin/about')) class="active-link" @endif href="{{ url('admin/about') }}">About</a></li>
            <li><a @if(Request::is('admin/works')) class="active-link" @endif href="{{ url('admin/works') }}">Works</a></li>
            <li><a @if(Request::is('admin/contact')) class="active-link" @endif href="{{ url('admin/contact') }}">Contact</a></li>
        </ul>
        <ul class="admin-menu admin-bottom-menu">
            <li><a @if(Request::is('admin/user')) class="active-link" @endif href="{{ url('admin/user') }}">User</a></li>
            <li><a href="{{ url('/logout') }}">Logout</a></li>
        </ul>
        <button class="resp-menu-btn"><i class="large material-icons">more_vert</i></button>
    </header>

    <div class="admin-main col s12 m9 xl10 offset-xl2 offset-m3">
        @yield('section')
    </div>
</section>

@endsection

@section('footer')
    <!-- <script src="{{ asset('js/plugins/files.js') }}"></script> -->
    <script src="{{ asset('js/plugins/jform.js') }}"></script>
    <script src="{{ asset('js/plugins/jalerts.js') }}"></script>
    <script src="{{ asset('js/plugins/fileinput.js') }}"></script>
    <script src="{{ asset('js/plugins/files-sortable.js') }}"></script>
    <script src="{{ asset('js/plugins/file-theme.js') }}"></script>
    <script src="{{ asset('js/plugins/files-fa-theme.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    @yield('sub_footer')
@endsection


