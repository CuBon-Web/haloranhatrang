@extends('layouts.main.master')
@section('title')
{{$cateService->name}}
@endsection
@section('description')
{{$cateService->description}}
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('body_class')
service-list-page
@endsection
@section('css')
<style>
/* page-wrapper overflow:hidden trong theme chặn position:sticky */
body.service-list-page .page-wrapper {
    overflow: visible;
}

.service-list-page .page-title.style-two .title-outer .price {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin: 18px 0 0;
    padding: 10px 22px;
    border-radius: 999px;
    background: linear-gradient(135deg, var(--theme-color1) 0%, var(--theme-color1-dark) 100%);
    color: #fff;
    font-family: var(--title-font);
    font-size: 22px;
    font-weight: 700;
    font-style: normal;
    line-height: 1.2;
    letter-spacing: 0.02em;
    box-shadow: 0 10px 28px rgba(0, 0, 0, 0.25);
    border: 1px solid rgba(255, 255, 255, 0.25);
}

@media (max-width: 767px) {
    .service-list-page .page-title.style-two .title-outer .price {
        font-size: 18px;
        padding: 8px 16px;
        margin-top: 14px;
    }
}

@media (min-width: 992px) {
    .service-list-sidebar-col {
        position: relative;
    }
}
</style>
@endsection
@section('content')
@php
    $cateImages = json_decode($cateService->image, true) ?: [];
    $cateImages = array_values(array_filter($cateImages, function ($img) {
        return is_string($img) && $img !== '';
    }));
@endphp
<section class="page-title style-two" style="background-image: url({{ !empty($cateImages) ? $cateImages[0] : '' }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title wow fadeInUp" data-wow-delay="700ms">{{ $cateService->name }}</h1>
            <ul class="page-breadcrumb wow fadeInUp" data-wow-delay="900ms">
                <li>{{ $cateService->description }}</li>
            </ul>
            @if(!empty($cateService->price))
            <p class="price wow fadeInUp" data-wow-delay="1100ms">Giá: {{ number_format($cateService->price) }} VNĐ</p>
            @endif
        </div>
    </div>
</section>
<section class="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 product-details rd-page">
                {{-- @if (count($cateImages))
                <div class="bxslider wow fadeInUp" data-wow-delay="600ms">
                    @foreach ($cateImages as $slideIndex => $img)
                    <div class="slider-content">
                        <figure class="image-box">
                            <a href="{{ $img }}" class="lightbox-image" data-fancybox="gallery">
                                <img src="{{ $img }}" alt="{{ strip_tags(languageName($cateService->name)) }}">
                            </a>
                        </figure>
                        <div class="slider-pager">
                            <ul class="thumb-box">
                                @foreach ($cateImages as $thumbIndex => $thumb)
                                <li class="mb-0">
                                    <a class="{{ $thumbIndex === 0 ? 'active' : '' }}" data-slide-index="{{ $thumbIndex }}" href="#">
                                        <figure><img src="{{ $thumb }}" alt=""></figure>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif --}}
                <div class="room-details__left">
                    <div class="wrapper">
                        {!!languageName($cateService->content)!!}
                    </div>
                    
                    <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-40 pb-40 border-top">
                        <h6 class="my-sm-0">Share Details</h6>
                        <div class="blog-details__social-list"> <a href="news-details.html"><i class="fa fa-x"></i></a> <a href="news-details.html"><i class="fab fa-facebook"></i></a> <a href="news-details.html"><i class="fab fa-pinterest-p"></i></a> <a href="news-details.html"><i class="fab fa-instagram"></i></a> </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 service-list-sidebar-col">
                <div class="sidebar">
                    <div class="sidebar__single sidebar__post">
                        <h3 class="sidebar__title">Các trải nghiệm khác</h3>
                        <ul class="sidebar__post-list list-unstyled">
                            @foreach ($servicehome as $item)
                                <li>
                                    <a href="{{ route('serviceList', ['slug' => $item->slug]) }}">
                                    <div class="sidebar__post-image"> <img src="{{ json_decode($item->image)[0] }}" alt=""> </div>
                                    <div class="sidebar__post-content">
                                        <h3><span class="sidebar__post-content-meta"><i class="far fa-door-open"></i>{{ $item->name }}</span> <a href="">{{ $item->price }}</a></h3>
                                    </div>
                                </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <br>
                    @include('partials.service-register-form', [
                        'title' => 'Đăng ký dịch vụ',
                        'selectedService' => strip_tags(languageName($cateService->name)),
                        'selectedServiceSlug' => $cateService->slug,
                        'itineraries' => $itineraries,
                        'useLanguageName' => true,
                        'cardClass' => 'mb-30 service-register-card--sticky',
                    ])
                   
                </div>
            </div>
        </div>
    </div>
</section>
@endsection