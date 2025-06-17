@extends('backend.layouts.master')
@section('title','İş Başvuruları - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.jobapply.list')
        </div>
    </div>
@endsection