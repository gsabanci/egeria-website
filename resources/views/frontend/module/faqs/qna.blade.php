<!-- qa section -->
<section class="c-section c-section--no-padding-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <!-- accordion component -->
                <div class="c-accordion">
                    @foreach ($faq as $key => $f)
                    <div class="c-accordion__row js-accordion-btn {{ $key==0?'is-active':'' }} ">
                        <a href="javascript:void(0)" class="{{ $key==0?'is-active':'' }} ">
                            <p class="c-accordion__row-title">{{ $f->title }}</p>
                            <svg class="c-icon__svg c-icon--xs">
                                <use xlink:href="../assets/images/sprite.svg#chevron-down"></use>
                            </svg>
                        </a>
                        <div class="c-accordion__content js-accordion-content" style="{{ $key==0?'display:block':'display:none' }}">
                            <div class="c-accordion__content-inner">
                            {!! $f->description !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>