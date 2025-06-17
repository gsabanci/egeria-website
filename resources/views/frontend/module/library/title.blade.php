<!-- title -->
<section class="c-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6 offset-lg-1 offset-md-0 u-mg-b-30 u-mg-md-b-0">
                <div class="c-breadcrumb">
                    <div class="c-breadcrumb__item">
                        <a href="/">Egeria</a> <span>/</span>
                    </div>
                    <div class="c-breadcrumb__item c-breadcrumb__item--last">
                        <a href="{{ route('libraries') }}">{{ $kutuphane_detay_baslik->text }}</a>
                    </div>
                </div>
                <div class="c title">
                    <h2 class="c-title__heading">
                        {{ isset($libs_cat_title) ? $libs_cat_title : $kutuphane_detay_baslik->text }}</h2>
                    <p class="c-title__desc">{{ $kutuphane_detay_alt_baslik->text }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
