@extends('backend.layouts.master')
@section('title','Sosyal Medya Hesapları - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.social.list')
        </div>
    </div>
@endsection