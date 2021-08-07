<div class="fixed bottom-0 md:hidden footer-ad_mobile">
    <a class="" target="_blank" href="{{ \App\Constants\CommonConstant::URL_IOS_APP }}">
        <img src="{{ asset('images/web_news/banner_ios_app.png') }}">
    </a>
</div>
@push('scripts_component')
    <script>
        let footerAd = document.querySelector('.footer-ad_mobile');
        let footerAdHeight = footerAd.clientHeight + 5;

        if ($(footerAd).is(':visible')) {
            $('#main-page').css({
                'margin-bottom': footerAdHeight + 'px'
            });
        }
        $('.footer-ad_mobile').on('click', function () {
            firebase.analytics().logEvent('Mobile_click_banner');
        });
    </script>
@endpush