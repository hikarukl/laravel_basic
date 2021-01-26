@extends('master')
@section('main')
    {{-- This section summary --}}
    <section class="max-w-7xl mx-auto pl-5 pr-5 pt-16 md:pt-0">
        {{-- This section summary for mobile --}}
        <div class="grid grid-cols-3 gap-1 md:hidden">
            @for($i = 1; $i <= 5; $i++)
                <div class="col-span-3 relative">
                    <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}">
                        <img src="{{ asset('images/slider_summary_1.jpg') }}">
                    </a>
                    <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                        <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}" class="text-lg text-white hover:text-blue-500">
                            UFO phát ánh sáng xanh bí ẩn bay lơ lửng trên bầu trời Hawaii
                        </a>
                        <p class="text-white text-sm"><i class="fad fa-clock mr-2 text-white"></i>15 giờ trước</p>
                    </h2>
                </div>
            @endfor
        </div>
        {{-- This section summary for web --}}
        <div class="grid grid-cols-2 gap-1 hidden md:grid">
            <div class="col-span-1 relative">
                <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}">
                    <img src="{{ asset('images/slider_summary_1.jpg') }}">
                </a>
                <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                    <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}" class="text-lg text-white hover:text-blue-500">
                        UFO phát ánh sáng xanh bí ẩn bay lơ lửng trên bầu trời Hawaii
                    </a>
                    <p class="text-white text-sm"><i class="fad fa-clock mr-2 text-white"></i>15 giờ trước</p>
                </h2>
            </div>
            <div class="col-span-1 grid grid-cols-2 gap-1">
                @for($i = 1; $i <= 4; $i++)
                    <div class="col-span-1 relative">
                        <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}">
                            <img src="{{ asset('images/slider_summary_1.jpg') }}">
                        </a>
                        <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                            <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}" class="text-lg text-white hover:text-blue-500">
                                UFO phát ánh sáng xanh bí ẩn bay lơ lửng trên bầu trời Hawaii
                            </a>
                            <p class="text-white text-sm"><i class="fad fa-clock mr-2 text-white"></i>15 giờ trước</p>
                        </h2>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <div class="grid grid-cols-3 max-w-7xl mx-auto">
        {{-- Section by category: Tiêu điểm --}}
        <section id="section-home_newest_sport" class="pr-5 pl-5 mt-8 col-span-3 md:col-span-2">
            <div class="container mx-auto">
                <div class="grid grid-cols-4 gap-4">
                    <h2 class="col-span-4 text-xl md:text-3xl font-bold home-category-color">
                        <a href="{{ route('post-list', ['category' => 'sport']) }}" class="border-b-2 border-orange-700">Bài Viết Cùng Danh Mục</a>
                    </h2>
                </div>
            </div>

            <div class="container mx-auto mt-3">
                <div class="grid grid-cols-1">
                    <div class="grid">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-format="fluid"
                             data-ad-layout-key="-6o+cd+1b-14+b1"
                             data-ad-client="ca-pub-1183003705015401"
                             data-ad-slot="9312214781"></ins>
                        <script>
                          (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                    @for($i = 1; $i <= 4; $i++)
                        <div class="grid mb-8 md:grid-cols-2">
                            <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}" class="md:col-span-1">
                                <img src="{{ asset('images/slider_summary_1.jpg') }}">
                            </a>
                            <div class="md:col-span-1 md:pl-5 grid md:block">
                                <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}" class="mt-3 md:mt-0 text-lg font-bold text-gray-800 hover:text-blue-500">
                                    Trợ lý ảo tiếng Việt Kiki ra mắt - đa nền tảng, chạy được trên ôtô
                                </a>
                                <p class="text-gray-500 text-sm mt-1 md:mt-3 md:mb-3">
                                    <i class="fad fa-clock mr-2"></i>13 giờ trước
                                </p>
                                <p class="mt-2 text-gray-700 text-sm">
                                    Áp thấp nhiệt đới đã mạnh lên thành bão số 14 với vận tốc di chuyển ổn định, hướng đi phức tạp. Hoàn lưu bão có thể gây mưa cho các tỉnh Nam Bộ trong 3 ngày tới.
                                </p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        {{-- Section by category: Mới nhất --}}
        <section id="section-home_newest_sport" class="pr-5 pl-5 mb-5 col-span-3 md:col-span-1 md:mt-8">
            <div class="container mx-auto">
                <div class="grid grid-cols-4 gap-4">
                    <h2 class="col-span-2 text-xl md:text-3xl font-bold home-category-color">
                        <a href="{{ route('post-list', ['category' => 'sport']) }}" class="border-b-2 border-orange-700">Mới nhất</a>
                    </h2>
                </div>
            </div>

            <div class="container mx-auto mt-3">
                <div class="col-span-3 relative">
                    <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}">
                        <img src="{{ asset('images/slider_summary_1.jpg') }}">
                    </a>
                    <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                        <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}" class="text-lg text-white hover:text-blue-500">
                            UFO phát ánh sáng xanh bí ẩn bay lơ lửng trên bầu trời Hawaii
                        </a>
                        <p class="text-white text-sm"><i class="fad fa-clock mr-2 text-white"></i>15 giờ trước</p>
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-10 mt-10">
                    @for($i = 1; $i <= 8; $i++)
                        <div class="col-span-1 grid grid-cols-3 gap-4">
                            <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}" class="col-span-1">
                                <img src="{{ asset('images/slider_summary_1.jpg') }}">
                            </a>
                            <div class="col-span-2">
                                <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}" class="col-span-2 text-sm font-bold text-gray-800 hover:text-blue-500">
                                    Trợ lý ảo tiếng Việt Kiki ra mắt - đa nền tảng, ...
                                </a>
                                <p class="text-gray-500 text-sm mt-1"><i class="fad fa-clock mr-2"></i>15 giờ trước</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>
    </div>
@endsection