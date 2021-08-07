@extends('master')
@inject('postHelper', 'App\Helpers\PostHelper')
@push("meta_facebook")
    {{-- Basic tags --}}
    <meta property="og:type" content="news" />
    <meta property="og:title" content="Trang Tin Hay" />
    <meta property="og:image" content="{{ asset('/images/logo.png') }}" />
    <meta property="og:url" content="{{ Request::url() }}" />
    {{-- Optional tags --}}
    <meta property="og:description" content="Trang tin hay" />
    <meta property="og:og:site_name" content="Trang Tin Hay" />
@endpush
@section('main')
    <div class="max-w-7xl mx-auto pl-5 pr-5 pt-28 mt-2 md:mt-0 md:pt-8">
        {{-- This section summary for mobile --}}
        <div class="grid grid-cols-3 gap-1 md:hidden">
            @foreach($top_post_list as $top_post)
                <div class="col-span-3 relative">
                    <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post['category']['id']]['slug']), 'id' => $top_post['slug']]) }}">
                        <img src="{{ $top_post['thumbnail'] }}">
                    </a>
                    <h2 class="text-left text-title-common pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                        <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post['category']['id']]['slug']), 'id' => $top_post['slug']]) }}" class="text-sm text-white hover:text-blue-500">
                            {{ $top_post['title'] }}
                        </a>
                    </h2>
                </div>
            @endforeach
        </div>
        {{-- This section summary for web --}}
        <div class="grid grid-cols-2 gap-1 hidden md:grid">
            <div class="col-span-1 relative">
                <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post_list[0]['category']['id']]['slug']), 'id' => $top_post_list[0]['slug']]) }}">
                    <img class="w-full" src="{{ $top_post_list[0]['thumbnail'] }}">
                </a>
                <h2 class="text-left text-title-common pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                    <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post_list[0]['category']['id']]['slug']), 'id' => $top_post_list[0]['slug']]) }}" class="text-lg text-white hover:text-blue-500">
                        {{ $top_post_list[0]['title'] }}
                    </a>
                </h2>
            </div>
            <div class="col-span-1 grid grid-cols-2 gap-1">
                @for($i = 1; $i < count($top_post_list); $i++)
                    <div class="col-span-1 relative">
                        <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post_list[$i]['category']['id']]['slug']), 'id' => $top_post_list[$i]['slug']]) }}">
                            <img src="{{ $top_post_list[$i]['thumbnail'] }}">
                        </a>
                        <h2 class="text-left text-title-common pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-1/2">
                            <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post_list[$i]['category']['id']]['slug']), 'id' => $top_post_list[$i]['slug']]) }}" class="text-sm text-white hover:text-blue-500">
                                @if(strlen($top_post_list[$i]['title']) > 137)
                                    {{ substr($top_post_list[$i]['title'], 0 , 134) }}...
                                @else
                                    {{ $top_post_list[$i]['title'] }}
                                @endif
                            </a>
                        </h2>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 max-w-7xl mx-auto">
        {{-- Section by category: Tiêu điểm --}}
        <section id="section-home_newest_sport" class="pr-5 pl-5 mt-8 col-span-3 md:col-span-2">
            @include('ads.header_pc_ad', ['classes' => 'mb-5 w-1/2 m-auto'])

            @include(
                "component_common.block_two_columns_style_one",
                [
                    "category_list"         => $category_list,
                    "category_article_list" => $focus_post_list,
                    "title_info"            => [
                        "name"  => "Tiêu điểm",
                        "link"  => "#"
                    ],
                    'postHelper'            => $postHelper
                ]
            )
        </section>

        {{-- Section by category: Mới nhất --}}
        <section id="section-home_newest_sport" class="pr-5 pl-5 mb-5 col-span-3 md:col-span-1 md:mt-8">
            @include(
                "component_common.block_one_columns_style_one",
                [
                    "category_list"         => $category_list,
                    "category_article_list" => $new_post_list,
                    "title_info"            => [
                        "name"  => "Tin mới",
                        "link"  => "#"
                    ],
                    'postHelper'            => $postHelper
                ]
            )
        </section>

        {{-- Section for categories --}}
        @foreach($category_article_list as $cateId => $listArticle)
            @include(
                $listArticle['view_name'],
                [
                    "category_list"         => $category_list[$cateId],
                    "category_article_list" => $listArticle,
                    'postHelper'            => $postHelper
                ]
            )
        @endforeach

        {{-- Section by category: Tin tức khác --}}
        <section id="section-home_newest_sport" class="pr-5 pl-5 mb-5 mt-8 col-span-3">
            <div class="container mx-auto">
                <div class="grid grid-cols-4 gap-4">
                    <h2 class="col-span-2 text-xl md:text-3xl uppercase font-bold text-gray-800">
                        <a href="#" class="border-b-4 border-green_custom">Tin tức khác</a>
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-3 mt-3 md:grid-cols-3 gap-3">
                @for($i = 0; $i < count($another_post_list_mobile); $i++)
                    @if($i < 3)
                        <div class="col-span-3 md:col-span-1 relative">
                            <a href="{{ route('post-detail', ['category' => strtolower($category_list[$another_post_list_mobile[$i]['category']['id']]['slug']), 'id' => $another_post_list_mobile[$i]['slug']]) }}">
                                <img src="{{ $another_post_list_mobile[$i]['thumbnail'] }}">
                            </a>
                            <h2 class="text-left text-title-common pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-1/2">
                                <a href="{{ route('post-detail', ['category' => strtolower($category_list[$another_post_list_mobile[$i]['category']['id']]['slug']), 'id' => $another_post_list_mobile[$i]['slug']]) }}" class="text-lg text-white hover:text-blue-500">
                                    {{ $another_post_list_mobile[$i]['title'] }}
                                </a>
                            </h2>
                        </div>
                    @else
                        <div class="col-span-3 md:col-span-1 grid grid-cols-3 gap-4">
                            <a href="{{ route('post-detail', ['category' => strtolower($category_list[$another_post_list_mobile[$i]['category']['id']]['slug']), 'id' => $another_post_list_mobile[$i]['slug']]) }}" class="col-span-1">
                                <img src="{{ $another_post_list_mobile[$i]['thumbnail'] }}">
                            </a>
                            <div class="col-span-2">
                                <a href="{{ route('post-detail', ['category' => strtolower($category_list[$another_post_list_mobile[$i]['category']['id']]['slug']), 'id' => $another_post_list_mobile[$i]['slug']]) }}" class="col-span-2 text-sm text-title-common font-bold text-gray-800 hover:text-blue-500">
                                    @if(strlen($another_post_list_mobile[$i]['title']) > 119)
                                        @php
                                            $title = substr($another_post_list_mobile[$i]['title'], 0 , 119);
                                            $title = substr($title, 0 , strrpos($title, " "));
                                        @endphp
                                        {{ $title }}...
                                    @else
                                        {{ $another_post_list_mobile[$i]['title'] }}
                                    @endif
                                </a>
                                <p class="text-gray-500 text-sm mt-1"><i class="fad fa-clock mr-2"></i>
                                    {{ $postHelper::convertTimeToDisplay($another_post_list_mobile[$i]['published_time']) }}
                                </p>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </section>
    </div>

    @include('ads.footer_mobile_ad')
@endsection