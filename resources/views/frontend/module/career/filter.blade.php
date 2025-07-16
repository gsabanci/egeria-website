<!-- filter section -->
<section class="c-section c-section--sm-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="c-filter">
                    <div class="c-filter__head">
                        <h4 class="c-filter__title">
                            {{ optional($static_texts->get('kategoriler'))->value }}
                        </h4>
                    </div>
                    <div class="c-filter__buttons">
                        <div class="owl-carousel owl-theme c-slider--filter">
                            <div class="item">
                                <a href="{{ route('career') }}" class="c-button c-button--white-bordered c-button-sm-w c-button--block ">{{ optional($static_texts->get('tum-ilanlar'))->value }}</a>
                            </div>
                            @foreach ($job_categories as $jc)
                            <div class="item">
                                <a href="{{ route('filter',$jc->slug) }}" class="c-button c-button--white-bordered c-button-sm-w c-button--block {{ !is_null($jc_guid)&& $jc_guid==$jc->jc_guid?'is-active':'' }}">
                                    {{ $jc->name }}</a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>