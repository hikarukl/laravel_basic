@inject('postHelper', 'App\Helpers\PostHelper')
<!doctype html>
<html>
    <head>
        <link rel="canonical" href="{{ route('post-detail', ['category' => $category_list[$article['category']['id']]['slug'], 'id' => $article['id']]) }}">
        <meta charset="utf-8"/>
        <meta property="op:markup_version" content="v1.0"/>
        <meta property="fb:use_automatic_ad_placement" content="true"/>
        <meta property="fb:article_style" content="default"/>
    </head>
    <body>
        <article>
            <header>
                <h1>{{  $article['title']  }}</h1>
                <h3 class="op-kicker">{{ $article['category']['name'] }}</h3>
                <time class="op-published" dateTime="{{ $postHelper::convertTimeInstantArticle($article['published_time'], 'c')  }}">{{ $postHelper::convertTimeInstantArticle($article['published_time'], 'M d Y, H:i a') }}</time>
                <time class="op-modified" dateTime="{{ $postHelper::convertTimeInstantArticle($article['modified_time'], 'c') }}">{{ $postHelper::convertTimeInstantArticle($article['modified_time'], 'M d Y, H:i a') }}</time>
            </header>

            @foreach($article['content'] as $content)
                @if(is_string($content) && !preg_match("/.*(Ảnh:).*/", $content) && !preg_match("/.*(Nguồn:).*/", $content))
                    <p>
                        {!! $content !!}
                    </p>
                @else
                    @if(is_array($content))
                        @if($content['type'] == 'img')
                            <figure>
                                <img src="{{ $content['src'] }}"/>
                            </figure>
                        @elseif($content['type'] == 'gif')
                            <figure>
                                <img src="{{ $content['poster'] }}"/>
                            </figure>
                        @endif
                    @endif
                @endif
            @endforeach

            <footer>
                <aside>Some plaintext credits.</aside>
            </footer>
        </article>
    </body>
</html>