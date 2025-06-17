<!-- news section -->
<section class="c-section c-section--lg">
    <div class="container">
        <div class="row u-mg-b-50">
            <div class="col-12 col-sm-7 col-lg-5 col-xl-4">
                <div class="c-title">
                    <h3 class="c-title__heading c-title__heading--medium">
                        {{ $haberler_baslik->text }}
                    </h3>
                    <p class="c-title__desc">
                        {{ $haberler_alt_baslik->text }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($news as $n)
            <div class="col-12 col-md-6 col-xl-4 u-mg-b-15 u-mg-sm-b-30">
                <div class="c-news-card">
                    <div class="c-news-card__head">
                        @if ($n->coverimage==null)
                        <img class="lazyload" data-src="{{ asset('/storage/news_photos/logo.png') }}" alt="{{$n->title}}">
                        @else
                        <img class="lazyload" data-src="{{ asset('/storage/news_photos/'.$n->coverimage) }}" alt="{{$n->title}}">
                        @endif
                    </div>
                    <div class="c-news-card__body">
                        {{-- <div class="c-badge__wrapper">
                            <div class="c-badge">IFS</div>
                            <div class="c-badge">CRM</div>
                            <div class="c-badge">ERP</div>
                            <div class="c-badge">Üretim</div>
                        </div> --}}
                        <a class="c-news-card__content" href="{{ route('news_detail',$n->slug) }}" aria-label="{{$n->title}}">
                            <div class="c-news-card__title">
                               {{$n->title}}
                            </div>
                            <div class="c-news-card__desc">
                                {{$n->short_desc}}
                            </div>
                        </a>
                        <div class="c-news-card__date">
                            {{ date('d F Y',strtotime($n->created_at)) }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>