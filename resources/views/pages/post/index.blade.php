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
            @foreach($post_list as $post)
                <div class="intro-y col-span-12 md:col-span-6 box">
                    <div class="p-5">
                        <div class="h-40 xxl:h-56 image-fit overflow-hidden rounded">
                            <img alt="" class="image-scale" src="{{ $post->thumbnail ? asset("uploads/{$post->thumbnail}") : asset("images/categories/{$post->category->slug}_default.png") }}">
                        </div>
                        <a
                                href="{{ route('post.show', ['post' => $post->slug]) }}"
                                class="block font-medium text-xl mt-2 hover:text-blue-500">{{ $post->title }}</a>
                        <div class="flex text-gray-600 truncate text-xs mt-0.5">
                            <a class="text-theme-1 dark:text-theme-10 inline-block truncate" href="{{ route('category.show', ['category' => $post->category->slug]) }}">
                                {{ $post->category->name }}
                            </a>
                            <span class="mx-1">•</span> {{ $postHelper::convertTimeToDisplay($post->created_at) }}
                        </div>
                        <div class="text-gray-700 dark:text-gray-600 mt-1 mb-4 text-base">
                            {{ $post->description }}
                        </div>
                        <a href="{{ route('post.show', ['post' => $post->slug]) }}" class="mt-2 font-bold underline text-blue-600 hover:text-gray-700 text-xl">
                            Read More
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @include('partials.side-bar', ['recent_posts' => $recent_posts])
    </div>
@endsection