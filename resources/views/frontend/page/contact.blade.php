@extends('frontend.layouts.master')
@section('title', $page_title)

@section('content')
@include('frontend.module.contact.title')
<section class="c-section c-section--no-padding-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12 offset-md-0">
                <div class='row'>
                    @include('frontend.module.contact.addresses')
                    <div class="col-md-12 col-xl-5 u-mg-t-50 u-mg-lg-t-0">
                        @include('frontend.module.contact.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<!-- AIzaSyBp8vuLC_rRdaSpbLZzTR4VkqVwoSv1jZg -->
