<!-- jumbotron section -->
<link rel="preload" href="/frontend/assets/images/Backgroundfinal.png" as="image">

<div class="c-section c-section--jumbotron jarallax">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="c-title c-title--p-r-20">
                    <h2 class="c-title__heading c-title__heading--white c-title__heading--mb-medium">
                        {{ $giris_banner->text }}
                    </h2>
                    @if (!is_null($giris_banner_subdesc->text))
                        <p class="c-title__desc u-pd-lg-r-20 u-pd-xl-r-120 mb-4 text-white">
                            {{ $giris_banner_subdesc->text }}
                        </p>
                    @endif
                </div>
                @if (!is_null($giris_banner_link->text))
                    <h4
                        class="c-title__heading c-title__heading--font-medium c-title__heading--no-mg c-title__heading--white">
                        {{ optional($static_texts->get('detay-metin'))->value }} <a href="{{ $giris_banner_link->text }}" target="_blank"
                            style="text-decoration: underline !important; color: var(--color-green)"> {{ optional($static_texts->get('detay-link'))->value }}</a>
                    </h4>
                @else
                    <h4
                        class="c-title__heading c-title__heading--font-medium c-title__heading--no-mg c-title__heading--white">
                         {{ optional($static_texts->get('detay-metin'))->value }} <a href="#hakkimizda"
                            style="text-decoration: underline !important; color: var(--color-green)">{{ optional($static_texts->get('detay-link'))->value }}</a>
                    </h4>
                @endif
            </div>
        </div>
    </div>
</div>
