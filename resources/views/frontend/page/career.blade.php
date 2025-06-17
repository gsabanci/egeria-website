@extends('frontend.layouts.master')
@section('title', $page_title)

@section('content')
    
    @include('frontend.module.global.title')

    @include('frontend.module.career.filter')

    @include('frontend.module.career.jobs')
    
@endsection
<script>


</script>