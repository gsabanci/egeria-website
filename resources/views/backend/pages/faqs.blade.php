@extends('backend.layouts.master')
@section('title','Kariyer İçerik / SSS - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.faqs.list')
        </div>
    </div>
@endsection