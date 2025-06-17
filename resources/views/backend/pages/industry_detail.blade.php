@extends('backend.layouts.master')
@section('title','Endüstriler - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.industry.detail')
        </div>
    </div>
@endsection