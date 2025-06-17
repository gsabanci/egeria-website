<!-- filter section -->
<section class="c-section c-section--sm-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="c-filter">
                    <div class="c-filter__head">
                        <h4 class="c-filter__title">
                            Kategoriler
                        </h4>
                    </div>
                    <div class="c-filter__buttons">
                        <div class="owl-carousel owl-theme c-slider--filter ">
                            <div class="item">
                                <a href="{{ route('news') }}"
                                    class="c-button c-button--white-bordered c-button-sm-w c-button--block ">Tüm
                                    Haberler</a>
                            </div>
                            @foreach ($news_categories as $nc)
                                <div class="item">
                                    <a href="{{ route('news_category', ['slug' => $nc->slug]) }}"
                                        class="c-button c-button--white-bordered c-button-sm-w c-button--block {{ !is_null($nc_guid) && $nc_guid == $nc->nc_guid ? 'is-active' : '' }}">
                                        {{ $nc->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
