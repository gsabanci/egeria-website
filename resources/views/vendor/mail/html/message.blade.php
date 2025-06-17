@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{ asset('frontend/assets/images/egeria-black-logo.png') }}">
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}
{{-- Subcopy --}}


@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} Coder's Tape
@endcomponent
@endslot
@endcomponent
