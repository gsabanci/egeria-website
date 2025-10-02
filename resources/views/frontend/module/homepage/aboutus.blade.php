<!-- about us section -->
<div id="hakkimizda" class="c-section c-section--md-top">
    <div class="container">
        <div class="row d-flex align-items-stretch">

            <div class="col-12 col-lg-6 p-0 d-flex" style="
          background-image: url('{{ asset('/storage/setting_images/' . $aboutus->image) }}');
          background-size: cover;
          background-position: center;
          border-radius: 0.4rem;
        ">
            </div>
            <div class="col-12 col-lg-6 d-flex flex-column">
                <div class="flex-fill u-pd-t-30 pl-lg-2">
                    <h3 class="c-title__heading">{{ $aboutus->title }}</h3>
                    <p class="c-title__desc u-pd-lg-r-20 u-pd-xl-r-120">
                        {!! $aboutus->text !!}
                    </p>
                </div>
                <!-- <div class="row u-pd-t-60 u-pd-b-30">
                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                        <div class="c-title">
                            <div class="c-title__heading c-title__heading--no-mg">
                                <h5>Hesap yöneticilerimiz ile iletişime geçin</h5>
                            </div>
                        </div>
                        <form action="" method="POST">
                            @csrf
                            <select class="js-state-select c-select2--outline" onchange="this.form.submit()" name="office_guid" style="width: 170px;">
                                <option value="all">Tüm Ofisler</option>
                                @foreach ($offices as $o)
<option {{ $o_guid == $o->office_guid ? 'selected' : '' }} value="{{ $o->office_guid }}">{{ $o->title }}
                                </option>
@endforeach
                            </select>
                        </form>
                    </div>
                </div>
                <div class="row">
                    @include('frontend.module.global.staffs')
                </div> -->
            </div>
            <div class="col-md-12 u-pd-t-40">
                <div class="row">
                    @foreach ($aboutus_cards as $ac)
                        <div class="col-lg-3 col-md-6 u-mg-t-40">
                            <div class="c-iconCard__item">
                                <div class="c-iconCard__svg">
                                    <svg class="c-icon__svg c-icon--xl">
                                        <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#about-1') }}">
                                        </use>
                                    </svg>
                                </div>
                                <div class="c-iconCard__content">
                                    <div class="c-iconCard__content-title">{{ $ac->title }}</div>
                                    <div class="c-iconCard__content-desc">
                                        {{ $ac->content }}
                                    </div>
                                    <div class="c-iconCard__content-action">
                                        <a href="{{ !is_null($ac->link) ? url($ac->link) : 'javascript:;' }}"
                                            class="c-button c-button--elevate-purple c-button--xs c-button--xs-w">{{ optional($static_texts->get('daha-fazla-metin'))->value }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>