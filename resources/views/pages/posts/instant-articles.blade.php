<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
    <channel>
        <title>{{ $title }}</title>
        <link>{{ url('/') }}</link>
        <description>
            This is news website.
        </description>
        <language>en-us</language>
        <lastBuildDate>{{ date('c') }}</lastBuildDate>
        @forelse($articles as $article)
            <item>
                <title><![CDATA[{{ $article['title'] }}]]></title>
                <link>{{ route('post-detail', ['category' => $category_list[$article['category']['id']]['slug'], 'id' => $article['id']]) }}</link>
                <guid>{{ uniqid($article['id']) }}</guid>
                <pubDate>{{ date('c', strtotime($article['published_time'])) }}</pubDate>
                <description><![CDATA[{{ $article['description'] }}]]></description>
                <content:encoded>
                    <![CDATA[
                    @include('pages.posts._rss')
                    ]]>
                </content:encoded>
            </item>
        @empty
            <item>No feeds found</item>
        @endforelse
    </channel>
</rss>