@extends('master')
@section('main')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Post Detail
        </h2>
    </div>

    <div class="intro-y grid grid-cols-3 gap-5 mt-3">
        <div class="col-span-3 md:col-span-2 grid grid-cols-12 gap-3">
            <div class="intro-y col-span-12 box">
                <div class="p-5">
                    <div class="flex justify-center">
                        <img alt="Midone Tailwind HTML Admin Template"
                             class="rounded-md w-full"
                             src="{{ asset('images/default_post_detail_769x436.png') }}">
                    </div>
                    <p class="mt-2">
                        2021-12-30
                    </p>
                    <a href="" class="block font-medium text-base mt-5">Dummy text of the printing and typesetting industry</a>
                    <div class="text-gray-700 dark:text-gray-600 mt-2">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                </div>

                <div class="p-5">
                    <button id="btn-share_post" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
                        <i data-feather="share-2" class="w-4 h-4 mr-2"></i> Share
                    </button>
                    <input type="hidden" id="url-share_post" value="{{ route('post.show', ['post' => 1]) }}">
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
                backgroundColor: "#0e2c88",
                stopOnFocus: true }).showToast();
        });
    </script>
@endsection