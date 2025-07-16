<!-- title -->
<section class="c-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-1">
                <div class="c-breadcrumb">
                    <div class="c-breadcrumb__item">
                        <a href="/">Egeria</a> <span>/</span>
                    </div>  
                    <div class="c-breadcrumb__item">
                        {{ optional($static_texts->get('sektorler'))->value }} <span>/</span> 
                    </div>  
                    <div class="c-breadcrumb__item c-breadcrumb__item--last">
                        {{ $industry_detail->name }}
                    </div>
                </div>
                <div class="c-title">
                    <h2 class="c-title__heading text-uppercase">{{ $industry_detail->first_title }}</h2>
                    <p class="c-title__desc">{!! $industry_detail->first_title_subtitle !!}
                </div>
            </div>
           
        </div>
    </div>
</section>