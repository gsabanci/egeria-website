@extends('backend.layouts.master')
@section('title', 'Kategoriler - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.categories.list')
        </div>
    </div>
@endsection
