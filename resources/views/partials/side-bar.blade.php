<div class="intro-y col-span-3 md:col-span-1 grid grid-cols-12 gap-5">
    <div class="box col-span-12">
        <div class="flex flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Top Posts
            </h2>
        </div>
        <div class="grid grid-cols-12 p-5 gap-5">
            @foreach($recent_posts as $post)
                <div class="col-span-12 grid grid-cols-12 gap-2">
                    <a href="{{ route('post.show', ['post' => $post->slug]) }}" class="sm:col-span-2">
                        <img
                            class="hidden sm:block"
                            src="{{ asset("uploads/{$post->thumbnail}") }}">
                    </a>
                    <div class="grid col-span-12 sm:col-span-10">
                        <a href="{{ route('post.show', ['post' => $post->slug]) }}" class="font-bold">{{ $post->title }}</a>
                        <span class="text-gray-700">{{ $post->description }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="box col-span-12">
        <div class="flex flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Categories
            </h2>
        </div>
        <div class="grid grid-cols-12 p-5 gap-5">
            <div class="col-span-12 grid grid-cols-3 gap-2">
                <p class="font-bold col-span-2">Business Plan</p>
                <span class="col-span-1">87</span>
            </div>
            <div class="col-span-12 grid grid-cols-3 gap-2">
                <p class="font-bold col-span-2">Business Plan</p>
                <span class="col-span-1">87</span>
            </div>
        </div>
    </div>
</div>