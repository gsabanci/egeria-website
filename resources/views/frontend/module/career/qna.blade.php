<!-- qa section -->
<section class="c-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="c-title">
                    <h3 class="c-title__heading">
                        Sorular ve Cevaplar
                    </h3>
                </div>
                <!-- accordion component -->
                <div class="c-accordion">
                    @foreach ($faq as $key => $f)
                    <div class="c-accordion__row js-accordion-btn {{ $key==0?'is-active':'' }} ">
                        < href="javascript:void(0)" {{ $key==0?'is-active':'' }} >
                            <p class="c-accordion__row-title">{{ $f->title }}</p>
                            <svg class="c-icon__svg c-icon--xs">
                                <use xlink:href="../assets/images/sprite.svg#chevron-down"></use>
                            </svg>
                        </a>
                        <div class="c-accordion__content js-accordion-content" style="display: block;">
                           {{ $f->description }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>