@extends('backend.layouts.master')
@section('title','Hizmetler - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.labors.list')
        </div>
    </div>
@endsection