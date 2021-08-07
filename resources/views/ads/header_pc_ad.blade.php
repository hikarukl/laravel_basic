<div class="hidden header-ad_pc md:block {{ $classes ?? '' }}">
    <a class="" target="_blank" href="{{ \App\Constants\CommonConstant::URL_IOS_APP }}">
        <img src="{{ asset('images/web_news/banner_ios_app.png') }}">
    </a>
</div>
@push('scripts_component')
    <script>
        $('.header-ad_pc').on('click', function () {
            firebase.analytics().logEvent('Web_click_banner');
        });
    </script>
@endpush