@extends('master')
@section('main')
    {{-- This section summary --}}
    <div class="max-w-7xl mx-auto mt-3 pl-5 pr-5 pt-16 md:pt-0 md:grid md:grid-cols-3">
        <div class="col-span-2 md:col-span-2">
            <div class="grid grid-cols-1 md:text-left md:flex md:flex-wrap md:justify-center">
                <p class="font-bold text-lg md:text-3xl mb-4">{{ $post['title'] }}</p>
                <p class="text-gray-500 text-lg mt-1 mb-4"><i class="fad fa-clock mr-2"></i>
                    {{ \Illuminate\Support\Carbon::parse($post['created_at'])->format("d-m-Y H:i:s") }}
                </p>
                <p class="mb-3 text-gray-400">
                    {{ $post['description'] }}
                </p>
                <img src="{{ $post['thumbnail'] }}" class="rounded mb-4">
                @foreach($post['content'] as $content)
                    <p class="text-lg text-gray-700 mb-4">
                        {!! $content !!}
                    </p>
                @endforeach
                {{--<p class="font-bold text-lg text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <img src="{{ asset('images/slider_summary_1.jpg') }}" class="rounded mb-4">
                <p class="font-bold text-lg text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <img src="{{ asset('images/slider_summary_1.jpg') }}" class="rounded mb-4">
                <p class="font-bold text-lg text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>--}}
            </div>

            <h2 class="font-bold text-lg md:text-3xl mb-3 mt-5 home-category-color">
                <a class="border-b-2 border-orange-700">Tin liên quan</a>
            </h2>
            <div class="grid grid-cols-3 gap-8">
                @foreach($related_post_list as $related_post)
                    <div class="grid col-span-3 md:col-span-1">
                        <a href="{{ route('post-detail', ['category' => strtolower($category_list[$related_post['categories'][0]][0]['name']), 'id' => $related_post['id']]) }}">
                            <img src="{{ $related_post['thumbnail'] }}" class="rounded">
                        </a>
                        <a href="{{ route('post-detail', ['category' => strtolower($category_list[$related_post['categories'][0]][0]['name']), 'id' => $related_post['id']]) }}" class="pl-1 md:pl-0 font-bold mt-2 text-sm md:text-sm hover:text-blue-500">
                            {{ $related_post['title'] }}
                        </a>
                        <p class="text-gray-500 text-sm mt-1"><i class="fad fa-clock mr-2"></i>
                            {{ \Illuminate\Support\Carbon::parse($related_post['created_at'])->format("d-m-Y H:i:s") }}
                        </p>
                        <p class="mt-3 text-gray-700 text-sm">
                            {{ $related_post['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Section by category: Mới nhất --}}
        <section id="section-home_newest_sport" class="md:pl-5 mb-5 col-span-2 md:col-span-1 mt-8 md:mt-0">
            <div class="container mx-auto">
                <div class="grid grid-cols-4 gap-4">
                    <h2 class="col-span-2 text-xl md:text-3xl font-bold home-category-color">
                        <a href="#" class="border-b-2 border-orange-700">Mới nhất</a>
                    </h2>
                </div>
            </div>

            <div class="container mx-auto mt-3">
                <div class="col-span-3 relative">
                    <a href="{{ route('post-detail', ['category' => strtolower($category_list[$new_post_list[0]['categories'][0]][0]['name']), 'id' => $new_post_list[0]['id']]) }}">
                        <img src="{{ $new_post_list[0]['thumbnail'] }}"/>
                    </a>
                    <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                        <a href="{{ route('post-detail', ['category' => strtolower($category_list[$new_post_list[0]['categories'][0]][0]['name']), 'id' => $new_post_list[0]['id']]) }}" class="text-sm text-white hover:text-blue-500">
                            {{ $new_post_list[0]['title'] }}
                        </a>
                        {{--<p class="text-white text-sm"><i class="fad fa-clock mr-2 text-white"></i>
                            {{ \Illuminate\Support\Carbon::parse($new_post_list[0]['created_at'])->format("d-m-Y H:i:s") }}
                        </p>--}}
                    </h2>
                </div>
                @php
                    unset($new_post_list[0]);
                @endphp

                <div class="grid grid-cols-1 gap-10 mt-10">
                    @foreach($new_post_list as $new_post)
                        <div class="col-span-1 grid grid-cols-3 gap-4">
                            <a href="{{ route('post-detail', ['category' => strtolower($category_list[$new_post['categories'][0]][0]['name']), 'id' => $new_post['id']]) }}" class="col-span-1">
                                <img src="{{ $new_post['thumbnail'] }}">
                            </a>
                            <div class="col-span-2">
                                <a href="{{ route('post-detail', ['category' => strtolower($category_list[$new_post['categories'][0]][0]['name']), 'id' => $new_post['id']]) }}" class="col-span-2 text-sm font-bold text-gray-800 hover:text-blue-500">
                                    @if(strlen($new_post['title']) > 119)
                                        @php
                                            $title = mb_substr($new_post['title'], 0 , 119);
                                            $title = mb_substr($title, 0 , mb_strrpos($title, " "));
                                        @endphp
                                        {{ $title }}...
                                    @else
                                        {{ $new_post['title'] }}
                                    @endif
                                </a>
                                <p class="text-gray-500 text-sm mt-1"><i class="fad fa-clock mr-2"></i>
                                    {{ \Illuminate\Support\Carbon::parse($new_post['created_at'])->format("d-m-Y H:i:s") }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
