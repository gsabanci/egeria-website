@extends('frontend.layouts.master')
@section('title', $page_title)

@section('content')
@include('frontend.module.global.title')
	
    @include('frontend.module.reference.logos')

	@include('frontend.module.reference.services')
@endsection
