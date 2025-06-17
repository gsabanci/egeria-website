@extends('backend.layouts.master')
@section('title','Haberler - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.news.list')
        </div>
    </div>
@endsection