@extends('backend.layouts.master')
@section('title','İletişim - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.contact.list')
        </div>
    </div>
@endsection