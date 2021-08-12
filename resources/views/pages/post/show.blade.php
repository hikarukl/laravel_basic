@extends('master')
@section('main')
   @include('partials.frontend.header_page_info', ['header_page_title' => 'Post Detail'])

    <div class="intro-y grid grid-cols-3 gap-5 mt-3">
        <div class="col-span-3 md:col-span-2 grid grid-cols-12 gap-3">
            <div class="intro-y col-span-12 box">
                <div class="p-5">
                    @if($post->thumbnail)
                        <div class="flex justify-center mb-5">
                            <img alt="{{ $post->title }}"
                                 class="rounded-md w-full"
                                 src="{{ asset("uploads/{$post->thumbnail}") }}">
                        </div>
                    @endif
                    <a href="" class="block font-medium text-xl">
                        {{  $post->title }}
                    </a>
                    <div class="intro-y text-gray-700 dark:text-gray-600 mt-1 text-xs sm:text-sm">
                        {{ \Illuminate\Support\Carbon::parse($post->created_at)->format('d M Y') }} <span class="mx-1">•</span>
                        <a class="text-theme-1 dark:text-theme-10" href="{{ route('category.show', ['category' => $post->category->slug]) }}">{{  $post->category->name }}</a>
                    </div>
                    <div class="text-gray-700 dark:text-gray-600 mt-3 text-base">
                        {!! $post->content !!}
                    </div>
                </div>

                <div class="p-5">
                    <button id="btn-share_post" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
                        <i data-feather="share-2" class="w-4 h-4 mr-2"></i> Share
                    </button>
                    <input type="hidden" id="url-share_post" value="{{ route('post.show', ['post' => $post->slug]) }}">
                </div>
            </div>
        </div>

        @include('partials.side-bar')
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        cash("body").on("click", "#btn-share_post", function () {
            let tempElement = cash("<input id='inputTemp'>");
            cash('body').append(tempElement);
            let inputTemp = document.getElementById('inputTemp');
            let url = cash('#url-share_post').val();

            cash(tempElement).val(url);

            inputTemp.focus();
            inputTemp.setSelectionRange(0, 99999);
            document.execCommand('Copy');

            tempElement.remove();
            Toastify({
                text: "Đã copy link",
                duration: 2000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#4d79f6",
                stopOnFocus: true }).showToast();
        });
    </script>
@endsection