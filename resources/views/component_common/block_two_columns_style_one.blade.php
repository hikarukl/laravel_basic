<div class="container mx-auto">
    <div class="grid grid-cols-4 gap-4">
        <h2 class="col-span-2 text-xl md:text-3xl uppercase font-bold home-category-color">
            <a href="{{ $title_info['link'] }}" class="border-b-2 border-orange-700">{{ $title_info['name'] }}</a>
        </h2>
    </div>
</div>

<div class="container mx-auto mt-3">
    <div class="grid grid-cols-1">
        {{--<div class="grid">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-format="fluid"
                 data-ad-layout-key="-6o+cd+1b-14+b1"
                 data-ad-client="ca-pub-1183003705015401"
                 data-ad-slot="9312214781"></ins>
            <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>--}}
        @foreach($category_article_list as $key => $article)
            <div class="grid mb-8 md:grid-cols-2">
                <a href="{{ route('post-detail', ['category' => strtolower($category_list[$article['category']['id']]['slug']), 'id' => $article['id']]) }}" class="md:col-span-1">
                    <img src="{{ $article['thumbnail'] }}">
                </a>
                <div class="md:col-span-1 md:pl-5 grid md:block">
                    <a href="{{ route('post-detail', ['category' => strtolower($category_list[$article['category']['id']]['slug']), 'id' => $article['id']]) }}" class="mt-3 md:mt-0 text-lg text-title-common font-bold text-gray-800 hover:text-blue-500">
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