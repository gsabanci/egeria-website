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
                    <span>{{ optional($static_texts->get('cozumler'))->value }}</span>
                    <ul class="c-mobile-menu__list-item-sub">
                        @foreach ($all_services as $s)
                            <a href="{{ route('service_detail', ['slug' => $s->slug]) }}">
                                <li>{{ $s->name }}</li>
                            </a>
                        @endforeach
                    </ul>
                </li>
                <li class="c-mobile-menu__list-item">
                    <span>{{ optional($static_texts->get('sektorler'))->value }}</span>
                    <ul class="c-mobile-menu__list-item-sub">
                        @foreach ($all_industries as $industry)
                            <a href="{{ route('industry_detail', ['slug' => $industry->slug]) }}">
                                <li>{{ $industry->name }}</li>
                            </a>
                        @endforeach


                    </ul>
                </li>
                <li class="c-mobile-menu__list-item">
                    <span>{{ $menuCategories['haberler'] }}</span>
                    <ul class="c-mobile-menu__list-item-sub">
                        <!-- <a href="{{ route('news') }}">Tüm Haberler</a> -->
                        @foreach ($all_news_categories as $nc)
                            <a href="{{ route('news_category', ['slug' => $nc->slug]) }}">
                                <li>{{ $nc->name }}</li>
                            </a>
                        @endforeach


                    </ul>
                </li>
                <li class="c-mobile-menu__list-item">
                    <a href="{{ route('references') }}">
                        <span>{{ $menuCategories['musteriler'] }}</span>
                    </a>
                </li>
                <li class="c-mobile-menu__list-item">
                    <span>{{ $menuCategories['kariyer'] }}</span>
                    <ul class="c-mobile-menu__list-item-sub">
                        @foreach ($all_job_categories as $jc)
                            <a href="{{ route('filter', ['slug' => $jc->slug]) }}">
                                <li>{{ $jc->name }}</li>
                            </a>
                        @endforeach
                    </ul>
                </li>
                <li class="c-mobile-menu__list-item">
                    <span>{{ $menuCategories['kutuphane'] }}</span>
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
                        <span>{{ $menuCategories['bize-ulasin'] }}</span>
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
