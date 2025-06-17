@extends('backend.layouts.master')
@section('title','Site İçerikleri - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.setting.list')
        </div>
    </div>
@endsection