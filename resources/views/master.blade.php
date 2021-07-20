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
    @stack("meta_facebook")
    <link href="{{ asset("css/app_midone.css") }}" rel="stylesheet">
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
        <div class="content">
            @yield('main')
        </div>
        @include('partials.footer')
    </div>
</section>
</body>
<script type='text/javascript' src="{{ asset('js/jquery.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/app_midone.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/all.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/flickity.min.js') }}"></script>
<script type='text/javascript' src="{{ asset("js/common.js") }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.main-carousel').flickity({
        autoPlay: true,
        prevNextButtons: false
    });
</script>
@yield('scripts')
@stack('scripts_component')
</html>