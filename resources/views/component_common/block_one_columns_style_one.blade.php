<div class="container mx-auto">
    <div class="grid grid-cols-4 gap-4">
        <h2 class="col-span-2 text-xl md:text-3xl uppercase font-bold home-category-color">
            <a href="{{ $title_info['link'] }}" class="border-b-2 border-orange-700">{{ $title_info['name'] }}</a>
        </h2>
    </div>
</div>

<div class="container mx-auto mt-3 grid gap-4">
    @foreach($category_article_list as $key => $article)
        @if($key === 0)
            <div class="relative">
                <a href="{{ route('post-detail', ['category' => strtolower($category_list[$article['category']['id']]['slug']), 'id' => $article['id']]) }}">
                    <img src="{{ $new_post_list[0]['thumbnail'] }}"/>
                </a>
                <h2 class="text-left pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                    <a href="{{ route('post-detail', ['category' => strtolower($category_list[$article['category']['id']]['slug']), 'id' => $article['id']]) }}" class="text-sm text-white hover:text-blue-500">
                        {{ $new_post_list[0]['title'] }}
                    </a>
                </h2>
            </div>

        @else
            <div class="col-span-1 grid grid-cols-3 gap-4">
                <a href="{{ route('post-detail', ['category' => strtolower($category_list[$article['category']['id']]['slug']), 'id' => $article['id']]) }}" class="col-span-1">
                    <img src="{{ $article['thumbnail'] }}">
                </a>
                <div class="col-span-2">
                    <a href="{{ route('post-detail', ['category' => strtolower($category_list[$article['category']['id']]['slug']), 'id' => $article['id']]) }}" class="col-span-2 text-sm font-bold text-gray-800 hover:text-blue-500">
                        @if(strlen($article['title']) > 119)
                            @php
                                $title = substr($article['title'], 0 , 119);
                                $title = substr($title, 0 , strrpos($title, " "));
                            @endphp
                            {{ $title }}...
                        @else
                            {{ $article['title'] }}
                        @endif
                    </a>
                    <p class="text-gray-500 text-sm mt-1"><i class="fad fa-clock mr-2"></i>
                        {{ $postHelper::convertTimeToDisplay($article['published_time']) }}
                    </p>
                </div>
            </div>
        @endif
    @endforeach
</div>
