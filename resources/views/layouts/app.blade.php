<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="Touhidul Sadeek">
    
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @yield('styles')
    @stack('styles')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" rel="stylesheet">
    <link href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" rel="stylesheet">
    <link href="{{ asset('assets/lib/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/slick/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    @livewireStyles

</head>
<body>
    <div id="app">
        @include('layouts.inc.Frontend.header')

        <main>
            @yield('content')
        </main>

        @include('layouts.inc.Frontend.footer')

    </div>
    
    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/slick/slick.min.js') }}"></script>    
    <script src="{{ asset('assets/js/main.js') }}"></script>
        
    <script>
        window.addEventListener('message', event => {
            if(event.detail) {
                alertify.set('notifier','position', 'top-right');
                alertify.notify(event.detail.text, event.detail.type);                
            }
        });
    </script>
    
    @yield('scripts')
    @livewireScripts
    @stack('scripts')
</body>
</html>