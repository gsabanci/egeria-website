@extends('frontend.layouts.master')
@section('title', $page_title)

@section('content')
    @include('frontend.module.corporate.title')

    <!-- main content -->
    <section class="c-section c-section--sm">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="c-giant-card">
                        <div class="row align-items-center"> {{-- START değil CENTER --}}

                            <div class="{{ !empty($corporate_detail->image) ? 'col-lg-7' : 'col-lg-12' }} mb-4 mb-lg-0">
                                <div class="c-giant-card__content">
                                    {!! $corporate_detail->content !!}
                                </div>

                                @if(!empty($corporate_detail->docname))
                                    <div class="row mt-3">
                                        <div class="col-lg-5 col-sm-7 col-12">
                                            <a href="{{ asset('storage/corporate/file/' . $corporate_detail->docname) }}"
                                                download class="c-button c-button--primary c-button--sm-w c-button--sm">
                                                {{ strip_tags(optional($static_texts->get('dokumani-indir-metni'))->value ?? 'Dokümanı İndir') }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if(!empty($corporate_detail->image))
                                <div class="col-lg-5">
                                    {{-- wrapper: her durumda ortalar --}}
                                    <div class="h-100 d-flex align-items-center justify-content-center">
                                        <img class="img-fluid"
                                            src="{{ asset('storage/corporate/cover/' . $corporate_detail->image) }}"
                                            alt="{{ $corporate_detail->title ?? 'Corporate' }}" style="border-radius:16px; box-shadow:0 18px 45px rgba(0,0,0,.10);
                                      width:100%; max-width:520px; height:320px; object-fit:cover;">
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

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
                                            <img src="{{ asset('frontend/assets/images/' . $i->icon . '.svg') }}" alt="">
                                        </div>
                                        <div class="c-service-card__body">
                                            <div class="c-service-card__title">
                                                {{ $i->name}}
                                            </div>
                                            <div class="c-service-card__desc">
                                                {{$i->first_title_subtitle}}
                                            </div>
                                            <div class="c-service-card__link" style="position: relative;
                                                                z-index: 99;"
                                                href="{{ route('industry_detail', ['slug' => $i->slug]) }}">
                                                <a class="c-button c-button--transparent"
                                                    href="{{ route('industry_detail', ['slug' => $i->slug]) }}">{{ optional($static_texts->get('bilgi-metni'))->value }}</a>
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