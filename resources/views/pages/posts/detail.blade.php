@extends('master')
@push("meta_facebook")
    {{-- Basic tags --}}
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $post['title'] }}" />
    {{--<meta property="og:image" content="{{ $post['thumbnail'] }}" />--}}
    <meta property="og:image" content="{{ asset('images/default-fb.jpg') }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="675" />
    <meta property="og:url" content="{{ route('post-detail', ['category' => strtolower($category_list[$post['category']['id']]['slug']), 'id' => $post['slug']]) }}" />
    {{-- Optional tags --}}
    <meta property="og:description" content="{{ $post['description'] }}" />
    <meta property="og:og:site_name" content="Trang Tin Hay" />
@endpush
@inject('postHelper', 'App\Helpers\PostHelper')
@section('main')
    {{-- This section summary --}}
    <div class="max-w-7xl mx-auto mt-3 pl-5 pr-5 pt-28 mt-2 md:mt-0 md:pt-8 md:grid md:grid-cols-3">
        <div class="md:col-span-2">
            <div class="grid grid-cols-1 auto-cols-max md:text-left article-detail">
                <div class="w-full text-left md:flex md:justify-center">
                    <p class="font-bold text-title-common text-2xl md:text-4xl mb-4  md:w-96">
                        {{ $post['title'] }}
                    </p>
                </div>
                <div class="w-full text-left md:flex md:justify-center">
                    <p class="text-gray-500 text-sm mt-1 mb-4  md:w-96"><i class="fad fa-clock mr-2"></i>
                        {{ $postHelper::convertTimeToDisplay($post['published_time']) }}
                    </p>
                </div>
                <div class="w-full text-left md:flex md:justify-center">
                    <p class="mb-3 text-gray-500 md:w-96">
                        {{ $post['description'] }}
                    </p>
                </div>
                <div class="w-full md:flex md:justify-center">
                    <img src="{{ $post['thumbnail'] }}" class="rounded mb-4 md:max-w-screen-sm">
                </div>
                @foreach($post['content'] as $content)
                    @if(is_string($content) && !preg_match("/.*(Ảnh:).*/", $content) && !preg_match("/.*(Nguồn:).*/", $content))
                        <div class="w-full text-left md:flex md:justify-center">
                            <p class="mb-4 text-content-detail md:flex-initial md:w-96">
                                {!! $content !!}
                            </p>
                        </div>
                    @else
                        @if(is_array($content))
                            @if($content['type'] == 'img')
                                <div class="w-full md:flex md:justify-center">
                                    <img src="{{ $content['src'] }}" class="rounded mb-4 md:max-w-screen-sm">
                                </div>
                            @elseif($content['type'] == 'gif')
                                <div class="w-full md:flex md:justify-center">
                                    <img src="{{ $content['poster'] }}" class="rounded mb-4 md:max-w-screen-sm">
                                </div>
                            @endif
                        @endif
                    @endif
                @endforeach
                <div class="w-full text-left md:flex md:justify-center">
                    <p class="text-lg text-gray-700 mb-4 text-right md:w-96">
                        <a href="{{ $post['url'] }}" target="_blank">Theo kenh14.vn <i class="fas fa-external-link"></i></a>
                    </p>
                </div>

            </div>

            <h2 class="font-bold text-lg md:text-3xl mb-3 mt-5 home-category-color">
                <a class="border-b-2 border-orange-700">Tin Liên Quan</a>
            </h2>
            <div class="grid grid-cols-3 gap-8">
                @foreach($related_post_list as $related_post)
                    <div class="grid col-span-3 md:col-span-1">
                        <a href="{{ route('post-detail', ['category' => $category_list[$related_post['category']['id']]['slug'], 'id' => $related_post['slug']]) }}">
                            <img src="{{ $related_post['thumbnail'] }}" class="rounded">
                        </a>
                        <a href="{{ route('post-detail', ['category' => $category_list[$related_post['category']['id']]['slug'], 'id' => $related_post['slug']]) }}" class="pl-1 md:pl-0 font-bold mt-2 text-lg text-title-common hover:text-blue-500">
                            {{ $related_post['title'] }}
                        </a>
                        <p class="text-gray-500 text-sm mt-1"><i class="fad fa-clock mr-2"></i>
                            {{ $postHelper::convertTimeToDisplay($related_post['published_time']) }}
                        </p>
                        <p class="mt-3 text-gray-700 text-sm">
                            {{ $related_post['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Section by category: Mới nhất --}}
        <section id="section-home_newest_sport" class="md:pl-5 mb-5 md:col-span-1 mt-8 md:mt-0">
            @include(
                "component_common.block_one_columns_style_one",
                [
                    "category_list"         => $category_list,
                    "category_article_list" => $new_post_list,
                    "title_info"            => [
                        "name"  => "Tin Tức Khác",
                        "link"  => "#"
                    ],
                    'postHelper'            => $postHelper
                ]
            )
        </section>
    </div>
@endsection
