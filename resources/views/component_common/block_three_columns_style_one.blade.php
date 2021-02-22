<section id="section-home_newest_sport" class="pr-5 pl-5 mb-5 mt-8 col-span-3">
    <div class="container mx-auto">
        <div class="grid grid-cols-4 gap-4">
            <h2 class="col-span-4 text-xl md:text-3xl uppercase font-bold home-category-color">
                <a href="{{ route('post-list', ['category' => $category_list['slug']]) }}"
                    class="border-b-2 border-orange-700">{{ $category_list['name'] }}
                </a>
            </h2>
        </div>
    </div>

    <div class="grid md:grid-cols-3 mx-auto mt-3">
        <div class="grid md:col-span-1">
            <a href="{{
                route('post-detail',
                [
                    'category' => $category_list['slug'],
                    'id'       => $category_article_list['article_list'][0]['id']
                ])
            }}">
                <img src="{{ $category_article_list['article_list'][0]['thumbnail'] }}">
            </a>
            <a href="{{
                route('post-detail',
                [
                    'category' => $category_list['slug'],
                    'id'       => $category_article_list['article_list'][0]['id']
                ])
            }}" class="mt-3 text-lg font-bold text-gray-800 hover:text-blue-500">
                {{ $category_article_list['article_list'][0]['title'] }}
            </a>
            <p class="text-gray-500 text-sm mt-1"><i class="fad fa-clock mr-2"></i>
                {{ $postHelper::convertTimeToDisplay($category_article_list['article_list'][0]['published_time']) }}
            </p>
            <p class="mt-2 text-gray-700 text-sm">
                {{ $category_article_list['article_list'][0]['description'] }}
            </p>
        </div>

        @php unset($category_article_list['article_list'][0]); @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 md:col-span-2 gap-10 mt-10 md:mt-0 md:pl-5">
            @for($i = 1; $i < 7; $i++)
                @if(isset($category_article_list['article_list'][$i]))
                    <div class="col-span-1 grid grid-cols-3 gap-4">
                        <a href="{{ route('post-detail', ['category' => $category_list['slug'], 'id' => $category_article_list['article_list'][$i]['id']]) }}" class="col-span-1">
                            <img src="{{ $category_article_list['article_list'][$i]['thumbnail'] }}">
                        </a>
                        <div class="col-span-2">
                            <a href="{{ route('post-detail', ['category' => $category_list['slug'], 'id' => $category_article_list['article_list'][$i]['id']]) }}" class="col-span-2 text-sm font-bold text-gray-800 hover:text-blue-500">
                                @if(strlen($category_article_list['article_list'][$i]['title']) > 119)
                                    @php
                                        $title = substr($category_article_list['article_list'][$i]['title'], 0 , 119);
                                        $title = substr($title, 0 , strrpos($title, " "));
                                    @endphp
                                    {{ $title }}...
                                @else
                                    {{ $category_article_list['article_list'][$i]['title'] }}
                                @endif
                            </a>
                            <p class="text-gray-500 text-sm mt-1"><i class="fad fa-clock mr-2"></i>
                                {{ $postHelper::convertTimeToDisplay($category_article_list['article_list'][$i]['published_time']) }}
                            </p>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
    </div>
</section>