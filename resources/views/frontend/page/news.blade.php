@extends('frontend.layouts.master')
@section('title', $page_title)

@section('content')
    @include('frontend.module.news.title')

    {{-- @include('frontend.module.news.filter') --}}

    @include('frontend.module.news.items')
@endsection
