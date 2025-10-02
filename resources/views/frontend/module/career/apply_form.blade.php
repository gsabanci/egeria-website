<!-- title -->
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
                         {{ $p->title ?? ucfirst(str_replace('-', ' ', $slug)) }}</h4>
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
<section class="c-section ">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="c-breadcrumb">
                    <div class="c-breadcrumb__item">
                        <a href="/">Egeria</a> <span>/</span>
                    </div>
                    <div class="c-breadcrumb__item">
                        <a href="/kariyer">{{ optional($static_texts->get('kariyer'))->value }}</a> <span>/</span>
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
                    <h3 class="c-title__heading">{{ optional($static_texts->get('basvuru-formu'))->value }}</h3>
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
                            <label class="c-input__label"
                                for="inputName">{{ optional($static_texts->get('isim'))->value }}</label>
                            <input type="text" class="form-control c-input" id="inputName" name="name" required>
                        </div>
                        <div class="form-group col-xl-6">
                            <label class="c-input__label"
                                for="inputLastname">{{ optional($static_texts->get('soyisim'))->value }}</label>
                            <input type="text" class="form-control c-input" name="surname" id="inputLastname" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xl-6">
                            <label class="c-input__label"
                                for="inputEmail">{{ optional($static_texts->get('e-posta'))->value }}</label>
                            <input type="email" class="form-control c-input" name="email" id="inputEmail" required>
                        </div>
                        <div class="form-group col-xl-6">
                            <label class="c-input__label"
                                for="inputPhone">{{ optional($static_texts->get('telefon'))->value }}</label>
                            <input type="tel" class="form-control c-input phone" name="phone" maxlength="19" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xl-12">
                            <label class="c-input__label" for="cv">Cv</label><br>
                            <input type="file" class="" id="resume" accept="application/pdf" name="cv" required>
                        </div>
                    </div>

                    <div class="form-group u-mg-y-30">
                        <input type="checkbox" class="c-checkbox" id="inputChck" checked required>
                        <label class="c-input__label" for="inputChck">
                            {!! $rendered !!}
                        </label>
                    </div>
                    <div class="form-group u-mg-b-20">
                        <div id="jobCaptcha" data-expired-callback="careerCaptchaCallback"
                            data-callback="careerCaptchaCallback" class="g-recaptcha"></div>
                    </div>
                    <button type="button"
                        class="c-button c-button--elevate-primary c-button--sm-w c-button--sm careerButton">
                        {{ optional($static_texts->get('formu-gonder'))->value }}
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