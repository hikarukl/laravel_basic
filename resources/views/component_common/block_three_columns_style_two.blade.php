<section id="section-three_style_two" class="pr-5 pl-5 mb-5 mt-8 col-span-3 hidden md:block">
    <div class="container mx-auto">
        <div class="grid grid-cols-4 gap-4">
            <div class="grid grid-cols-4 gap-4">
                <h2 class="col-span-4 text-xl md:text-3xl uppercase font-bold home-category-color">
                    <a href="{{ route('post-list', ['category' => $category_list['slug']]) }}"
                       class="border-b-2 border-green_custom">{{ $category_list['name'] }}
                    </a>
                </h2>
            </div>
        </div>
    </div>
    @inject('postHelper', 'App\Helpers\PostHelper')
    <div class="grid mt-3 grid-cols-3 gap-x-5">
        @php $chunkList = array_chunk($category_article_list['article_list'], 4) @endphp
        @for ($i = 0; $i < 3; $i++)
            <div class="col-span-1 grid grid-cols-2">
                <div class="col-span-2 relative">
                    <a href="{{ route('post-detail', ['category' => $category_list['slug'], 'id' => $chunkList[$i][0]['slug']]) }}">
                        <img src="{{ $postHelper::convertImgToGif($chunkList[$i][0]['thumbnail']) }}">
                    </a>
                    <h2 class="text-left text-title-common pl-2 pr-2 font-bold absolute bottom-0 bg-linear-custom-home w-full h-2/5">
                        <a href="{{ route('post-detail', ['category' => 'sport', 'id' => $chunkList[$i][0]['slug']] }}" class="text-lg text-white hover:text-blue-500">
                            {{ $chunkList[$i][0]['title'] }}
                        </a>
                        <p class="text-white text-sm"><i class="fad fa-clock mr-2"></i>
                            {{ $postHelper::convertTimeToDisplay($chunkList[$i][0]['published_time']) }}
                        </p>
                    </h2>
                </div>

                @php unset($chunkList[$i][0]) @endphp

                <div class="col-span-2 grid grid-cols-2 gap-10 mt-10">
                    @foreach($chunkList[$i] as $article)
                        <div class="col-span-2 grid grid-cols-3 gap-4">
                            <a href="{{ route('post-detail', ['category' => $category_list['slug'], 'id' => $article['slug']]) }}" class="col-span-1">
                                <img src="{{ $postHelper::convertImgToGif($article['thumbnail']) }}">
                            </a>
                            <div class="col-span-2">
                                <a href="{{ route('post-detail', ['category' => 'sport', 'id' => $article['slug']]) }}" class="col-span-2 text-sm text-title-common font-bold text-gray-800 hover:text-blue-500">
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
                    @endforeach
                </div>
            </div>
        @endfor
    </div>
</section>