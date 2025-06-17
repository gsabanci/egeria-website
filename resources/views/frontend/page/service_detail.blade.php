@extends('frontend.layouts.master')
@section('title', $page_title)

@section('content')
    @include('frontend.module.services.title')
    <!-- main content -->
    {{-- <section class="c-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="c-giant-card c-giant-card--vertical">
                        <h3 class="c-giant-card__title">
                            {{ $service_detail->second_title }}
                        </h3>
                        <div class="c-giant-card__content">
                            <div class="c-giant-card__content-inner">
                                {!! $service_detail->second_title_subtitle !!}
                            </div>
                            @include('frontend.module.global.staffs')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section> --}}

    <section class="c-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="c-giant-card">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="c-giant-card__title">
                                    {{ $service_detail->second_title }}
                                </h3>
                                <div class="c-giant-card__content">
                                    {!! $service_detail->second_title_subtitle !!}
                                </div>
                            </div>
                            <div class="col-lg-5 offset-lg-1">
                                <img class="c-giant-card__img c-giant-card__img--narrow"
                                    src="{{ asset('/storage/industry_photos/' . $service_detail->image) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- title -->
    <section class="c-section c-section--no-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="c-title">
                        <h3 class="c-title__heading c-title__heading--no-mg">
                            {{ $service_detail->content_area_title }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- vertical tab section -->
    @if (count($service_detail->content) > 0)
        <section class="c-section c-section--sm-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="c-vertical-tab">
                            <div class="nav flex-column c-vertical-tab__pill-wrapper" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                @foreach ($service_detail->content as $key => $c)
                                    <a class="nav-link c-vertical-tab__pill {{ $key == 0 ? 'active' : '' }} "
                                        id="pills-security-tab" data-toggle="pill" href="#pills_{{ $c->content_guid }}"
                                        role="tab" aria-controls="pills-security"
                                        aria-selected="true">{{ $c->content_title }}</a>
                                @endforeach
                            </div>

                            <div class="tab-content c-vertical-tab__content-wrapper" id="v-pills-tabContent">
                                @foreach ($service_detail->content as $key => $cc)
                                    <div class="tab-pane c-vertical-tab__content fade {{ $key == 0 ? 'show active' : '' }} "
                                        id="pills_{{ $cc->content_guid }}" role="tabpanel"
                                        aria-labelledby="pills-security-tab">
                                        <div class="c-vertical-tab__content-inner">
                                            {!! $cc->content !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- slider section -->
    <section class="c-section">
        <div class="container">
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
                                            <img src="{{ asset('frontend/assets/images/' . $i->icon . '.svg') }}"
                                                alt="">
                                        </div>
                                        <div class="c-service-card__body">
                                            <div class="c-service-card__title">
                                                {{ $i->name }}
                                            </div>
                                            <div class="c-service-card__desc">
                                                {{ $i->first_title_subtitle }}
                                            </div>
                                            <div class="c-service-card__link"
                                                style="position: relative;
															z-index: 99;"
                                                href="{{ route('industry_detail', ['slug' => $i->slug]) }}">
                                                <a class="c-button c-button--transparent"
                                                    href="{{ route('industry_detail', ['slug' => $i->slug]) }}">Daha
                                                    fazla
                                                    bilgi alın</a>
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
@endsection
