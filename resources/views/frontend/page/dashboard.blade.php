@extends('frontend.layouts.master')

@section('content')
    @include('frontend.module.homepage.jumbotron')

	@include('frontend.module.homepage.aboutus')

	@include('frontend.module.homepage.projects')

	@include('frontend.module.homepage.services')

	@include('frontend.module.homepage.offices')
	
    @include('frontend.module.homepage.news')

@endsection
