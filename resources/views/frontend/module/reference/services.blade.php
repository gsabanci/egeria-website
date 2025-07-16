<!-- services section -->
<section class="c-section">
    <div class="container">
        <div class="row u-mg-b-30 u-mg-lg-b-0">
            <div class="col-md-12 col-lg-7">
                <div class="c-title">
                    <h3 class="c-title__heading c-title__heading--gray">
                       {{ $giris_banner_subdesc->text }}
                    </h3>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-1 d-none d-sm-flex align-items-center justify-content-center">
                <div class="c-slider--services__prevBtn">
                    <img src="{{ asset('frontend/assets/images/slider-prev.svg') }}" alt="">
                </div>
            </div>
            <div class="col-12 col-sm-10">
                <div class="owl-carousel owl-theme c-slider--services">
                    @foreach ($all_industries as $i)
                    <div class="item c-slider--services__item">
                        <div class="c-service-card__wrapper">
                            <div class="c-service-card">
                                <div class="c-service-card__head">
                                    <img src="{{ asset('frontend/assets/images/'. $i->icon.'.svg' ) }}" alt="">
                                </div>
                                <div class="c-service-card__body">
                                    <div class="c-service-card__title">
                                        {{ $i->name}}
                                    </div>
                                    <div class="c-service-card__desc">
                                        {{$i->first_title_subtitle}}
                                    </div>
                                    <div class="c-service-card__link" style="position: relative;
                                    z-index: 99;" href="{{ route('industry_detail',['slug'=>$i->slug]) }}">
                                        <a class="c-button c-button--transparent" href="{{ route('industry_detail',['slug'=>$i->slug]) }}">{{ optional($static_texts->get('bilgi-metni'))->value }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-1 d-none d-sm-flex align-items-center justify-content-center">
                <div class="c-slider--services__nextBtn">
                    <img src="{{ asset('frontend/assets/images/slider-next.svg') }}" alt="">

                </div>

            </div>
        </div>
    </div>
</section>