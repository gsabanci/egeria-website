@extends('backend.layouts.master')
@section('title','İş İlanları - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.job.list')
        </div>
    </div>
@endsection