<div class="c-copyright">
    <div class="container">
        <div class="c-copyright__row">
            <div class="c-copyright__left">
                @foreach($policies as $pol)
                    <div data-toggle="modal" data-target="#{{ $pol->slug . '-modal' }}">{{ $pol->title }}</div>
                @endforeach
            </div>
            <div class="c-copyright__right">
                @foreach ($socials as $s)
                    <a href="{{ $s->link }}" target="_blank" aria-label="{{($s->title)}}">
                        <svg class="c-icon__svg c-icon--sm">
                            <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#' . Str::lower($s->title)) }}">
                            </use>
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@foreach($policies as $pol)
    <div class="modal fade" id="{{ $pol->slug . '-modal' }}" tabindex="-1" role="dialog" aria-labelledby="agreementModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg c-modal" role="document">
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
                        <div class="col-lg-12">
                            <div class="c-title">
                                <h4 class="c-title__heading c-title__heading--medium">
                                    {{ $pol->title }}
                                </h4>
                            </div>
                            <div class="modal-body c-modal__body m-3">
                                    {!! $pol->content !!}
                            </div>
                            <!-- <div class="c-modal__text">
                                {!! $pol->content !!}
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach