<!doctype html>
<html lang="en" prefix="op: http://media.facebook.com/op#">
<head>
    <meta charset="utf-8">
    <meta property="op:markup_version" content="v1.0">
    <meta property="fb:article_style" content="default"/>
    <link rel="canonical" href="{{ route('post-detail', ['category' => $category_list[$article['category']['id']]['slug'], 'id' => $article['id']]) }}">
    <title>{{ $article['title'] }}</title>
</head>
<body>
<article>
    <header>
        <h1>{{  $article['title']  }}</h1>
    </header>

    <footer>
        <aside>
            A short footer note for your each Instant Articles.
        </aside>
        <small>© Copyright {{ date('Y') }}</small>
    </footer>
</article>
</body>
</html>