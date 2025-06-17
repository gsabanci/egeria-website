<!-- logo grid section -->
<section class="c-section">
    <div class="container">

        @foreach ($references->chunk(4) as $key => $chunk)
            @if($key % 2 == 0)
            <div class="c-grid c-grid--3">
                @foreach($chunk as $ref)
                <div class="c-grid__item">
                    <img class="{{ $ref->bad_logo == '1' ? 'badimg' : null }}" style="{{ $ref->is_bright == '1' ? 'filter: grayscale(1) brightness(1) !important' : null }}" src="{{ asset('/storage/reference_images/'.$ref->logo) }}" alt="{{ $ref->name }}">
                </div>
                @endforeach
            </div>
            @else
            <div class="c-grid c-grid--1">
                @foreach($chunk as $ref)
                <div class="c-grid__item">
                    <img class="{{ $ref->bad_logo == '1' ? 'badimg' : null }}" style="{{ $ref->is_bright == '1' ? 'filter:  grayscale(1)brightness(1) !important' : null }}" src="{{ asset('/storage/reference_images/'.$ref->logo) }}" alt="{{ $ref->name }}">
                </div>
                @endforeach
            </div>
            @endif
        @endforeach
        



        <div class="owl-carousel owl-theme c-slider--projects c-slider--projects-mobile">
            @foreach($references as $ref)
            <div class="c-grid__item">
                <img class="{{ $ref->bad_logo == '1' ? 'badimg' : null }}" style="{{ $ref->is_bright == '1' ? 'filter:  grayscale(1)brightness(1) !important' : null }}" src="{{ asset('/storage/reference_images/'.$ref->logo) }}" alt="{{ $ref->name }}">
            </div>
            @endforeach
        </div>
    </div>
</section>