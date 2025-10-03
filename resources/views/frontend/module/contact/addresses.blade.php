<div class="col-md-12 col-xl-7 u-pd-xl-r-50">
    <div class="row">
        @foreach ($offices as $o)
        <div class="col-12 col-md-6 u-mg-b-15 ">
            <div class="c-office-card c-office-card--clickable" data-lat="{{ $loop->first ? '38.454530' : '40.978298' }}" data-lng="{{ $loop->first ? '27.176800' : '28.746740' }}">
                <div class="c-office-card__body">
                    <div class="c-office-card__title">
                        {{ $o->title }}
                    </div>
                    <div class="c-office-card__desc">
                        {{ $o->address }}
                    </div>
                    <div class="c-office-card__desc">
                      {{ $o->city->name }}
                    </div>
                </div>
                <div class="c-office-card__footer">
                    @if ($o->phone)
                    <div class="c-office-card__line">
                        <svg class="c-icon__svg c-icon--sm">
                            <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#phone') }}"></use>
                        </svg>
                        <a href="tel:{{ $o->phone }}">{{ $o->phone }}</a>
                    </div>
                    @endif
                    @if ($o->email)
                    <div class="c-office-card__line">
                        <svg class="c-icon__svg c-icon--sm">
                            <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#mail') }}"></use>
                        </svg>
                        <a href="mailto:{{ $o->email }}">{{ $o->email }}</a>
                    </div>
                    @endif
                   @if ($o->latitude && $o->longitude)
                   <div class="c-office-card__line">
                    <svg class="c-icon__svg c-icon--sm">
                        <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#location') }}"></use>
                    </svg>
                    <a href="">Yol tarifi al</a>
                </div>
                   @endif
                   
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-12 u-mg-t-15 h-100">
           <div class="c-map" id="map">
                Harita Yükleniyor...
           </div>
        </div>
    </div>
</div>

@if($google_maps_api_key)
<script src="https://maps.googleapis.com/maps/api/js?key={{ $google_maps_api_key }}&callback=initMap" defer></script>
<script defer>
    function initMap() {
    var center = { lat: 38.45453, lng: 27.1768 };
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: center,
        streetViewControl: false,
        mapTypeControl: false,
        clickableIcons: false,
        // disableDefaultUI: true,
    });
    }
@else
<script defer>
    function initMap() {
        // API Key yoksa harita yerine mesaj göster
        document.getElementById('map').innerHTML = '<div style="display: flex; align-items: center; justify-content: center; height: 100%; background: #f5f5f5; color: #666; font-size: 16px;">Google Maps API Key tanımlanmamış</div>';
    }
@endif

@if($google_maps_api_key)
    window.onload = function () {
        var marker = new google.maps.Marker({
        position: { lat: 38.45453, lng: 27.1768 },
        map: map,
        title: 'Merhaba Dünya!',
    });

    $('.c-office-card').click(function () {
        var lat = parseFloat($(this).data('lat'));
        var lng = parseFloat($(this).data('lng'));

        var newCenter = new google.maps.LatLng(lat, lng);
        map.panTo(newCenter);

        new google.maps.Marker({
        position: newCenter,
        map: map,
        });

        $('.c-office-card').removeClass('active');
        $(this).addClass('active');
    });

    $('.c-office-card').first().trigger('click');
    }
@endif
</script>
