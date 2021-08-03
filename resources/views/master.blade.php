<!DOCTYPE html>
<html class="" lang="vi">
<head>
    <title>Trang tin hay</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{!! url('/')  !!}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    @stack("meta_facebook")
    @php $time = time(); @endphp
    <link href="{{ asset("css/app.css?t=$time") }}" rel="stylesheet">
    <link href="{{ asset("css/all.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/flickity.css") }}" rel="stylesheet">
    <link href="{{ asset("css/common.css") }}" rel="stylesheet">
    <link href="{{ asset("css/toastr.min.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/bqb1nuo.css">
    @yield('styles')
    @stack('styles_component')
    <script data-ad-client="ca-pub-2010477428789415" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '623528114334712',
      xfbml      : true,
      version    : 'v9.0'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-analytics.js"></script>

<script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyDOdU5dGM37M02lqjGEyxSFp1a-mu03k9k",
        authDomain: "trangthudo-3ebdb.firebaseapp.com",
        projectId: "trangthudo-3ebdb",
        storageBucket: "trangthudo-3ebdb.appspot.com",
        messagingSenderId: "72145564117",
        appId: "1:72145564117:web:60bd9d54f8770652a1cd5c",
        measurementId: "G-MC6KPGS9LT"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
</script>

<section id="main-page">
    <div class="relative">
        @include('partials.header')
        @yield('main')
        {{--@include('partials.footer')--}}
    </div>
</section>
</body>
<script type='text/javascript' src="{{ asset('js/jquery.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/app.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/all.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/flickity.min.js') }}"></script>
<script type='text/javascript' src="{{ asset("js/common.js?t=$time") }}"></script>
<script type='text/javascript' src="{{ asset('js/toastr.min.js') }}"></script>
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
