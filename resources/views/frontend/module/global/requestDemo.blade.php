<div class="modal fade" id="modalComponent" tabindex="-1" role="dialog" aria-labelledby="modalComponent" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl c-modal" role="document">
      <div class="modal-content c-modal__content">
        <div class="modal-header c-modal__header">
            <div class="c-modal__close" data-dismiss="modal" aria-label="Close">
                <svg class="c-icon__svg c-icon--sm">
                    <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#close') }}"></use>
                </svg>
                <span>Kapat</span>
            </div>
        </div>
        <div class="modal-body c-modal__body">
             <div class="row">
                 <div class="col-lg-6">
                    <div id="recap">
                        <div class="c-title">
                            <h4 class="c-title__heading c-title__heading--medium">
                                Demo Talep Et
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
                                <label class="c-input__label" for="inputName">İsim</label>
                                <input type="text" class="form-control c-input" name="name" id="inputName" @keyup="setName($event)" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="c-input__label" for="inputLastname">Soyisim</label>
                                <input type="text" class="form-control c-input" name="surname" id="inputLastname" @keyup="setSurname($event)" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="c-input__label" for="inputPhone">Telefon</label>
                            <input type="tel" class="form-control c-input phone" maxlength="19" name="phone" @keyup="setPhone($event)" required>
                        </div>
                        <div class="form-group">
                            <label class="c-input__label" for="inputEmail">Eposta</label>
                            <input type="email" class="form-control c-input" id="inputEmail" name="email" @keyup="setMail($event)" required>
                        </div>
    
                        <div class="form-group">
                            <label class="c-input__label" for="inputMsg">Mesaj</label>
                            <textarea type="tel" class="form-control c-input c-input--textarea" id="inputMsg" name="msg" @keyup="setMsg($event)" required></textarea>
                        </div>
                       
                        <div class="form-group  u-mg-y-20">
                            <input type="checkbox" class="c-checkbox" onclick="checkC()" id="inputChckC" @click="setCheckbox($event)" checked required>
                            <label class="c-input__label c-input__label--small" for="inputChckC">@foreach($policies as $k => $pol)
                                <span style="cursor: pointer; text-decoration: underline" data-toggle="modal" data-target="#{{ $pol->slug.'-modal' }}">{{ $pol->title }}</span>{{ $k < count($policies) ? ', ' : null }}
                                @endforeach
                                ve iletişim formu sürecine ilişkin aydınlatma metnini okudum kabul ediyorum.
                            </label>
                        </div>
                        <div class="form-group u-mg-b-20">
                            <input type="hidden" id="recapVal" @click="setRecaptcha($event)" value="error">
                            <div class="g-recaptcha mbl" data-expired-callback="demoCaptchaCallback" data-callback="demoCaptchaCallback" id="demoReq"></div>
                        </div>
                        <button type="button" id="sendFormC" class="c-button c-button--elevate-primary c-button--sm-w c-button--sm demoReqButton" @click="submitRequestForm()">
                                Formu Gönder
                            </button>
                    </div>
                 </div>
                 <div class="col-lg-6">
                     <div class="c-modal__right">
                        <img class="lazyload" data-src="{{ asset('frontend/assets/images/about-us-img.png') }}" alt="">
                     </div>
                 </div>
             </div>
        </div>
      </div>
    </div>
</div>