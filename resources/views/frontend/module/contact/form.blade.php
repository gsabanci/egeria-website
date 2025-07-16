<form action="{{ route('send_form') }}" method="POST" id="contactform">
    @csrf
    <div class="c-title">
        <h3 class="c-title__heading c-title__heading--medium">
            {{ optional($static_texts->get('iletisim-formu'))->value }}
        </h3>

        @if ($errors->any())
            @php
                $err = null;
                $msg = [];
                foreach ($errors->all() as $error) {
                    $msg[] = $error;
                }
                $err = implode(', ', $msg);
            @endphp
            <div class="alert alert-danger" role="alert">
                {{ $err }}
            </div>
        @endif
    </div>
    <div class="form-row">
        <div class="form-group col-md-6 mb-0">
            <label class="c-input__label" for="inputName">{{ optional($static_texts->get('isim'))->value }}</label>
            <input type="text" class="form-control c-input" name="name" id="inputName" required>
        </div>
        <div class="form-group col-md-6 mb-0">
            <label class="c-input__label" for="inputLastname">{{ optional($static_texts->get('soyisim'))->value }}</label>
            <input type="text" class="form-control c-input" name="surname" id="inputLastname" required>
        </div>
    </div>
    <div class="form-group mb-0">
        <label class="c-input__label" for="inputPhone">{{ optional($static_texts->get('telefon'))->value }}</label>
        <input type="tel" class="form-control c-input phone" maxlength="19" name="phone" required>
    </div>
    <div class="form-group mb-0">
        <label class="c-input__label" for="inputEmail">{{ optional($static_texts->get('e-posta'))->value }}</label>
        <input type="email" class="form-control c-input" id="inputEmail" name="email" required>
    </div>
    <div class="form-row">
        <div class="form-group mb-0 col-md-12">
            <label class="c-input__label" for="inputCompany">{{ optional($static_texts->get('sirket'))->value }}</label>
            <input type="text" class="form-control c-input" id="inputCompany" name="company_name">
        </div>
    </div>
    <div class="form-group mb-0">
        <label class="c-input__label" for="inputMsg">{{ optional($static_texts->get('mesaj'))->value }}</label>
        <textarea type="tel" class="form-control c-input c-input--textarea" id="inputMsg" name="msg" required></textarea>
    </div>
    <div class="form-group mb-0 u-mg-y-20">
        <input type="checkbox" class="c-checkbox" onclick="check()" id="inputChck" checked required>
        <label class="c-input__label" for="inputChck">
            <!-- <span style="cursor: pointer; text-decoration: underline" data-toggle="modal"
                data-target="#gizlilik-sozlesmesi-modal">Gizlilik Sözleşmesini</span> ve -->
            <span style="cursor: pointer; text-decoration: underline" data-toggle="modal"
                data-target="#kvkk-aydinlatma-metni-modal">{{ $gizlilik_onayi->text }}</span>
           
        </label>
        <!-- >Gizlilik Sözleşmesi</a> -->
    </div>
    <div class="form-group mb-0 u-mg-b-20">
        <div id="contactCaptcha" data-expired-callback="contactCaptchaCallback" data-callback="contactCaptchaCallback"
            class="g-recaptcha"></div>
    </div>
    <button type="button" id="sendForm"
        class="c-button c-button--elevate-primary c-button--sm-w c-button--sm contactButton">
        {{ optional($static_texts->get('formu-gonder'))->value }}
    </button>
</form>

@section('js')
    <script src="{{ asset('frontend/scripts/general/input-mask.min.js') }}"></script>
    <script src="{{ asset('frontend/scripts/general/jquery-input-mask-phone-number.min.js') }}"></script>
    <script>
        var checkBtn = document.getElementById("inputChck");
        var sendForm = document.getElementById("sendForm");

        function check() {
            if (checkBtn.checked == false) {
                $('#sendForm').attr("disabled", "disabled");
            } else if (checkBtn.checked != false) {
                $('#sendForm').removeAttr("disabled", "");
            }
        }
    </script>
@endsection
