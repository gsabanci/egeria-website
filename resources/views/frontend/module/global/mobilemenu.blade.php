<!-- mobile menu -->
<div class="c-mobile-menu">
    <div class="c-mobile-menu__overlay"></div>
    <div class="container">
        <div class="row" style="position: relative;">
            <div class="c-mobile-menu__header d-none">
                <svg class="c-icon__svg c-icon--xs">
                    <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#chevron-left') }}"></use>
                </svg>
                <span>Back</span>
            </div>
            <ul class="c-mobile-menu__list--main c-mobile-menu__list">
                <li class="c-mobile-menu__list-item">
                    <span>Çözümler</span>
                    <ul class="c-mobile-menu__list-item-sub">
                        @foreach ($all_services as $s)
                            <a href="{{ route('service_detail', ['slug' => $s->slug]) }}">
                                <li>{{ $s->name }}</li>
                            </a>
                        @endforeach
                    </ul>
                </li>
                <li class="c-mobile-menu__list-item">
                    <span>Sektörler</span>
                    <ul class="c-mobile-menu__list-item-sub">
                        @foreach ($all_industries as $industry)
                            <a href="{{ route('industry_detail', ['slug' => $industry->slug]) }}">
                                <li>{{ $industry->name }}</li>
                            </a>
                        @endforeach


                    </ul>
                </li>
                <li class="c-mobile-menu__list-item">
                    <span>Haberler</span>
                    <ul class="c-mobile-menu__list-item-sub">
                        <a href="{{ route('news') }}">Tüm Haberler</a>
                        @foreach ($all_news_categories as $nc)
                            <a href="{{ route('news_category', ['slug' => $nc->slug]) }}">
                                <li>{{ $nc->name }}</li>
                            </a>
                        @endforeach


                    </ul>
                </li>
                <li class="c-mobile-menu__list-item">
                    <a href="{{ route('references') }}">
                        <span>Müşteriler</span>
                    </a>
                </li>
                <li class="c-mobile-menu__list-item">
                    <span>Kariyer</span>
                    <ul class="c-mobile-menu__list-item-sub">
                        @foreach ($all_job_categories as $jc)
                            <a href="{{ route('filter', ['slug' => $jc->slug]) }}">
                                <li>{{ $jc->name }}</li>
                            </a>
                        @endforeach
                    </ul>
                </li>
                <li class="c-mobile-menu__list-item">
                    <span>Kütüphane</span>
                    <ul class="c-mobile-menu__list-item-sub">
                        @foreach ($all_lib_cats as $lc)
                            <a href="{{ route('lib_category', ['slug' => $lc->slug]) }}">
                                <li>{{ $lc->title }}</li>
                            </a>
                        @endforeach
                    </ul>
                </li>
                <li class="c-mobile-menu__list-item">
                    <a href="{{ route('contact') }}">
                        <span>Bize Ulaşın</span>
                    </a>
                </li>
                <li class="c-mobile-menu__list-item">
                    <a href="">
                        <img width="140px" src="{{ asset('frontend/assets/images/ifs_icon.svg') }}" alt="" />
                    </a>
                </li>
            </ul>
        </div>

    </div>

</div>
