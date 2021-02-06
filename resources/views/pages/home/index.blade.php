@extends('master')
@section('main')
    <div class="max-w-7xl mx-auto pl-5 pr-5 pt-16 md:pt-0">
        {{-- This section summary for mobile --}}
        <div class="grid grid-cols-3 gap-1 md:hidden">
            @foreach($top_post_list as $top_post)
                <div class="col-span-3 relative">
                    <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post['category']['id']][0]['name']), 'id' => $top_post['id']]) }}">
                        <img src="{{ $top_post['thumbnail'] }}">
                    </a>
                    <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                        <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post['category']['id']][0]['name']), 'id' => $top_post['id']]) }}" class="text-sm text-white hover:text-blue-500">
                            {{ $top_post['title'] }}
                        </a>
                        {{--<p class="text-white text-sm"><i class="fad fa-clock mr-2 text-white"></i>15 giờ trước</p>--}}
                    </h2>
                </div>
            @endforeach
        </div>
        {{-- This section summary for web --}}
        <div class="grid grid-cols-2 gap-1 hidden md:grid">
            <div class="col-span-1 relative">
                <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post_list[0]['category']['id']][0]['name']), 'id' => $top_post_list[0]['id']]) }}">
                    <img src="{{ $top_post_list[0]['thumbnail'] }}">
                </a>
                <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                    <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post_list[0]['category']['id']][0]['name']), 'id' => $top_post_list[0]['id']]) }}" class="text-lg text-white hover:text-blue-500">
                        {{ $top_post_list[0]['title'] }}
                    </a>
{{--                    <p class="text-white text-sm"><i class="fad fa-clock mr-2 text-white"></i>--}}
{{--                        15 giờ trước--}}
{{--                    </p>--}}
                </h2>
            </div>
            <div class="col-span-1 grid grid-cols-2 gap-1">
                @for($i = 1; $i < count($top_post_list); $i++)
                    <div class="col-span-1 relative">
                        <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post_list[$i]['category']['id']][0]['name']), 'id' => $top_post_list[$i]['id']]) }}">
                            <img src="{{ $top_post_list[$i]['thumbnail'] }}">
                        </a>
                        <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-1/2">
                            <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post_list[$i]['category']['id']][0]['name']), 'id' => $top_post_list[$i]['id']]) }}" class="text-sm text-white hover:text-blue-500">
                                @if(strlen($top_post_list[$i]['title']) > 137)
                                    {{ substr($top_post_list[$i]['title'], 0 , 134) }}...
                                @else
                                    {{ $top_post_list[$i]['title'] }}
                                @endif
                            </a>
{{--                            <p class="text-white text-sm"><i class="fad fa-clock mr-2 text-white"></i>15 giờ trước</p>--}}
                        </h2>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 max-w-7xl mx-auto">
        {{-- Section by category: Tiêu điểm --}}
        <section id="section-home_newest_sport" class="pr-5 pl-5 mt-8 col-span-3 md:col-span-2">
            <div class="container mx-auto">
                <div class="grid grid-cols-4 gap-4">
                    <h2 class="col-span-2 text-xl md:text-3xl uppercase font-bold home-category-color">
                        <a href="#" class="border-b-2 border-orange-700">Tiêu điểm</a>
                    </h2>
                </div>
            </div>

            <div class="container mx-auto mt-3">
                <div class="grid grid-cols-1">
                    {{--<div class="grid">
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
                    </div>--}}
                    @foreach($focus_post_list as $focus_post)
                        <div class="grid mb-8 md:grid-cols-2">
                            <a href="{{ route('post-detail', ['category' => strtolower($category_list[$focus_post['category']['id']][0]['name']), 'id' => $focus_post['id']]) }}" class="md:col-span-1">
                                <img src="{{ $focus_post['thumbnail'] }}">
                            </a>
                            <div class="md:col-span-1 md:pl-5 grid md:block">
                                <a href="{{ route('post-detail', ['category' => strtolower($category_list[$focus_post['category']['id']][0]['name']), 'id' => $focus_post['id']]) }}" class="mt-3 md:mt-0 text-lg font-bold text-gray-800 hover:text-blue-500">
                                    {{ $focus_post['title'] }}
                                </a>
                                <p class="text-gray-500 text-sm mt-1 md:mt-3 md:mb-3">
                                    <i class="fad fa-clock mr-2"></i>
                                    {{ \Illuminate\Support\Carbon::parse($focus_post['published_time'])->format("d-m-Y H:i:s") }}
                                </p>
                                <p class="mt-2 text-gray-700 text-sm">
                                    {{ $focus_post['description'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Section by category: Mới nhất --}}
        <section id="section-home_newest_sport" class="pr-5 pl-5 mb-5 col-span-3 md:col-span-1 md:mt-8">
            <div class="container mx-auto">
                <div class="grid grid-cols-4 gap-4">
                    <h2 class="col-span-2 text-xl md:text-3xl uppercase font-bold home-category-color">
                        <a href="#" class="border-b-2 border-orange-700">Mới nhất</a>
                    </h2>
                </div>
            </div>

            <div class="container mx-auto mt-3">
                <div class="col-span-3 relative">
                    <a href="{{ route('post-detail', ['category' => strtolower($category_list[$new_post_list[0]['category']['id']][0]['name']), 'id' => $new_post_list[0]['id']]) }}">
                        <img src="{{ $new_post_list[0]['thumbnail'] }}"/>
                    </a>
                    <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                        <a href="{{ route('post-detail', ['category' => strtolower($category_list[$new_post_list[0]['category']['id']][0]['name']), 'id' => $new_post_list[0]['id']]) }}" class="text-sm text-white hover:text-blue-500">
                            {{ $new_post_list[0]['title'] }}
                        </a>
                        {{--<p class="text-white text-sm"><i class="fad fa-clock mr-2 text-white"></i>
                            {{ \Illuminate\Support\Carbon::parse($new_post_list[0]['published_time'])->format("d-m-Y H:i:s") }}
                        </p>--}}
                    </h2>
                </div>
                @php
                    unset($new_post_list[0]);
                @endphp

                <div class="grid grid-cols-1 gap-10 mt-10">
                    @foreach($new_post_list as $new_post)
                        <div class="col-span-1 grid grid-cols-3 gap-4">
                            <a href="#" class="col-span-1">
                                <img src="{{ $new_post['thumbnail'] }}">
                            </a>
                            <div class="col-span-2">
                                <a href="#" class="col-span-2 text-sm font-bold text-gray-800 hover:text-blue-500">
                                    @if(strlen($new_post['title']) > 119)
                                        @php
                                            $title = substr($new_post['title'], 0 , 119);
                                            $title = substr($title, 0 , strrpos($title, " "));
                                        @endphp
                                        {{ $title }}...
                                    @else
                                        {{ $new_post['title'] }}
                                    @endif
                                </a>
                                <p class="text-gray-500 text-sm mt-1"><i class="fad fa-clock mr-2"></i>
                                    {{ \Illuminate\Support\Carbon::parse($focus_post['published_time'])->format("d-m-Y H:i:s") }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Section by category: Yêu hôn nhân --}}
        {{--<section id="section-home_newest_sport" class="pr-5 pl-5 mb-5 mt-8 col-span-3">
            <div class="container mx-auto">
                <div class="grid grid-cols-4 gap-4">
                    <h2 class="col-span-4 text-xl md:text-3xl uppercase font-bold home-category-color">
                        <a href="{{ route('post-list', ['category' => 'sport']) }}" class="border-b-2 border-orange-700">Yêu hôn nhân</a>
                    </h2>
                </div>
            </div>

            <div class="grid md:grid-cols-3 mx-auto mt-3">
                <div class="grid md:col-span-1">
                    <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}">
                        <img src="{{ asset('images/slider_summary_1.jpg') }}">
                    </a>
                    <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}" class="mt-3 text-lg font-bold text-gray-800 hover:text-blue-500">
                        Trợ lý ảo tiếng Việt Kiki ra mắt - đa nền tảng, chạy được trên ôtô
                    </a>
                    <p class="text-gray-500 text-sm mt-1"><i class="fad fa-clock mr-2"></i>13 giờ trước</p>
                    <p class="mt-2 text-gray-700 text-sm">
                        Áp thấp nhiệt đới đã mạnh lên thành bão số 14 với vận tốc di chuyển ổn định, hướng đi phức tạp. Hoàn lưu bão có thể gây mưa cho các tỉnh Nam Bộ trong 3 ngày tới.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 md:col-span-2 gap-10 mt-10 md:mt-0 md:pl-5">
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
        </section>--}}

        {{-- Section by category: Tin tức --}}
        {{--<section id="section-home_newest_sport" class="pr-5 pl-5 mb-5 mt-8 col-span-3 md:hidden">
            <div class="container mx-auto">
                <div class="grid grid-cols-4 gap-4">
                    <h2 class="col-span-2 text-xl md:text-3xl uppercase font-bold home-category-color">
                        <a href="{{ route('post-list', ['category' => 'sport']) }}" class="border-b-2 border-orange-700">Tin tức</a>
                    </h2>
                </div>
            </div>

            <div class="grid mt-3 md:grid-cols-3">
                <div class="col-span-3 md:col-span-1 relative">
                    <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}">
                        <img src="{{ asset('images/slider_summary_1.jpg') }}">
                    </a>
                    <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                        <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}" class="text-lg text-white hover:text-blue-500">
                            UFO phát ánh sáng xanh bí ẩn bay lơ lửng trên bầu trời Hawaii
                        </a>
                        <p class="text-white text-sm"><i class="fad fa-clock mr-2"></i>15 giờ trước</p>
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-10 mt-10">
                    @for($i = 1; $i <= 4; $i++)
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
        </section>--}}

        {{-- Section by category: Tin tức web --}}
        {{--<section id="section-home_newest_sport" class="pr-5 pl-5 mb-5 mt-8 col-span-3 hidden md:block">
            <div class="container mx-auto">
                <div class="grid grid-cols-4 gap-4">
                    <h2 class="col-span-4 text-xl md:text-3xl uppercase font-bold home-category-color">
                        <a href="{{ route('post-list', ['category' => 'sport']) }}" class="border-b-2 border-orange-700">Tin tức</a>
                    </h2>
                </div>
            </div>

            <div class="grid mt-3 grid-cols-3 gap-x-5">
                <div class="col-span-1 grid grid-cols-2">
                    <div class="col-span-2 relative">
                        <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}">
                            <img src="{{ asset('images/slider_summary_1.jpg') }}">
                        </a>
                        <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                            <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}" class="text-lg text-white hover:text-blue-500">
                                UFO phát ánh sáng xanh bí ẩn bay lơ lửng trên bầu trời Hawaii
                            </a>
                            <p class="text-white text-sm"><i class="fad fa-clock mr-2"></i>15 giờ trước</p>
                        </h2>
                    </div>

                    <div class="col-span-2 grid grid-cols-2 gap-10 mt-10">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="col-span-2 grid grid-cols-3 gap-4">
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
                <div class="col-span-1">
                    <div class="col-span-2 relative">
                        <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}">
                            <img src="{{ asset('images/slider_summary_1.jpg') }}">
                        </a>
                        <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                            <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}" class="text-lg text-white hover:text-blue-500">
                                UFO phát ánh sáng xanh bí ẩn bay lơ lửng trên bầu trời Hawaii
                            </a>
                            <p class="text-white text-sm"><i class="fad fa-clock mr-2"></i>15 giờ trước</p>
                        </h2>
                    </div>

                    <div class="col-span-2 grid grid-cols-2 gap-10 mt-10">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="col-span-2 grid grid-cols-3 gap-4">
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
                <div class="col-span-1">
                    <div class="col-span-2 relative">
                        <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}">
                            <img src="{{ asset('images/slider_summary_1.jpg') }}">
                        </a>
                        <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                            <a href="{{ route('post-detail', ['category' => 'sport', 'id' => 1]) }}" class="text-lg text-white hover:text-blue-500">
                                UFO phát ánh sáng xanh bí ẩn bay lơ lửng trên bầu trời Hawaii
                            </a>
                            <p class="text-white text-sm"><i class="fad fa-clock mr-2"></i>15 giờ trước</p>
                        </h2>
                    </div>

                    <div class="col-span-2 grid grid-cols-2 gap-10 mt-10">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="col-span-2 grid grid-cols-3 gap-4">
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
            </div>
        </section>--}}

        {{-- Section by category: Tin tức khác mobile --}}
        <section id="section-home_newest_sport" class="pr-5 pl-5 mb-5 mt-8 col-span-3 md:hidden">
            <div class="container mx-auto">
                <div class="grid grid-cols-4 gap-4">
                    <h2 class="col-span-2 text-xl md:text-3xl uppercase font-bold home-category-color">
                        <a href="#" class="border-b-2 border-orange-700">Tin tức khác</a>
                    </h2>
                </div>
            </div>

            <div class="grid mt-3 md:grid-cols-3">
                <div class="col-span-3 md:col-span-1 relative">
                    <a href="#">
                        <img src="{{ $another_post_list_mobile[0]['thumbnail'] }}">
                    </a>
                    <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-1/2">
                        <a href="#" class="text-sm text-white hover:text-blue-500">
                            {{ $another_post_list_mobile[0]['title'] }}
                        </a>
                        {{--<p class="text-white text-sm"><i class="fad fa-clock mr-2"></i>
                            {{ \Illuminate\Support\Carbon::parse($another_post_list_mobile[0]['published_time'])->format("d-m-Y H:i:s") }}
                        </p>--}}
                    </h2>
                </div>
                @php unset($another_post_list_mobile[0]); @endphp
                <div class="grid grid-cols-1 gap-10 mt-10">
                    @foreach($another_post_list_mobile as $another_post_mobile)
                        <div class="col-span-1 grid grid-cols-3 gap-4">
                            <a href="#" class="col-span-1">
                                <img src="{{ $another_post_mobile['thumbnail'] }}">
                            </a>
                            <div class="col-span-2">
                                <a href="#" class="col-span-2 text-sm font-bold text-gray-800 hover:text-blue-500">
                                    @if(strlen($another_post_mobile['title']) > 119)
                                        @php
                                            $title = substr($another_post_mobile['title'], 0 , 119);
                                            $title = substr($title, 0 , strrpos($title, " "));
                                        @endphp
                                        {{ $title }}...
                                    @else
                                        {{ $another_post_mobile['title'] }}
                                    @endif
                                </a>
                                <p class="text-gray-500 text-sm mt-1"><i class="fad fa-clock mr-2"></i>
                                    {{ \Illuminate\Support\Carbon::parse($another_post_mobile['published_time'])->format("d-m-Y H:i:s") }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Section by category: Tin tức khác web --}}
        <section id="section-home_newest_sport" class="pr-5 pl-5 mb-5 mt-8 col-span-3 hidden md:block">
            <div class="container mx-auto">
                <div class="grid grid-cols-4 gap-4">
                    <h2 class="col-span-4 text-xl md:text-3xl uppercase font-bold home-category-color">
                        <a href="#" class="border-b-2 border-orange-700">Tin tức khác</a>
                    </h2>
                </div>
            </div>

            <div class="grid mt-3 grid-cols-3 gap-x-5">
                @foreach($another_post_list as $another_list)
                    <div class="col-span-1 grid grid-cols-2">
                        <div class="col-span-2 relative">
                            <a href="$">
                                <img src="{{ $another_list[0]['thumbnail'] }}">
                            </a>
                            <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                                <a href="#" class="text-sm text-white hover:text-blue-500">
                                    @if(strlen($another_list[0]['title']) > 187)
                                        {{ substr($another_list[0]['title'], 0 , 187) }}...
                                    @else
                                        {{ $another_list[0]['title'] }}
                                    @endif
                                </a>
                                {{--<p class="text-white text-sm"><i class="fad fa-clock mr-2"></i>15 giờ trước</p>--}}
                            </h2>
                        </div>
                        @php unset($another_list[0]); @endphp
                        <div class="col-span-2 grid grid-cols-2 gap-10 mt-10">
                            @foreach($another_list as $list)
                                <div class="col-span-2 grid grid-cols-3 gap-4">
                                    <a href="#" class="col-span-1">
                                        <img src="{{ $list['thumbnail'] }}">
                                    </a>
                                    <div class="col-span-2">
                                        <a href="#" class="col-span-2 text-sm font-bold text-gray-800 hover:text-blue-500">
                                            @if(strlen($list['title']) > 127)
                                                @php
                                                    $title = substr($list['title'], 0 , 127);
                                                    $title = substr($title, 0 , strrpos($title, " "));
                                                @endphp
                                                {{ $title }}...
                                            @else
                                                {{ $list['title'] }}
                                            @endif
                                        </a>
                                        <p class="text-gray-500 text-sm mt-1"><i class="fad fa-clock mr-2"></i>
                                            {{ \Illuminate\Support\Carbon::parse($focus_post['published_time'])->format("d-m-Y H:i:s") }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </div>
@endsection