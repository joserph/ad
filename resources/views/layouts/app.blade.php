<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logos/logo.png') }}" type="image/png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Democracia en acción') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @include('layouts.partials.styles')
    <!-- Scripts -->
</head>
<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
        @guest
            <div class="position-relative overflow-hidden radial-gradient min-vh-100">
                <!--  Header Start -->
                @include('layouts.partials.headerGuest')
                <!--  Header End -->

                <div class="container-fluid pt-5">
                    @yield('content')
                </div>

                @include('layouts.partials.footer')
            </div>
        @else
            <!-- Sidebar Start -->
            @include('layouts.partials.sidebar')
            <!--  Sidebar End -->

            <!--  Main wrapper -->
            <div class="body-wrapper">
                <!--  Header Start -->
                @include('layouts.partials.header')
                <!--  Header End -->

                <div class="container-fluid">
                    @yield('content')
                </div>

                @include('layouts.partials.footer')
            </div>
        @endguest
    </div>
    @include('layouts.partials.scripts')
</body>
</html>
