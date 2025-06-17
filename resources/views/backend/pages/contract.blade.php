@extends('backend.layouts.master')
@section('title','Sözleşmeler - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('backend.modules.contract.list')
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.summernote').summernote({
            height: 150
        });
    </script>
@endsection