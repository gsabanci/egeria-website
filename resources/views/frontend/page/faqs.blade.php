@extends('frontend.layouts.master')
@section('title', $page_title)

@section('content')
@include('frontend.module.faqs.title')

@include('frontend.module.faqs.qna')
@endsection