@extends('backend.layouts.master')
@section('title','Çözümler - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.service.detail')
        </div>
    </div>
@endsection