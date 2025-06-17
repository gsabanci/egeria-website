@extends('backend.layouts.master')
@section('title','Ofisler - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.office.list')
        </div>
    </div>
@endsection