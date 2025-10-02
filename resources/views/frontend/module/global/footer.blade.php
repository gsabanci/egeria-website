<!-- footer -->
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="c-newsletter">
                <div class="c-newsletter__title">
                    {{ optional($static_texts->get('e-bulten'))->value }}
                </div>
                <form action="{{ route('subscription') }}" method="POST" class="c-newsletter__form">
                    @csrf
                    <div class="c-newsletter__form-inputs">
                        <input class="c-input c-input--lg-w" name="email" type="email"
                            placeholder={{ optional($static_texts->get('e-posta'))->value }}>
                        <div>
                            <button class="c-button c-button--white c-button--only-icon"
                                aria-label={{ optional($static_texts->get('e-bulten'))->value }}>
                                <svg class="c-icon__svg c-icon--xs">
                                    <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#chevron-right') }}">
                                    </use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="c-footer">
    <div class="container">
        <div class="c-footer__row">
            <div class="c-footer__col c-footer__col--15">
                <div class="c-footer__logos">
                    <div>
                        <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="Egeria" aria-label="Egeria">
                    </div>
                    <div>
                        <img src="{{ asset('frontend/assets/images/ifs_icon.png') }}" alt="IFS" aria-label="IFS">
                    </div>
                </div>

            </div>
        </div>
        <div class="c-footer__row">
            <div class="c-footer__col">
                <div class="c-footer__title">
                    {{ optional($static_texts->get('cozumler'))->value }}
                </div>
                <ul class="c-footer__list">
                    @foreach ($all_services as $srvc)
                        <li class="c-footer__list-item">
                            <a href="{{ route('service_detail', ['slug' => $srvc->slug]) }}">
                                {{ $srvc->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="c-footer__col">
                <div class="c-footer__title">
                    {{ optional($static_texts->get('sektorler'))->value }}
                </div>
                <ul class="c-footer__list">
                    @foreach ($all_industries as $industry)
                        <li class="c-footer__list-item">
                            <a href="{{ route('industry_detail', ['slug' => $industry->slug]) }}">
                                {{ $industry->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="c-footer__col">
                <div class="c-footer__title">
                    {{ optional($static_texts->get('hizmetler'))->value }}
                </div>
                <ul class="c-footer__list">
                    @foreach ($labors as $l)
                        <li class="c-footer__list-item">
                            <a href="{{ route('labor_detail', $l->slug) }}">
                                {{ $l->title }}
                            </a>
                        </li>
                    @endforeach
                    <li class="c-footer__list-item">
                        <a href="{{ route('faqs') }}">
                           {{ optional($static_texts->get('sss'))->value }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
