<div id="cookieConsentRoot">
    <div id="cookieBanner" class="cookie-consent__banner" hidden>
        <div class="cookie-consent__banner-content">
            <div class="cookie-consent__banner-text">
                {!! optional($static_texts->get('cerez-banner-metni'))->value !!}
            </div>
            <div class="cookie-consent__banner-actions">
                  <button type="button" class="cookie-consent__btn cookie-consent__btn--primary"
                    data-cookie-action="accept-all">
                    {!! optional($static_texts->get('tumunu-kabul-et'))->value !!}
                </button>
                <button type="button" class="cookie-consent__btn cookie-consent__btn--secondary" data-toggle="modal"
                    data-target="#cookiePreferencesModal">
                    {!! optional($static_texts->get('tercihleri-yonet'))->value !!}
                </button>
                   <button type="button" class="cookie-consent__btn cookie-consent__btn--ghost"
                    data-cookie-action="reject-all">
                    {!! optional($static_texts->get('reddet'))->value !!}
                </button>
              
            </div>
        </div>
    </div>

    <div class="modal fade" id="cookiePreferencesModal" tabindex="-1" role="dialog"
        aria-labelledby="cookiePreferencesTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content cookie-consent__panel">

                <div class="modal-header">
                    <h5 class="modal-title" id="cookiePreferencesTitle">
                        {!! optional($static_texts->get('cerez-ayarlarını-yonet'))->value !!}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body cookie-consent__panel-body">
                  {!! optional($static_texts->get('cerez-tercih-aciklama'))->value !!}
                    <div class="cookie-consent__rows">
                        <div class="cookie-consent__accordion-item is-open">
                            <div class="cookie-consent__row cookie-consent__row--head">
                                <span class="cookie-consent__row-left">
                                    <h5>{!! optional($static_texts->get('zorunlu-cerezler'))->value !!}</h5>
                                </span>
                                <span class="cookie-consent__row-status">{!! optional($static_texts->get('her-zaman-etkin'))</span>
                            </div>
                            <div class="cookie-consent__row-content">
                             {!! optional($static_texts->get('zorunlu-cerezler-aciklama'))->value !!}
                            </div>
                        </div>

                        <div class="cookie-consent__accordion-item is-open">
                            <div class="cookie-consent__row cookie-consent__row-title">
                                <span class="cookie-consent__row-left">
                                    <h5>{!! optional($static_texts->get('fonksiyonel-cerezler'))->value !!}</h5>
                                </span>
                                <label class="cookie-consent__switch-wrap" onclick="event.stopPropagation()">
                                    <input id="cookieFunctionalToggle" class="cookie-consent__switch" type="checkbox">
                                    <span class="cookie-consent__switch-slider"></span>
                                </label>
                            </div>
                            <div class="cookie-consent__row-content">
                              {!! optional($static_texts->get('fonksiyonel-cerezler-aciklama'))->value !!}
                            </div>
                        </div>

                        <div class="cookie-consent__accordion-item is-open">
                            <div class="cookie-consent__row cookie-consent__row--head">
                                <span class="cookie-consent__row-left">
                                    <h5>{!! optional($static_texts->get('analitik-cerezler'))->value !!}</h5>
                                </span>
                                <label class="cookie-consent__switch-wrap" onclick="event.stopPropagation()">
                                    <input id="cookieAnalyticsToggle" class="cookie-consent__switch" type="checkbox">
                                    <span class="cookie-consent__switch-slider"></span>
                                </label>
                            </div>
                            <div class="cookie-consent__row-content">
                            {!! optional($static_texts->get('analitik-cerezler-aciklama'))->value !!}
                            </div>
                        </div>

                        <div class="cookie-consent__accordion-item is-open">
                            <div class="cookie-consent__row cookie-consent__row--head">
                                <span class="cookie-consent__row-left">
                                    <h5>{!! optional($static_texts->get('pazarlama-cerezleri'))->value !!}</h5>
                                </span>
                                <label class="cookie-consent__switch-wrap" onclick="event.stopPropagation()">
                                    <input id="cookieMarketingToggle" class="cookie-consent__switch" type="checkbox">
                                    <span class="cookie-consent__switch-slider"></span>
                                </label>
                            </div>
                            <div class="cookie-consent__row-content">
                            {!! optional($static_texts->get('pazarlama-cerezleri-aciklama'))->value !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer cookie-consent__panel-actions">
                    <button type="button" class="cookie-consent__btn cookie-consent__btn--ghost"
                        data-cookie-action="reject-all">
                        {!! optional($static_texts->get('reddet'))->value !!}
                    </button>
                    <button type="button" class="cookie-consent__btn cookie-consent__btn--primary"
                        data-cookie-action="save-preferences">
                        {!! optional($static_texts->get('tercihlerimi-kaydet'))->value !!}
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>