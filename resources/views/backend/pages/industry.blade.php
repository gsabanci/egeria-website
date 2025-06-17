@extends('backend.layouts.master')
@section('title','Sektörler - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.industry.list')
        </div>
    </div>
@endsection