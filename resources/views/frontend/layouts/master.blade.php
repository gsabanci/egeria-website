<!DOCTYPE html>
<html lang="tr" prefix="og: https://ogp.me/ns#">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="google" content="notranslate" />
    <title>{{ isset($page_title) ? $page_title . ' - ' : null }}IFS ERP | Egeria Yazılım ve Danışmanlık</title>
    <meta name="description" content="IFS Türkiye Çözüm Ortağı" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title"
        content="{{ isset($shortlink_title) ? $shortlink_title : 'Egeria' }} - IFS ERP | Egeria Yazılım ve Danışmanlık" />
    <meta name="twitter:description"
        content="{{ isset($shortlink_subtitle) && !is_null($shortlink_subtitle) ? $shortlink_subtitle : 'IFS Türkiye Çözüm Ortağı' }}" />
    <meta name="twitter:url" content="{{ Request::url() }}" />
    <meta name="twitter:image"
        content="{{ isset($shortlink_image) ? $shortlink_image : asset('frontend/assets/images/sharelogo.jpeg') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title"
        content="{{ isset($shortlink_title) ? $shortlink_title : 'Egeria' }} - IFS ERP | Egeria Yazılım ve Danışmanlık" />
    <meta property="og:description"
        content="{{ isset($shortlink_subtitle) && !is_null($shortlink_subtitle) ? $shortlink_subtitle : 'IFS Türkiye Çözüm Ortağı' }}" />
    <meta property="og:image"
        content="{{ isset($shortlink_image) ? $shortlink_image : asset('frontend/assets/images/sharelogo.jpeg') }}" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <link rel="icon" href="{{ asset('frontend/assets/images/Egeria-Favicon.ico') }}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('frontend/assets/css/aos.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/scripts/owl-carousel/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/scripts/owl-carousel/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/scripts/bootstrap/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/scripts/toastr/toastr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets/css/slick.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets/css/slick-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets/css/index.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets/css/select2.min.css') }}" rel="stylesheet" />
    <!-- <link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick-theme.css"/> -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BT5RMVK453"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-BT5RMVK453');
    </script>
</head>

<body>

    @include('frontend.module.global.header')

    @include('frontend.module.global.mobilemenu')

    @yield('content')

    @include('frontend.module.global.footer')
    @include('frontend.module.global.copyright')


    @include('frontend.module.global.gototop')

    @include('frontend.module.global.contactModal')


    <script src="{{ asset('frontend/scripts/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/scripts/lazy-load/jquery.lazy.min.js') }}"></script>
    <script src="{{ asset('frontend/scripts/general/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/scripts/jarallax/jarallax.min.js') }}"></script>
    <script src="{{ asset('frontend/scripts/jarallax/jarallax-element.min.js') }}"></script>
    <script src="{{ asset('frontend/scripts/general/jquery-input-mask-phone-number.min.js') }}"></script>
    <script src="{{ asset('frontend/scripts/general/aos.js') }}"></script>
    <script src="{{ asset('frontend/scripts/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('frontend/scripts/general/lazysizes.min.js') }}" async></script>
    <script src="{{ asset('frontend/scripts/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/scripts/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/scripts/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/scripts/select2/select2.full.js') }}"></script>
    <script src="{{ asset('frontend/scripts/general/script.js') }}"></script>
    <script src="{{ asset('frontend/scripts/general/vue.min.js') }}"></script>
    <script src="{{ asset('frontend/scripts/general/axios.js') }}"></script>
    <script src="{{ asset('frontend/vue/reqdemo.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

    <script>
        $('.jarallax').jarallax({
            type: 'scroll',
        });
    </script>
    @section('js')
        <script>
            // mask phone
            $('#phone').usPhoneFormat({
                format: 'xxx-xxx-xxxx',
            });
        </script>
        <script>
            var checkBtnC = document.getElementById("inputChckC");
            var sendFormC = document.getElementById("sendFormC");

            function checkC() {
                if (checkBtnC.checked == false) {
                    $('#sendFormC').attr("disabled", "disabled");
                } else if (checkBtnC.checked != false) {
                    $('#sendFormC').removeAttr("disabled", "");
                }
            }
        </script>
    @endsection
    @yield('js')
    <script>
        var onloadCallback = function() {
            var cc = $('#contactCaptcha')
            if (cc.length > 0) {
                grecaptcha.render(document.getElementById('contactCaptcha'), {
                    'sitekey': '6LfYsCEdAAAAAKPoz18YAKWU9-OErQdUsitQe_xs',
                    'theme': 'light',
                });
            }
            var jc = $('#jobCaptcha')
            if (jc.length > 0) {
                grecaptcha.render(document.getElementById('jobCaptcha'), {
                    'sitekey': '6LfYsCEdAAAAAKPoz18YAKWU9-OErQdUsitQe_xs',
                    'theme': 'light'
                });
            }
            grecaptcha.render(document.getElementById('demoReq'), {
                'sitekey': '6LfYsCEdAAAAAKPoz18YAKWU9-OErQdUsitQe_xs',
                'theme': 'light'
            });
        };

        var demoCaptchaCallback = function(d) {
            if (d == undefined) {
                $('#recapVal').val("error").click();
            } else if (d.length != 0) {
                $('#recapVal').val("success").click();
            } else {
                $('#recapVal').val("error").click();
            }
        }

        var contactCaptchaCallback = function(d) {
            if (d == undefined) {
                $('.contactButton').attr('type', 'button');
            } else if (d.length != 0) {
                $('.contactButton').attr('type', 'submit');
            } else {
                $('.contactButton').attr('type', 'button');
            }
        }

        var careerCaptchaCallback = function(d) {
            if (d == undefined) {
                $('.contactButton').attr('type', 'button');
            } else if (d.length != 0) {
                $('.careerButton').attr('type', 'submit');
            } else {
                $('.careerButton').attr('type', 'button');
            }
        }

        var successAlert = "{{ session()->has('success') ? session('success') : '' }}";
        var errorAlert = "{{ session()->has('error') ? session('error') : '' }}";

        toastr.options = {
            closeButton: true,
            newestOnTop: true,
            positionClass: "toast-bottom-full-width",
            timeOut: 10000
        }

        if (successAlert != '') {
            toastr.success(successAlert)
        }

        if (errorAlert != '') {
            toastr.error(errorAlert)
        }
    </script>
</body>

</html>
