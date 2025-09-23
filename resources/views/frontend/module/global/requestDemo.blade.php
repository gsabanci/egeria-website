@php
    $raw = optional($static_texts->get('gizlilik-metni'))->value ?? '';
    $usedSlugs = [];

    $rendered = preg_replace_callback('/\[\[([a-z0-9\-]+)\]\]/i', function ($m) use ($policies, &$usedSlugs) {
        $slug = $m[1];
        $p = $policies instanceof \Illuminate\Support\Collection ? $policies->get($slug) : ($policies[$slug] ?? null);
        if (!$p)
            return e($slug);
        $usedSlugs[] = $slug;
        $title = e($p->title ?? $slug);
        return '<span style="cursor: pointer; text-decoration: underline" role="button" tabindex="0" data-toggle="modal" data-target="#' .  $slug . '-modal">' . $title . '</span>';
    }, $raw);

    $usedSlugs = array_values(array_unique($usedSlugs));
@endphp
@foreach ($usedSlugs as $slug)
    @php
        $p = $policies instanceof \Illuminate\Support\Collection ? $policies->get($slug) : ($policies[$slug] ?? null);
    @endphp
    @if ($p)
        <div class="modal fade" id="{{ $slug }}-modal" tabindex="-1" role="dialog" aria-labelledby="{{ $slug }}-label"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" style="display:block" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="{{ $slug }}-label" class="c-title__heading c-title__heading--medium m-2">
                            {{ $p->title ?? ucfirst(str_replace('-', ' ', $slug)) }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body c-modal__body m-3">
                        <div class="policy-content-reset">
                            {!! $p->content !!}
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
<div class="modal fade" id="modalComponent" tabindex="-1" role="dialog" aria-labelledby="modalComponent"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl c-modal" role="document">
        <div class="modal-content c-modal__content">
            <div class="modal-header c-modal__header">
                <div class="c-modal__close" data-dismiss="modal" aria-label="Close">
                    <svg class="c-icon__svg c-icon--sm">
                        <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#close') }}"></use>
                    </svg>
                    <span>{{ optional($static_texts->get('kapat'))->value }}</span>
                </div>
            </div>
            <div class="modal-body c-modal__body">
                <div class="row">
                    <div class="col-lg-6">
                        <div id="recap">
                            <div class="c-title">
                                <h4 class="c-title__heading c-title__heading--medium">
                                    {{ optional($static_texts->get('demo-talep-et'))->value }}
                                </h4>
                            </div>
                            <div class="alert alert-success" role="alert" v-if="hasAlert && alertType == 'success'">
                                @{{ alertMsg }}
                            </div>
                            <div class="alert alert-danger" role="alert" v-if="hasAlert && alertType == 'error'">
                                @{{ alertMsg }}
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="c-input__label"
                                        for="inputName">{{ optional($static_texts->get('isim'))->value }}</label>
                                    <input type="text" class="form-control c-input" name="name" id="inputName"
                                        @keyup="setName($event)" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="c-input__label"
                                        for="inputLastname">{{ optional($static_texts->get('soyisim'))->value }}</label>
                                    <input type="text" class="form-control c-input" name="surname" id="inputLastname"
                                        @keyup="setSurname($event)" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="c-input__label"
                                    for="inputPhone">{{ optional($static_texts->get('telefon'))->value }}</label>
                                <input type="tel" class="form-control c-input phone" maxlength="19" name="phone"
                                    @keyup="setPhone($event)" required>
                            </div>
                            <div class="form-group">
                                <label class="c-input__label"
                                    for="inputEmail">{{ optional($static_texts->get('e-posta'))->value }}</label>
                                <input type="email" class="form-control c-input" id="inputEmail" name="email"
                                    @keyup="setMail($event)" required>
                            </div>

                            <div class="form-group">
                                <label class="c-input__label"
                                    for="inputMsg">{{ optional($static_texts->get('mesaj'))->value }}</label>
                                <textarea type="tel" class="form-control c-input c-input--textarea" id="inputMsg"
                                    name="msg" @keyup="setMsg($event)" required></textarea>
                            </div>

                            <div class="form-group  u-mg-y-20">
                                <input type="checkbox" class="c-checkbox" onclick="checkC()" id="inputChckC"
                                    @click="setCheckbox($event)" checked required>
                                <label class="c-input__label" for="inputChckC">
                                    {!! $rendered !!}
                                </label>
                            </div>
                            <div class="form-group u-mg-b-20">
                                <input type="hidden" id="recapVal" @click="setRecaptcha($event)" value="error">
                                <div class="g-recaptcha mbl" data-expired-callback="demoCaptchaCallback"
                                    data-callback="demoCaptchaCallback" id="demoReq"></div>
                            </div>
                            <button type="button" id="sendFormC"
                                class="c-button c-button--elevate-primary c-button--sm-w c-button--sm demoReqButton"
                                @click="submitRequestForm()">
                                {{ optional($static_texts->get('formu-gonder'))->value }}
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="c-modal__right">
                            <img class="lazyload" data-src="{{ asset('frontend/assets/images/about-us-img.png') }}"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>