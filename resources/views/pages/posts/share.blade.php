@extends('master_post_share')
@push("meta_facebook")
    {{-- Basic tags --}}
    <meta property="og:og:site_name" content="Tin Hay 24h" />
    <meta property="og:title" content="{{ $post['title'] }}" />
    <meta property="og:image" content="{{ $post['thumbnail'] }}" />
    {{-- Optional tags --}}
    <meta property="og:description" content="{{ $post['description'] }}" />
@endpush
@inject('postHelper', 'App\Helpers\PostHelper')
@section('main')
    {{-- This section summary --}}
    <div class="w-full md:max-w-screen-sm mx-auto">
        <div class="flex justify-center items-center p-3 bg-header_share">
            <img class="w-5 rounded mr-2" src="{{ asset('images/icon_app.jpg') }}">
            <span class="font-bold text-sm mr-2">Tin hay 24h</span>
            <span class="text-sm text-gray-500 mr-3">App đọc tin hay</span>
            <a target="_blank" href="https://apps.apple.com/us/app/id1576498863?fbclid=IwAR3L9ZmJPth09TqEzWthPoGvzc8exdqImdlyaAeX3zi_H4T5qErL1n96HVs" class="rounded bg-green_custom_one p-1 text-white text-size-10 uppercase">Tải ngay</a>
        </div>

        <div class="p-3">
            <div class="grid grid-cols-1 auto-cols-max md:text-left article-detail">
                <div class="w-full text-left md:flex md:justify-center">
                    <p class="font-bold text-title-common text-2xl md:text-4xl mb-4  md:w-96">
                        {{ $post['title'] }}
                    </p>
                </div>
                <div class="w-full text-left md:flex md:justify-center">
                    <p class="text-sm mt-1 mb-4  md:w-96">
                        {{ $category_list[$post['category']['id']]['name'] }}
                        -
                        <span class="text-gray-500">{{ $postHelper::convertTimeToDisplay($post['published_time']) }}</span>
                    </p>
                </div>
                <div class="w-full md:flex md:justify-center">
                    <img src="{{ $postHelper::convertImgToGif($post['thumbnail']) }}" class="rounded mb-4 md:max-w-screen-sm">
                </div>
                <div class="w-full text-left md:flex md:justify-center wrap-share_description relative">
                    <p class="mb-3 text-gray-500 md:w-96">
                        {{ $post['description'] }}
                    </p>
                </div>
                <div class="w-full text-center shadow-download_app pt-5 flex flex-col justify-center items-center">
                    <p class="mb-3 text-gray-500 text-sm mb-4">
                        Bấm để tải và đọc tiếp <i class="fal fa-download"></i>
                    </p>
                    {{-- Link for mobile --}}
                    {{--<a target="_blank" href="https://apps.apple.com/us/app/id1576498863?fbclid=IwAR3L9ZmJPth09TqEzWthPoGvzc8exdqImdlyaAeX3zi_H4T5qErL1n96HVs" class="md:hidden rounded nav-background p-3 text-white font-bold"><i class="fal fa-mobile mr-1"></i> Đọc tiếp bằng app Tin Hay 24h</a>--}}
                    {{-- Link for web --}}
                    <a target="_blank" id="btn-open" href="" class="md:max-w-sm rounded bg-green_custom_one p-3 text-white font-bold"><i class="fal fa-mobile mr-1"></i> Đọc tiếp bằng app Tin Hay 24h</a>
                </div>
                <input type="hidden" id="url-ios_app" value="{{ $ios_dynamic_link }}">
                <input type="hidden" id="url-normal" value="{{ route('post-detail', ['category' => $category_list[$post['category']['id']]['slug'], 'id' => $post['slug']]) }}">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            let isiOS = (navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false); console.log(isiOS);
            let urlIosAppTarget = $('#url-ios_app');
            let urlNormalTarget = $('#url-normal');

            if (isiOS) {
                $('#btn-open').attr('href', urlIosAppTarget.val());
            } else {
                $('#btn-open').attr('href', urlNormalTarget.val());
            }
        });
    </script>
@endsection
