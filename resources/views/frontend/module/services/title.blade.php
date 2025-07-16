<!-- title -->
<section class="c-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-11 offset-lg-1">
                <div class="c-breadcrumb">
                    <div class="c-breadcrumb__item">
                        <a href="/">Egeria</a> <span>/</span>
                    </div>  
                    <div class="c-breadcrumb__item">
                        {{ optional($static_texts->get('cozumler'))->value }} <span>/</span> 
                    </div>  
                    <div class="c-breadcrumb__item c-breadcrumb__item--last">
                        {{ $service_detail->name }}
                    </div>
                </div>
                <div class="c title">
                    <h2 class="c-title__heading text-uppercase mb-0">{{ $service_detail->first_title }}</h2>
                    <p class="c-title__desc">{!! $service_detail->first_title_subtitle !!} </p>
                </div>
            </div>
        </div>
    </div>
</section>