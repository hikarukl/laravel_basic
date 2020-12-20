@extends('master')
@section('main')
    {{-- This section summary for mobile --}}
    <div class="main-carousel">
        <div class="carousel-cell w-screen">
            <img src="{{ asset('images/slider_summary_1.jpg') }}">
            <h2 class="text-center mt-3 font-bold">Người nước ngoài nhiễm virus</h2>
        </div>
        <div class="carousel-cell w-screen">
            <img src="{{ asset('images/slider_summary_2.jpg') }}">
            <h2 class="text-center mt-3 font-bold">Campuchia thận trọng với vacxin</h2>
        </div>
    </div>

    {{-- This section contain newest news --}}
    <section id="section-home_newest_news" class="mt-10 pl-5 pr-5 mb-5">
        <div class="container mx-auto mt-5 border-b border-gray-200 pb-5">
            <div class="grid grid-cols-3 gap-4">
                <img src="{{ asset('images/slider_summary_1.jpg') }}" class="col-span-1">
                <a class="col-span-2 font-bold">Trợ lý ảo tiếng Việt Kiki ra mắt - đa nền tảng, chạy được trên ôtô</a>
            </div>
        </div>
        <div class="container mx-auto mt-5 border-b border-gray-200 pb-5">
            <div class="grid grid-cols-3 gap-4">
                <img src="{{ asset('images/slider_summary_1.jpg') }}" class="col-span-1">
                <a class="col-span-2 font-bold">Trợ lý ảo tiếng Việt Kiki ra mắt - đa nền tảng, chạy được trên ôtô</a>
            </div>
        </div>
        <div class="container mx-auto mt-5 border-b border-gray-200 pb-5">
            <div class="grid grid-cols-3 gap-4">
                <img src="{{ asset('images/slider_summary_1.jpg') }}" class="col-span-1">
                <a class="col-span-2 font-bold">Trợ lý ảo tiếng Việt Kiki ra mắt - đa nền tảng, chạy được trên ôtô</a>
            </div>
        </div>
        <div class="container mx-auto mt-5 border-b border-gray-200 pb-5">
            <div class="grid grid-cols-3 gap-4">
                <img src="{{ asset('images/slider_summary_1.jpg') }}" class="col-span-1">
                <a class="col-span-2 font-bold">Trợ lý ảo tiếng Việt Kiki ra mắt - đa nền tảng, chạy được trên ôtô</a>
            </div>
        </div>
    </section>

    {{-- Section by category --}}
    <section id="section-home_newest_sport" class="mt-5 pl-5 pr-5 mb-5">
        <div class="container mx-auto mt-5">
            <div class="grid grid-cols-3 gap-4">
                <h2 class="col-span-1 uppercase text-blue-600 font-bold">Thể thao</h2>
                <a class="col-span-2 text-right text-gray-500">Ngoại hạng Anh</a>
            </div>
        </div>

        <div class="container mx-auto mt-5">
            <div class="grid grid-cols-1 gap-4">
                <img src="{{ asset('images/slider_summary_1.jpg') }}">
                <a class="col-span-2 font-bold">Trợ lý ảo tiếng Việt Kiki ra mắt - đa nền tảng, chạy được trên ôtô</a>
            </div>
        </div>

        <div class="container mx-auto mt-5 bg-gray-100 pb-3">
            <div class="grid grid-cols-2 gap-4 border-b border-gray-200 pb-5">
                <div>
                    <img src="{{ asset('images/slider_summary_1.jpg') }}">
                    <a class="col-span-2 font-bold">Trợ lý ảo tiếng Việt Kiki ra mắt - đa nền tảng, chạy được trên ôtô</a>
                </div>
                <div>
                    <img src="{{ asset('images/slider_summary_1.jpg') }}">
                    <a class="col-span-2 font-bold">Trợ lý ảo tiếng Việt Kiki ra mắt - đa nền tảng, chạy được trên ôtô</a>
                </div>
                <div>
                    <img src="{{ asset('images/slider_summary_1.jpg') }}">
                    <a class="col-span-2  font-bold">Trợ lý ảo tiếng Việt Kiki ra mắt - đa nền tảng, chạy được trên ôtô</a>
                </div>
                <div>
                    <img src="{{ asset('images/slider_summary_1.jpg') }}">
                    <a class="col-span-2 font-bold">Trợ lý ảo tiếng Việt Kiki ra mắt - đa nền tảng, chạy được trên ôtô</a>
                </div>
            </div>

            <div class="text-right mt-3">
                <a class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease">Xem thêm thể thao</a>
            </div>
        </div>

    </section>

@endsection