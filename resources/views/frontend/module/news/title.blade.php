<!-- title -->
<section class="c-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6 offset-lg-1 offset-md-0 u-mg-b-30 u-mg-md-b-0">
                <div class="c-breadcrumb">
                    <div class="c-breadcrumb__item">
                        <a href="/">Egeria</a> <span>/</span>
                    </div>
                    @if (!$is_main)
                        <div class="c-breadcrumb__item">
                            <a href="{{ route('news') }}">{{ $haberler_detay_baslik->text }}</a> <span>/</span>
                        </div>
                        <div class="c-breadcrumb__item c-breadcrumb__item--last">
                            {{ $news_cat_title }}
                        </div>
                    @else
                        <div class="c-breadcrumb__item c-breadcrumb__item--last">
                            {{ $haberler_detay_baslik->text }}
                        </div>
                    @endif
                </div>
                <div class="c title">
                    <h2 class="c-title__heading">
                        {{ isset($news_cat_title) ? $news_cat_title : $haberler_detay_baslik->text }}</h2>
                    <p class="c-title__desc">{{ $haberler_detay_alt_baslik->text }}</p>
                </div>
            </div>
            {{-- <div class="col-lg-3 col-md-6 d-flex align-items-center">
                <input type="text" class="c-input c-input--has-icon" placeholder="Arama yapın">
                <svg class="c-icon__svg c-icon--md">
                    <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#search') }}"></use>
                </svg>
            </div> --}}
        </div>
    </div>
</section>
