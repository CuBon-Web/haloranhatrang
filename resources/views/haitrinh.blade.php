@extends('layouts.main.master')
@section('title')
Hải trình Halora
@endsection
@section('description')
Hải trình Halora
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('body_class')
itinerary-page
@endsection
@section('css')
@endsection
@section('content')

<section class="page-title style-two" style="background-image: url({{ url('frontend/images/hai-trinh.jpg') }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title wow fadeInUp" data-wow-delay="700ms">Dịch vụ Halora</h1>
            <ul class="page-breadcrumb wow fadeInUp" data-wow-delay="900ms">
                <li>Dịch vụ Halora</li>
            </ul>
        </div>
    </div>
</section>
<section class="destination-section itinerary-page-section">
    <div class="auto-container">
        @if(isset($itineraries) && $itineraries->count())
        <div class="itinerary-page__intro wow fadeInUp">
            <h2>Khám phá dịch vụ</h2>
            <p>Chọn tuyến đi phù hợp — xem mô tả và bản đồ hành trình chi tiết bên dưới.</p>
        </div>

        <div class="itinerary-page__tabs default-tabs tabs-box wow fadeInUp" data-wow-delay="150ms">
            <ul class="itinerary-page__tab-nav tab-buttons clearfix">
                @foreach($itineraries as $index => $item)
                <li class="tab-btn {{ $index === 0 ? 'active-btn' : '' }}" data-tab="#itinerary-tab-{{ $item->id }}">
                    <span class="title">{{ $item->name }}</span>
                </li>
                @endforeach
            </ul>

            <div class="tabs-content">
                @foreach($itineraries as $index => $item)
                @php
                    $mapImage = $item->map_image ? url($item->map_image) : url('/frontend/images/background/destination1-1.png');
                @endphp
                <div class="tab itinerary-page__panel {{ $index === 0 ? 'active-tab' : '' }}" id="itinerary-tab-{{ $item->id }}">
                    <div class="tab-block">
                        <div class="itinerary-page__card">
                            <div class="itinerary-page__info">
                                <span class="itinerary-page__label">
                                    <i class="fa fa-compass" aria-hidden="true"></i> Dịch vụ
                                </span>
                                <h3 class="itinerary-page__name">{{ $item->name }}</h3>
                                @if(!empty($item->short_description))
                                <p class="itinerary-page__desc">{{ $item->short_description }}</p>
                                @endif
                                @if(!empty($item->slug))
                                <a href="{{ route('haitrinhDetail', ['slug' => $item->slug]) }}" class="itinerary-page__btn">
                                    Xem chi tiết <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                </a>
                                @endif
                            </div>
                            <div class="itinerary-page__map">
                                <figure class="itinerary-page__figure">
                                    <img
                                        src="{{ $mapImage }}"
                                        alt="Bản đồ {{ $item->name }}"
                                        class="img-fluid"
                                        loading="lazy">
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="itinerary-page__empty">
            <p>Hiện chưa có hải trình nào. Vui lòng quay lại sau.</p>
        </div>
        @endif
    </div>
</section>
@endsection