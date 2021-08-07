<div class="container mx-auto">
    <div class="grid grid-cols-4 gap-4">
        <h2 class="col-span-2 text-xl md:text-3xl uppercase font-bold home-category-color">
            <a href="{{ $title_info['link'] }}" class="border-b-2 border-green_custom">{{ $title_info['name'] }}</a>
        </h2>
    </div>
</div>
@inject('postHelper', 'App\Helpers\PostHelper')
<div class="container mx-auto mt-3">
    <div class="grid grid-cols-1">
        @foreach($category_article_list as $key => $article)
            <div class="grid mb-8 md:grid-cols-2">
                <a href="{{ route('post-detail', ['category' => strtolower($category_list[$article['category']['id']]['slug']), 'id' => $article['slug']]) }}" class="md:col-span-1">
                    <img src="{{ $postHelper::convertImgToGif($article['thumbnail']) }}">
                </a>
                <div class="md:col-span-1 md:pl-5 grid md:block">
                    <a href="{{ route('post-detail', ['category' => strtolower($category_list[$article['category']['id']]['slug']), 'id' => $article['slug']]) }}" class="mt-3 md:mt-0 text-lg text-title-common font-bold text-gray-800 hover:text-blue-500">
                        {{ $article['title'] }}
                    </a>
                    <p class="text-gray-500 text-sm mt-1 md:mt-3 md:mb-3">
                        <i class="fad fa-clock mr-2"></i>
                        {{ $postHelper::convertTimeToDisplay($article['published_time']) }}
                    </p>
                    <p class="mt-2 text-gray-700 text-size-description">
                        {{ $article['description'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>