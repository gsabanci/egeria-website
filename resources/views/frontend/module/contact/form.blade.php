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
        return '<span style="cursor: pointer; text-decoration: underline" class="c-policy-link" role="button" tabindex="0" data-toggle="modal" data-target="#modal_' . e($slug) . '">' . $title . '</span>';
    }, $raw);

    $usedSlugs = array_values(array_unique($usedSlugs));
@endphp
@foreach ($usedSlugs as $slug)
    @php
        $p = $policies instanceof \Illuminate\Support\Collection ? $policies->get($slug) : ($policies[$slug] ?? null);
    @endphp
    @if ($p)
        <div class="modal fade" id="modal_{{ $slug }}" tabindex="-1" role="dialog" aria-labelledby="{{ $slug }}-label"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
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
            <label class="c-input__label"
                for="inputLastname">{{ optional($static_texts->get('soyisim'))->value }}</label>
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
        <textarea type="tel" class="form-control c-input c-input--textarea" id="inputMsg" name="msg"
            required></textarea>
    </div>
    <div class="form-group mb-0 u-mg-y-20">
        <input type="checkbox" class="c-checkbox" onclick="check()" id="inputChck" checked required>
        <label class="c-input__label" for="inputChck">
            {!! $rendered !!}
        </label>
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