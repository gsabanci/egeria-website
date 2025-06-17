@extends('backend.layouts.master')
@section('title','Referanslar - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.reference.list')
        </div>
    </div>
@endsection