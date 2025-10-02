<!-- jobs section -->
<section class="c-section">
    <div class="container">
        <div class="row">
            @if(isset($jobs) && method_exists($jobs, 'isNotEmpty') && $jobs->isNotEmpty())
            <div class="col-12">
                <div class="c-title">
                    <h4 class="c-title__heading">{{ optional($static_texts->get('is-ilanlari'))->value }}</h4>
                </div>
            </div>
            @endif
        </div>
        <div class="row u-mg-t-20">
            @foreach ($jobs as $j)
                <div class="col-xl-4 col-lg-6 col-md-6 u-mg-b-15 u-mg-sm-b-30">
                    <div class="c-job-card">
                        <div class="c-job-card__body">
                            {{-- <div class="c-badge__wrapper">
                                <div class="c-badge">
                                    Developer
                                </div>
                            </div> --}}
                            <h6 class="c-job-card__title">
                                {{$j->title}}
                            </h6>
                            <p class="c-job-card__content">
                                {{$j->short_desc}}
                            </p>
                            <p class="c-job-card__location">
                                @if($office_count == count($j->offices))
                                    Tüm Ofisler
                                @else
                                    @php
                                        $offc = [];
                                        foreach ($j->offices as $jo) {
                                            $offc[] = $jo->office->title;
                                        }
                                        echo implode(', ', $offc);
                                    @endphp
                                @endif
                            </p>
                        </div>
                        <div class="c-job-card__footer">
                            <div class="c-job-card__footer-left">
                                <a href="{!! $j->kariyernet !!}" target="_blank">
                                    <svg class="c-icon__svg c-icon--wide">
                                        <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#kariyer') }}"></use>
                                    </svg>
                                </a>

                                <a href="{!! $j->linkedin !!}" target="_blank">
                                    <svg class="c-icon__svg c-icon--lg">
                                        <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#linkedin') }}"></use>
                                    </svg>
                                </a>
                            </div>
                            <div class="c-job-card__footer-right">
                                <a href="{{ route('job_detail', $j->slug) }}"
                                    class="c-button c-button--elevate-gray c-button--sm c-button--sm-w">
                                    {{ optional($static_texts->get('ilan-detayi'))->value }}
                                    <svg class="c-icon__svg c-icon--xs">
                                        <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#chevron-right') }}">
                                        </use>
                                    </svg>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>