<!-- header  -->
<nav class="navbar navbar-expand-lg static-top l-navbar c-navbar">
    <div class="container">
        <div class="c-navbar__left">
            <a class="navbar-brand l-navbar__brand" href="{{ route('homepage') }}" aria-label="Egeria">
                <img class="l-navbar__logo" src="{{ asset('frontend/assets/images/logo.png') }}" alt="" />
            </a>
            <a class="navbar-brand l-navbar__brand l-navbar__brand--small" href="{{ route('homepage') }}"
                aria-label="ifs">
                <img class="l-navbar__icon" src="{{ asset('frontend/assets/images/ifs_icon.svg') }}" alt="" />
            </a>
            <div class="c-navbar__menu l-navbar__menu l-navbar__menu-links d-none d-lg-flex">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item c-navbar__menu-item l-navbar__menu-item l-navbar__menu-item--has-mega">
                        <a class="nav-link dropdown-toggle" href="#" id="solutions" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"> Çözümler</a>
                        <div class="dropdown-menu" aria-labelledby="solutions">
                            @foreach ($all_services as $service)
                                <a class="dropdown-item"
                                    href="{{ route('service_detail', ['slug' => $service->slug]) }}">{{ $service->name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item c-navbar__menu-item l-navbar__menu-item l-navbar__menu-item--has-mega">
                        <a class="nav-link dropdown-toggle" href="#" id="sectors" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"> Sektörler</a>
                        <div class="dropdown-menu" aria-labelledby="sectors">
                            @foreach ($all_industries as $industry)
                                <a class="dropdown-item"
                                    href="{{ route('industry_detail', ['slug' => $industry->slug]) }}">{{ $industry->name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item c-navbar__menu-item l-navbar__menu-item l-navbar__menu-item--has-mega">
                        <a class="nav-link dropdown-toggle" href="#" id="news" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"> Haberler</a>
                        <div class="dropdown-menu" aria-labelledby="news">
                            <a href="{{ route('news') }}" class="dropdown-item">Tüm Haberler</a>
                            @foreach ($all_news_categories as $nc)
                                <a class="dropdown-item"
                                    href="{{ route('news_category', ['slug' => $nc->slug]) }}">{{ $nc->name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item c-navbar__menu-item l-navbar__menu-item">
                        <a class="nav-link" href="{{ route('references') }}">Müşteriler</a>
                    </li>
                    <li class="nav-item c-navbar__menu-item l-navbar__menu-item l-navbar__menu-item--has-mega">
                        <a class="nav-link dropdown-toggle" href="#" id="sectors" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"> Kariyer</a>
                        <div class="dropdown-menu" aria-labelledby="sectors">
                            @foreach ($all_job_categories as $jc)
                                <a class="dropdown-item"
                                    href="{{ route('filter', $jc->slug) }}">{{ $jc->name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item c-navbar__menu-item l-navbar__menu-item l-navbar__menu-item--has-mega">
                        <a class="nav-link dropdown-toggle" href="#" id="sectors" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"> Kütüphane</a>
                        <div class="dropdown-menu" aria-labelledby="sectors">
                            @foreach ($all_lib_cats as $lc)
                                <a class="dropdown-item"
                                    href="{{ route('lib_category', $lc->slug) }}">{{ $lc->title }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item c-navbar__menu-item l-navbar__menu-item">
                        <a class="nav-link" href="{{ route('contact') }}">Bize Ulaşın</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="c-navbar__right">
            <a href="" class="c-button c-button--sm c-button--sm-w c-button--elevate-green" data-toggle="modal"
                data-target="#modalComponent">Demo Talep Et</a>
            <div class="l-navbar__menu-right">
                <div class="c-hamburger">
                    <div class="c-hamburger__wrapper">
                        <div class="c-hamburger__bar c-hamburger__bar--top"></div>
                        <div class="c-hamburger__bar c-hamburger__bar--middle"></div>
                        <div class="c-hamburger__bar c-hamburger__bar--bottom"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Modal -->
@include('frontend/module/global/requestDemo')
