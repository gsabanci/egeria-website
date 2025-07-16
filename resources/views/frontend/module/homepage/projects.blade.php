<!-- projects section -->
<section class="c-section c-section--dark c-section--md">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="c-title u-mg-b-30">
                    <h4
                        class="c-title__heading c-title__heading--font-medium c-title__heading--no-mg c-title__heading--white">
                        <a href="{{ route('references') }}"
                            style="text-decoration: underline !important; color: var(--color-green)">{{ optional($static_texts->get('diger-projeler-metin'))->value }}.</a>
                    </h4>
                </div>
                <div class="owl-carousel owl-theme c-slider--projects">
                    @foreach ($references as $r)
                        <div class="item c-slider--projects__item ">
                            <img class="mainpage-refs {{ $r->bad_logo == '1' ? 'badimg' : null }} owl-lazy"
                                data-src="{{ asset('/storage/reference_images/' . $r->logo) }}" alt="{{ $r->name }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</section>