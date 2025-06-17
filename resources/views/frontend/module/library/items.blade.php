<!-- news section -->
<section class="c-section">
    <div class="container">
        <div class="row">
            @foreach ($libs as $lib)
                <div class="col-12 col-md-6 col-xl-4 u-mg-b-15 u-mg-sm-b-30">
                    <div class="c-news-card">
                        <div class="c-news-card__head">
                            @if ($lib->image == null)
                                <img src="{{ asset('/storage/news_photos/logo.png') }}" alt="{{ $lib->title }}">
                            @else
                                <img src="{{ asset('/storage/library/cover/' . $lib->image) }}" alt="{{ $lib->title }}">
                            @endif
                        </div>
                        <div class="c-news-card__body">
                            <a class="c-news-card__content" href="{{ route('lib_detail', $lib->slug) }}">
                                <div class="c-news-card__title">
                                    {{ $lib->title }}
                                </div>
                                <div class="c-news-card__desc">
                                    {{ $lib->short_desc }}
                                </div>
                            </a>
                            <div class="c-news-card__date">
                                {{ date('d F Y', strtotime($lib->created_at)) }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
