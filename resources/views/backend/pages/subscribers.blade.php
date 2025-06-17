@extends('backend.layouts.master')
@section('title','E-bülten Aboneleri - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.subscribers.list')
        </div>
    </div>
@endsection