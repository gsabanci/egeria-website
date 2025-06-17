@extends('backend.layouts.master')
@section('title','İş Kategorileri - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.job_categories.list')
        </div>
    </div>
@endsection