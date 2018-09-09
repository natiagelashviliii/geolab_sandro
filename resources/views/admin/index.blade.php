@extends('index')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    @yield('sub_header')
@endsection

@section('content')

<section class="row">
    <header class="admin-header">
        <!-- <p class="logo">Admin Panel</p> -->
        <ul class="admin-menu">
            <li><a @if(Request::is('admin/works')) class="active-link" @endif href="{{ url('admin/works') }}">Works</a></li>
            <li><a @if(Request::is('admin/about')) class="active-link" @endif href="{{ url('admin/about') }}">About</a></li>
            <li><a @if(Request::is('admin/contact')) class="active-link" @endif href="{{ url('admin/contact') }}">Contact</a></li>
        </ul>
    </header>

    <div class="admin-main col s9 xl10 offset-xl2 offset-s3">
        @yield('section')
    </div>
</section>

@endsection

@section('footer')
    <script src="{{ asset('js/plugins/files.js') }}"></script>
    <script src="{{ asset('js/plugins/jform.js') }}"></script>
    <script src="{{ asset('js/plugins/jalerts.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    @yield('sub_footer')
@endsection


