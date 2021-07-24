@extends('master')
@push("meta_facebook")
    {{-- Basic tags --}}
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $post['title'] }}" />
    <meta property="og:image" content="{{ asset("images/post_og/{$post['post_og_img']}") }}" />
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
                    <img src="{{ $postHelper::convertImgToGif($post['thumbnail']) }}" class="rounded mb-4 md:max-w-screen-sm">
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
                                @if(isset($content['src']))
                                    <div class="w-full md:flex md:justify-center">
                                        <video autoplay muted controls loop class="md:w-3/4 rounded-md">
                                            <source src="{{ $content['src'] }}" type="video/mp4">
                                        </video>
                                    </div>
                                @else
                                    <div class="w-full md:flex md:justify-center">
                                        <img src="{{ $postHelper::convertImgToGif($content['poster']) }}" class="rounded mb-4 md:max-w-screen-sm">
                                    </div>
                                @endif
                            @endif
                        @endif
                    @endif
                @endforeach
                <div class="w-full text-left flex justify-between items-center mb-4">
                    <a href="javascript:void(0)" id="btn-share_post" class="button flex items-center justify-center nav-background text-white w-32 sm:w-40 rounded p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2 w-4 h-4 mr-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
                        Chia sẻ link
                    </a>
                    <p class="text-lg text-gray-700 text-right md:w-96">
                        <a href="{{ $post['url'] }}" target="_blank">Link gốc <i class="fas fa-external-link"></i></a>
                    </p>
                </div>
                <input type="hidden" id="url-share_post" value="{{ route('post-share', ['id' => $post['id']]) }}">
            </div>

            <h2 class="font-bold text-lg md:text-3xl mb-3 mt-5 home-category-color">
                <a class="border-b-2 border-orange-700">Tin Liên Quan</a>
            </h2>
            <div class="grid grid-cols-3 gap-8">
                @foreach($related_post_list as $related_post)
                    <div class="grid col-span-3 md:col-span-1">
                        <a href="{{ route('post-detail', ['category' => $category_list[$related_post['category']['id']]['slug'], 'id' => $related_post['slug']]) }}">
                            <img src="{{ $postHelper::convertImgToGif($related_post['thumbnail']) }}" class="rounded">
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
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#btn-share_post').on('click', function () {
                let tempElement = $("<input id='inputTemp'>");
                $('body').append(tempElement);
                let inputTemp = document.getElementById('inputTemp');

                let url = $('#url-share_post').val();
                tempElement.val(url).select();
                inputTemp.focus();
                inputTemp.setSelectionRange(0, 99999);
                document.execCommand('Copy');
                tempElement.remove();

                toastr.success("Đã copy link.");
            })
        });
    </script>
@endsection