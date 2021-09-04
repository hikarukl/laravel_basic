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
<script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "{{ asset('js/firebase-app.js') }}";
    import { getAnalytics } from "{{ asset('js/firebase-analytics.js') }}";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyBUT75xB9kR6taxQ5Sv-UpCNXpuNhnwnmQ",
        authDomain: "my-project-1489733461325.firebaseapp.com",
        projectId: "my-project-1489733461325",
        storageBucket: "my-project-1489733461325.appspot.com",
        messagingSenderId: "1019738238667",
        appId: "1:1019738238667:web:6d2bfe7b7ccdc7ee46354e",
        measurementId: "G-CWZQLHLTKN"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
</script>
@yield('scripts')
@stack('scripts_component')
</html>