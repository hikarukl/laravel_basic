<!DOCTYPE html>
<html class="" lang="vi">
<head>
    <title>{{ config('app.name') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{!! url('/')  !!}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta property="og:site_name" content="Trang tin hay" />
    <meta property="og:type" content="News" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:image:alt" content=""/>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @stack("meta_facebook")
    <link href="{{ asset("css/app.css") }}" rel="stylesheet">
    <link href="{{ asset("css/all.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/flickity.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/common.css") }}" rel="stylesheet">
    @yield('styles')
    @stack('styles_component')
</head>
<body>
<section id="main-page">
    <div class="relative">
        @include('partials.header')
        <div class="content p-0 overflow-auto">
            @yield('main')
        </div>
        @include('partials.footer')
    </div>
</section>
</body>
{{--<script type='text/javascript' src="{{ asset('js/jquery.min.js') }}"></script>--}}
<script type='text/javascript' src="{{ asset('js/app.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/all.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/flickity.min.js') }}"></script>
<script type='text/javascript' src="{{ asset("js/common.js") }}"></script>
@yield('scripts')
@stack('scripts_component')
</html>