@extends('master')
@section('main')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Home
        </h2>
    </div>

    <div class="intro-y grid grid-cols-3 gap-5 mt-3">
        <div class="col-span-3 md:col-span-2 grid grid-cols-12 gap-3">
            <h2 class="col-span-12">
                PHP
            </h2>
            @for($i = 0; $i < 6; $i++)
                <div class="intro-y col-span-12 md:col-span-6 box">
                    <div class="p-5">
                        <div class="h-40 xxl:h-56 image-fit">
                            <img alt="Midone Tailwind HTML Admin Template" class="rounded-md" src="{{ asset('images/default_post_800x800.jpg') }}">
                        </div>
                        <a href="{{ route('post.show', ['post' => $i]) }}" class="block font-medium text-base mt-5">Dummy text of the printing and typesetting industry</a>
                        <div class="text-gray-700 dark:text-gray-600 mt-2">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                    </div>
                </div>
            @endfor
        </div>

        @include('partials.side-bar', ['recent_posts' => $recent_posts])
    </div>
@endsection