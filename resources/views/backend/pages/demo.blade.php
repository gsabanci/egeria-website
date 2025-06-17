@extends('backend.layouts.master')
@section('title','Demo Talepleri - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.demo_requests.list')
        </div>
    </div>
@endsection