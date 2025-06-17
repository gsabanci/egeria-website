@extends('backend.layouts.master')
@section('title','Personeller - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.staff.list')
        </div>
    </div>
@endsection