<!-- title -->
<section class="c-section ">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="c-breadcrumb">
                    <div class="c-breadcrumb__item">
                        <a href="/">Egeria</a> <span>/</span>
                    </div>
                    <div class="c-breadcrumb__item">
                        <a href="/kariyer">Kariyer</a> <span>/</span>
                    </div>
                    <div class="c-breadcrumb__item c-breadcrumb__item--last">
                        {{ $job_detail->title }}
                    </div>
                </div>
                <div class="c-title">
                    <h2 class="c-title__heading">{{ $job_detail->title }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="c-section c-section--no-padding-top">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="c-job-card">
                    <div class="c-job-card__body c-job-card__body--detail">
                        {!! $job_detail->desc !!}
                    </div>
                </div>
            </div>
            <div class="col-md-5 u-mg-md-t-10 u-mg-t-30">
                <div class="c-title">
                    <h3 class="c-title__heading">Başvuru Formu</h3>

                </div>
                <form action="{{ route('job_apply') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="job_guid" value="{{ $job_detail->job_guid }}">

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
                    <div class="form-row">
                        <div class="form-group col-xl-6">
                            <label class="c-input__label" for="inputName">İsim</label>
                            <input type="text" class="form-control c-input" id="inputName" name="name" required>
                        </div>
                        <div class="form-group col-xl-6">
                            <label class="c-input__label" for="inputLastname">Soyisim</label>
                            <input type="text" class="form-control c-input" name="surname" id="inputLastname"
                                required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xl-6">
                            <label class="c-input__label" for="inputEmail">Eposta</label>
                            <input type="email" class="form-control c-input" name="email" id="inputEmail" required>
                        </div>
                        <div class="form-group col-xl-6">
                            <label class="c-input__label" for="inputPhone">Telefon</label>
                            <input type="tel" class="form-control c-input phone" name="phone" maxlength="19"
                                required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xl-12">
                            <label class="c-input__label" for="cv">Cv</label><br>
                            <input type="file" class="" id="resume" accept="application/pdf" name="cv"
                                required>
                        </div>
                    </div>

                    <div class="form-group u-mg-y-30">
                        <input type="checkbox" class="c-checkbox" id="inputChck" checked required>
                        <label class="c-input__label" for="inputChck">
                            @foreach ($policies as $k => $pol)
                                <span style="cursor: pointer; text-decoration: underline" data-toggle="modal"
                                    data-target="#{{ $pol->slug . '-modal' }}">{{ $pol->title }}</span>{{ $k < count($policies) ? ', ' : null }}
                            @endforeach
                            ve iletişim formu sürecine ilişkin aydınlatma metnini okudum kabul ediyorum.
                            Egeria’nın
                            sunacağı fırsat ve avantajlardan haberdar olmak amacıyla, paylaştığım iletişim
                            bilgilerinin (e-mail adresi ve telefon) pazarlama iletişimi amaçlı kullanılmasına
                            onay
                            veriyorum.(*)
                        </label>
                    </div>
                    <div class="form-group u-mg-b-20">
                        <div id="jobCaptcha" data-expired-callback="careerCaptchaCallback"
                            data-callback="careerCaptchaCallback" class="g-recaptcha"></div>
                    </div>
                    <button type="button"
                        class="c-button c-button--elevate-primary c-button--sm-w c-button--sm careerButton">
                        Formu Gönder
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- form section -->
<section class="c-section c-section--no-padding-top">
    <div class="container">
        <div class="row">

        </div>
    </div>
</section>
