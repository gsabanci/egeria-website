@extends('backend.layouts.master')
@section('title','Statik Metinler - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.static_text.list')
        </div>
    </div>
@endsection