@extends('backend.layouts.master')
@section('title', 'Haber Detay - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.news.detail')
        </div>
    </div>
@endsection
