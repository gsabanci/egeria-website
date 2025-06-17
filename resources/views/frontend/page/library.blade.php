@extends('frontend.layouts.master')
@section('title', $page_title)

@section('content')
    @include('frontend.module.library.title')

    @include('frontend.module.library.items')
@endsection
