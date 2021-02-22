@extends('master')
@inject('postHelper', 'App\Helpers\PostHelper')
@section('main')
    {{-- This section summary --}}
    <div class="max-w-7xl mx-auto mt-3 pl-5 pr-5 pt-16 md:pt-0 md:grid md:grid-cols-3">
        <div class="md:col-span-2">
            <div class="grid grid-cols-1 auto-cols-max md:text-left md:flex md:flex-col">
                <p class="font-bold text-lg md:text-3xl mb-4">
                    {{ $post['title'] }}
                </p>
                <p class="text-gray-500 text-lg mt-1 mb-4"><i class="fad fa-clock mr-2"></i>
                    {{ $postHelper::convertTimeToDisplay($post['published_time']) }}
                </p>
                <p class="mb-3 text-gray-400">
                    {{ $post['description'] }}
                </p>
                <img src="{{ $post['thumbnail'] }}" class="rounded mb-4">
                @foreach($post['content'] as $content)
                    @if(is_string($content) && !preg_match("/.*(Ảnh:).*/", $content) && !preg_match("/.*(Nguồn:).*/", $content))
                        <p class="text-lg text-gray-700 mb-4">
                            {!! $content !!}
                        </p>
                    @else
                        @if(is_array($content))
                            @if($content['type'] == 'img')
                                <img src="{{ $content['src'] }}" class="rounded mb-4">
                            @elseif($content['type'] == 'gif')
                                <img src="{{ $content['poster'] }}" class="rounded mb-4">
                            @endif
                        @endif
                    @endif
                @endforeach
                <p class="text-lg text-gray-700 mb-4">
                    <a href="{{ $post['url'] }}" target="_blank">Theo kenh14.vn <i class="fas fa-external-link"></i></a>
                </p>
            </div>

            <h2 class="font-bold text-lg md:text-3xl mb-3 mt-5 home-category-color">
                <a class="border-b-2 border-orange-700">Tin liên quan</a>
            </h2>
            <div class="grid grid-cols-3 gap-8">
                @foreach($related_post_list as $related_post)
                    <div class="grid col-span-3 md:col-span-1">
                        <a href="{{ route('post-detail', ['category' => $category_list[$related_post['category']['id']]['slug'], 'id' => $related_post['id']]) }}">
                            <img src="{{ $related_post['thumbnail'] }}" class="rounded">
                        </a>
                        <a href="{{ route('post-detail', ['category' => $category_list[$related_post['category']['id']]['slug'], 'id' => $related_post['id']]) }}" class="pl-1 md:pl-0 font-bold mt-2 text-sm md:text-sm hover:text-blue-500">
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
                        "name"  => "Mới nhất",
                        "link"  => "#"
                    ],
                    'postHelper'            => $postHelper
                ]
            )
        </section>
    </div>
@endsection
