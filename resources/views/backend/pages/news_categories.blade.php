@extends('backend.layouts.master')
@section('title', 'Haber Kategorileri - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.news_categories.list')
        </div>
    </div>
@endsection
