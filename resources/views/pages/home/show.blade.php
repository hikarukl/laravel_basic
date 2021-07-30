@extends('master')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css">
@endsection
@section('main')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Pannellum
        </h2>
    </div>

    <div class="intro-y mt-3">
        <iframe class= allowfullscreen style="border-style:none;"
                src="https://cdn.pannellum.org/2.5/pannellum.htm#panorama=https://pannellum.org/images/alma.jpg">
        </iframe>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
@endsection