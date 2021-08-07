<section id="section-three_style_default" class="pr-5 pl-5 mb-5 mt-8 col-span-3">
    <div class="container mx-auto">
        <div class="grid grid-cols-4 gap-4">
            <h2 class="col-span-4 text-xl md:text-3xl uppercase font-bold home-category-color">
                <a href="{{ route('post-list', ['category' => $category_list['slug']]) }}"
                   class="border-b-2 border-green_custom">{{ $category_list['name'] }}
                </a>
            </h2>
        </div>
    </div>
    @inject('postHelper', 'App\Helpers\PostHelper')
    <div class="grid md:grid-cols-3 mx-auto mt-3 gap-4">
        @foreach($category_article_list['article_list'] as $article)
            <div class="grid md:col-span-1">
                <a href="{{
                route('post-detail',
                [
                    'category' => $category_list['slug'],
                    'id'       => $article['slug']
                ])
            }}">
                    <img src="{{ $postHelper::convertImgToGif($article['thumbnail']) }}">
                </a>
                <a href="{{
                route('post-detail',
                [
                    'category' => $category_list['slug'],
                    'id'       => $article['slug']
                ])
            }}" class="mt-3 text-lg text-title-common font-bold text-gray-800 hover:text-blue-500">
                    {{ $article['title'] }}
                </a>
                <p class="text-gray-500 text-sm mt-1"><i class="fad fa-clock mr-2"></i>
                    {{ $postHelper::convertTimeToDisplay($article['published_time']) }}
                </p>
                <p class="mt-2 text-gray-700 text-size-description">
                    {{ $article['description'] }}
                </p>
            </div>
        @endforeach
    </div>
</section>