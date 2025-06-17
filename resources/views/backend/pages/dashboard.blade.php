@extends('backend.layouts.master')
@section('title','Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.dashboard.ga_stats')
        </div>
    </div>
@endsection
