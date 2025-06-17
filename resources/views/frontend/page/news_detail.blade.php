@extends('frontend.layouts.master')
@section('title', $page_title)

@section('content')
	<section class="c-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-6 offset-lg-1 offset-md-0 u-mg-b-30 u-mg-md-b-0">
				<div class="c-breadcrumb">
					<div class="c-breadcrumb__item">
						<a href="/">Egeria</a> <span>/</span>
					</div>  
					<div class="c-breadcrumb__item">
					<a href="/haberler">Haberler</a> <span>/</span>
					</div>  
					<div class="c-breadcrumb__item c-breadcrumb__item--last">
					{{ $news_detail->title }}
					</div>
				</div>   
			</div>
		</div>
	</section>
	<!-- news details section -->
	<section class="c-section">
		<div class="container">
			<div class="row u-mg-b-15 u-mg-lg-b-0">
				<div class="col-lg-7 offset-lg-1 u-mg-b-15 u-mg-md-b-0">
					<div class="c title">
						<h2 class="c-title__heading">{{ $news_detail->title }}</h2>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="c-blog__date">
						<p>Yayınlanma Tarihi</p>
						<p>{{ date('d F Y',strtotime($news_detail->created_at)) }}</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 ">
					{{-- <div class="c-badge__wrapper">
						<div class="c-badge">Üretim</div>
						<div class="c-badge">Üretim</div>
					</div> --}}
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-lg-10 offset-0 offset-lg-1">
					<div class="c-blog__content">
						<img src="{{ asset('/storage/news_photos/'.$news_detail->image) }}" alt="{{ $news_detail->title }}" class="mb-3">
						{!! $news_detail->detail !!}
					</div>
				</div>

			</div>
			<!-- <div class="row u-mg-y-20">
				<div
					class="col-xl-6 offset-xl-6 col-lg-8 offset-lg-4 d-flex justify-content-between align-items-center">
					<div class="c-title">
						<div class="c-title__heading c-title__heading--no-mg">
							<h5>Hesap yöneticilerimiz ile iletişime geçin</h5>
						</div>
					</div>
					<form action="" method="POST">
						@csrf
						<select class="js-state-select c-select2--outline" onchange="this.form.submit()" name="office_guid" style="width: 170px;">
							<option value="all">Tüm Ofisler</option>
								@foreach ($offices as $o)
								<option {{ $o_guid==$o->office_guid?'selected':'' }} value="{{ $o->office_guid }}">{{ $o->title }}
								</option>
								@endforeach
						</select>
				</form>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-lg-10 offset-0 offset-lg-1 d-flex">
					@include('frontend.module.global.staffs')
				</div>
			</div> -->
		</div>
	</section>

	<!-- news section -->
	<section class="c-section">
		<div class="container">
			<div class="row">
				@foreach ($other_news as $on)
				<div class="col-12 col-md-6 col-xl-4 u-mg-b-15 u-mg-sm-b-30">
					<div class="c-news-card">
						<div class="c-news-card__head">
							<img src="{{ asset('/storage/news_photos/'.$on->image) }}" alt="">
						</div>
						<div class="c-news-card__body">
							{{-- <div class="c-badge__wrapper">
								<div class="c-badge">Üretim</div>
								<div class="c-badge">ERP</div>
								<div class="c-badge">dddddddddddddd</div>
								<div class="c-badge">asdasdasd</div>
								<div class="c-badge">ddd</div>
								<div class="c-badge">ERP</div>
								<div class="c-badge">Üretim</div>
								<div class="c-badge">ddd</div>
							</div> --}}
							<a class="c-news-card__content" href="{{ route('news_detail',$on->slug) }}">
								<div class="c-news-card__title">
									{{ $on->title }}
								</div>
								<div class="c-news-card__desc">
								{{$on->short_desc}}
								</div>
							</a>
							<div class="c-news-card__date">
								{{ date('d F Y',strtotime($on->created_at)) }}
							</div>
						</div>
					</div>
				</div>
				@endforeach
			

			</div>
		</div>
	</section>

	
@endsection
