@extends('layouts.main.master')
@section('title')
    {{ $title }}
@endsection
@section('description')
    {{ $description }}
@endsection
@section('image')
    {{ url(firstBeforeAfterImage($image) ?: 'frontend/img/page-header-bg.png') }}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<section class="page-title" style="background-image: url('frontend/images/hai-trinh.jpg');">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title wow fadeInUp" data-wow-delay="700ms">{{ $title }}</h1>
            <ul class="page-breadcrumb wow fadeInUp mt-3" data-wow-delay="900ms">
                <li><a href="{{route('home')}}">Trang chủ</a></li>
                <li>{{$title}}</li>
            </ul>
        </div>
    </div>
  </section>
  <!-- Packages Section -->
  <section class="packages-section pt-120 pb-60">
    <div class="bg bg-image" style="background-image: url(/frontend/images/bg-packages1.jpg);"></div>
    <div class="auto-container">
      <div class="carousel-outer">
        <div class="packages-carousel owl-carousel owl-theme"> 
            @foreach ($list as $item)
                <!-- Package Block -->
          <div class="package-block">
            <div class="inner-box">
              <div class="image-box">
                <figure class="image"><a href="{{route('duanTieuBieuDetail',['slug'=>$item->slug])}}"><img src="{{ url(json_decode($item->images, true)[0]) }}" alt="{{ languageName($item->name) }}"></a></figure>
              </div>
              <div class="content-box">
                <div class="price">{{$item->location}}</div>
                <br>
                <h4 class="title"><a href="{{route('duanTieuBieuDetail',['slug'=>$item->slug])}}">{{ languageName($item->name) }}</a></h4>
                <span class="location"> <a href="{{route('duanTieuBieuDetail',['slug'=>$item->slug])}}" class="text-white">{{ languageName($item->description) }}</a></span>
              </div>
            </div>
          </div>
            @endforeach
        </div>
      </div>
    </div>
  </section>
@endsection
