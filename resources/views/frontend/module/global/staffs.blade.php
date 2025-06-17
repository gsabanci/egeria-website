@foreach ($staff as $s)
    <div class="c-contact-card">
        <div class="c-contact-card__img">
            @if (is_null($s->image))
            <img src="{{ asset('/storage/staff_photos/no_avatar.ico') }}" alt="">
            @else
            <img src="{{ asset('/storage/staff_photos/'.$s->image) }}" alt="">
            @endif
           
        </div>
        <div class="c-contact-card__content staff">
            <div class="c-contact-card__info">
                <div class="c-contact-card__name">
                    {{ $s->fullname }}<br>
                    <span class="staff-title">{{ $s->title }}</span>
                </div>
            </div>
            <div class="c-contact-card__icons">
                @if (!is_null($s->email))
                <a href="mailto:{{ $s->email }}">
                    <svg class="c-icon__svg c-icon--md">
                        <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#mail') }}">
                        </use>
                    </svg>
                </a>
                @endif
                @if (!is_null($s->linkedin))
                <a href="{{ $s->linkedin }}" target="_blank">
                    <svg class="c-icon__svg c-icon--md">
                        <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#linkedin') }}">
                        </use>
                    </svg>
                </a>
                @endif
            </div>
        </div>
    </div>
@endforeach