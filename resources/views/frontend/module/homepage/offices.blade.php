<!-- our offices section -->
<section class="c-section c-section--lg c-section--refs">
    <div class="container">
        <div class="row u-mg-b-50">
            <div class="col-12 col-sm-7 col-lg-5 col-xl-4 u-mg-b-15 u-mg-sm-b-15 u-mg-xl-b-0">
                <div class="c-title">
                    <h3 class="c-title__heading c-title__heading--medium">
                        {{ $ofis_baslik->text }}
                    </h3>
                    <p class="c-title__desc">
                        {{ $ofis_alt_baslik->text }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($offices as $o)
            <div class="col-10 col-md-6 col-lg-6 col-xl-3 offset-1 offset-md-0 u-mg-b-15 u-mg-sm-b-15 u-mg-xl-b-0">
                <div class="c-office-card c-office-card--white">
                    <div class="c-office-card__body">
                        <div class="c-office-card__title">
                            {{ $o->title }}
                        </div>
                        <div class="c-office-card__desc">
                            {{ $o->address }}
                        </div>
                        <div class="c-office-card__desc">
                            {{ $o->city->name }}
                        </div>
                    </div>
                    <div class="c-office-card__footer">
                        @if ($o->phone)
                        <div class="c-office-card__line">
                            <svg class="c-icon__svg c-icon--sm">
                                <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#phone') }}"></use>
                            </svg>
                            <a href="tel:+90{{ $o->phone }}">{{ $o->phone }}</a>
                        </div>
                        @endif
                        @if ($o->email)
                        <div class="c-office-card__line">
                            <svg class="c-icon__svg c-icon--sm">
                                <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#mail') }}"></use>
                            </svg>
                            <a href="mailto:{{ $o->email }}">{{ $o->email }}</a>
                        </div>
                        @endif
                        @if ($o->latitude && $o->longitude)
                        <div class="c-office-card__line">
                            <svg class="c-icon__svg c-icon--sm">
                                <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#location') }}"></use>
                            </svg>
                            <a href="">Yol tarifi al</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>  
            @endforeach
        </div>
    </div>
</section>
