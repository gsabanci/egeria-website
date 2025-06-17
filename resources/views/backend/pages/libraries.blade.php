@extends('backend.layouts.master')
@section('title', 'Kütüphane - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.library.list')
        </div>
    </div>
@endsection
