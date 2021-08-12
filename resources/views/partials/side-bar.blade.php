<div class="intro-y col-span-3 md:col-span-1 grid grid-cols-12 gap-5">
    <div class="box col-span-12">
        <div class="flex flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-xl mr-auto">
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
            <h2 class="font-medium text-xl mr-auto">
                Categories
            </h2>
        </div>
        <div class="grid grid-cols-12 p-5 gap-5">
            @foreach($category_list as $category)
                <div class="col-span-12 grid grid-cols-3 gap-2">
                    <a href="{{ route('category.show', ['category' => $category->name]) }}" class="font-bold col-span-2 hover:text-blue-500">{{ $category->name }}</a>
                    <a href="{{ route('category.show', ['category' => $category->name]) }}" class="col-span-1 text-gray-700 font-bold hover:text-blue-500">({{ $category->posts->count() }})</a>
                </div>
            @endforeach
        </div>
    </div>
</div>