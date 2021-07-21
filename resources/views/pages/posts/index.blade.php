@extends('master')
@inject('postHelper', 'App\Helpers\PostHelper')
@section('main')
    {{-- This section summary --}}
    <section class="max-w-7xl mx-auto pl-5 pr-5 pt-28 mt-2 md:mt-0 md:pt-8">
        {{-- This section summary for mobile --}}
        <div class="grid grid-cols-3 gap-1 md:hidden">
            @foreach($top_post_list as $top_post)
                <div class="col-span-3 relative">
                    <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post['category']['id']]['slug']), 'id' => $top_post['slug']]) }}">
                        <img src="{{ $postHelper::convertImgToGif($top_post['thumbnail']) }}">
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
                    <img class="w-full" src="{{ $postHelper::convertImgToGif($top_post_list[0]['thumbnail']) }}">
                </a>
                <h2 class="text-left text-title-common pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                    <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post_list[0]['category']['id']]['slug']), 'id' => $top_post_list[0]['slug']]) }}" class="text-lg md:text-xl text-white hover:text-blue-500">
                        {{ $top_post_list[0]['title'] }}
                    </a>
                </h2>
            </div>
            <div class="col-span-1 grid grid-cols-2 gap-1">
                @for($i = 1; $i < count($top_post_list); $i++)
                    <div class="col-span-1 relative">
                        <a href="{{ route('post-detail', ['category' => strtolower($category_list[$top_post_list[$i]['category']['id']]['slug']), 'id' => $top_post_list[$i]['slug']]) }}">
                            <img src="{{ $postHelper::convertImgToGif($top_post_list[$i]['thumbnail']) }}">
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
    </section>

    <div class="grid grid-cols-3 max-w-7xl mx-auto">
        {{-- Section by category: Tiêu điểm --}}
        <section id="section-home_newest_sport" class="pr-5 pl-5 mt-8 col-span-3 md:col-span-2">
            <div class="container mx-auto">
                <div class="grid grid-cols-4 gap-4">
                    <h2 class="col-span-4 text-xl md:text-3xl font-bold home-category-color">
                        <a href="#" class="border-b-2 border-orange-700">{{ ucwords($category_name) }}</a>
                    </h2>
                </div>
            </div>

            <div class="container mx-auto mt-3">
                <div class="grid grid-cols-1">
                    @foreach($related_post_list as $related_post)
                        <div class="grid mb-8 md:grid-cols-2">
                            <a href="{{ route('post-detail', ['category' => $category_list[$related_post['category']['id']]['slug'], 'id' => $related_post['slug']]) }}" class="md:col-span-1">
                                <img src="{{ $postHelper::convertImgToGif($related_post['thumbnail']) }}">
                            </a>
                            <div class="md:col-span-1 md:pl-5 grid md:block">
                                <a href="{{ route('post-detail', ['category' => $category_list[$related_post['category']['id']]['slug'], 'id' => $related_post['slug']]) }}" class="mt-3 md:mt-0 text-lg text-title-common font-bold text-gray-800 hover:text-blue-500">
                                    {{ $related_post['title'] }}
                                </a>
                                <p class="text-gray-500 text-sm mt-1 md:mt-3 md:mb-3">
                                    <i class="fad fa-clock mr-2"></i>
                                    {{ $postHelper::convertTimeToDisplay($related_post['published_time']) }}
                                </p>
                                <p class="mt-2 text-gray-700 text-sm">
                                    {{ $related_post['description'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Section by category: Mới nhất --}}
        <section id="section-home_newest_sport" class="pr-5 pl-5 mb-5 col-span-3 md:col-span-1 md:mt-8">
            @include(
                "component_common.block_one_columns_style_one",
                [
                    "category_list"         => $category_list,
                    "category_article_list" => $new_post_list,
                    "title_info"            => [
                        "name"  => "Tin tức khác",
                        "link"  => "#"
                    ],
                    'postHelper'            => $postHelper
                ]
            )
        </section>
    </div>
@endsection
