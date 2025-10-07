@extends('frontend.layouts.master')
@section('title', $page_title)

@section('content')
    <section class="c-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 offset-lg-1 offset-md-0 u-mg-b-30 u-mg-md-b-0">
                    <div class="c-breadcrumb">
                        <div class="c-breadcrumb__item">
                            <a href="/">Egeria</a> <span>/</span>
                        </div>
                        <div class="c-breadcrumb__item">
                            <a href="/kutuphane">Kütüphane</a> <span>/</span>
                        </div>
                        <div class="c-breadcrumb__item">
                            <a
                                href="{{ route('lib_category', ['slug' => $lib_detail->category->slug]) }}">{{ $lib_detail->category->title }}</a>
                        </div>
                    </div>
                    <div class="c-title">
                        <h2 class="c-title__heading text-uppercase">{{ $lib_detail->title }}</h2>
                    </div>
                </div>
            </div>
    </section>


    <section class="c-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="c-giant-card">
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="c-giant-card__content">
                                    {!! $lib_detail->long_desc !!}
                                </div>
                                <diw class="row">
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <a href="{{ asset('storage/library/file/' . $lib_detail->docname) }}"
                                            download="{{ asset('storage/library/file/' . $lib_detail->docname) }}"
                                            class="c-button c-button--primary c-button--sm-w c-button--sm mt-3">
                                            {{  strip_tags( optional($static_texts->get('dokumani-indir-metni'))->value) }}
                                        </a>
                                    </div>
                                </diw>
                            </div>
                            <div class="col-lg-5 offset-lg-1 mb-4">
                                <img class="c-giant-card__img c-giant-card__img--narrow"
                                    src="{{ asset('/storage/library/cover/' . $lib_detail->image) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- news section -->
    <section class="c-section">
        <div class="container">
            <div class="row">
                @foreach ($other_libs as $ol)
                    <div class="col-12 col-md-6 col-xl-4 u-mg-b-15 u-mg-sm-b-30">
                        <div class="c-news-card">
                            <div class="c-news-card__head">
                                <img src="{{ asset('/storage/library/cover/' . $ol->image) }}" alt="">
                            </div>
                            <div class="c-news-card__body">
                                <a class="c-news-card__content" href="{{ route('lib_detail', $ol->slug) }}">
                                    <div class="c-news-card__title">
                                        {{ $ol->title }}
                                    </div>
                                    <div class="c-news-card__desc">
                                        {{ $ol->short_desc }}
                                    </div>
                                </a>
                                <div class="c-news-card__date">
                                    {{ date('d F Y', strtotime($ol->created_at)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>


@endsection
