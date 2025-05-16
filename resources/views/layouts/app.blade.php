<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/proveedor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reserva.css') }}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
    
    @stack('styles')
</head>

<body id="top">
    @include('partials.preloader')
    
    <div id="page" class="s-pagewrap">
        @include('partials.header')
        
        <main class="s-main">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/reserva.js') }}"></script>
    @stack('scripts')
</body>
</html>