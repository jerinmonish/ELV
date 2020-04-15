<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {!! trans('main.site_title') !!}</title>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}">
    <link href="{{ asset('public/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/jquery.datetimepicker.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.includes.menu')

        <main class="py-4">
            @include('layouts.includes.alert')
            @yield('content')
        </main>

        <nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ url('/') }}">{!! trans('main.site_title') !!}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <!-- <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                    <li class="nav-item dropup">
                        <a class="nav-link dropdown-toggle" href="https://getbootstrap.com/" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropup</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown10">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                    </li>
                </ul> -->
            </div>
        </nav>  
    </div>
</body>
<script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/js/jquery.datetimepicker.js') }}"></script>
</html>
