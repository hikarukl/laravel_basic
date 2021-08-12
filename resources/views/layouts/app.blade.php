<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link href="{{ asset("css/app.css") }}" rel="stylesheet">
        <link href="{{ asset("css/all.min.css") }}" rel="stylesheet">
        <link href="{{ asset("css/flickity.min.css") }}" rel="stylesheet">
        <link href="{{ asset("css/common.css") }}" rel="stylesheet">
        @yield('styles')
        @stack('styles_component')
        @livewireStyles
    </head>
    <body>
        <section id="main-page">
            <div class="relative">
                @include('partials.header')
                <div class="content">
                    {{ $slot }}
                </div>
                @include('partials.footer')
            </div>
        </section>
    </body>
    <!-- Scripts -->
    @livewireScripts
    <script type='text/javascript' src="{{ asset('js/app.js') }}"></script>
    <script type='text/javascript' src="{{ asset('js/all.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('js/flickity.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset("js/common.js") }}"></script>
    @yield('scripts')
    @stack('scripts_component')
</html>
