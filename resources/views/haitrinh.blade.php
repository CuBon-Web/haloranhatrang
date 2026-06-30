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
<style>
.itinerary-page-section.destination-section {
    padding: 80px 0 100px;
}

.itinerary-page-section.destination-section .tabs-content .tab .tab-block {
    display: block;
    width: 100%;
    text-align: left;
    align-items: stretch;
}

.itinerary-page-section {
    background: linear-gradient(180deg, var(--theme-light-background) 0%, #fff 100%);
}

.itinerary-page-section .itinerary-page__intro {
    max-width: 640px;
    margin: 0 auto 40px;
    text-align: center;
}

.itinerary-page-section .itinerary-page__intro h2 {
    margin: 0 0 12px;
    font-family: var(--title-font);
    font-size: 36px;
    color: var(--headings-color);
}

.itinerary-page-section .itinerary-page__intro p {
    margin: 0;
    color: var(--text-color);
    line-height: 1.7;
}

.itinerary-page-section .itinerary-page__tabs {
    max-width: 1140px;
    margin: 0 auto;
}

.itinerary-page-section .itinerary-page__tab-nav {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin: 0 0 32px;
    padding: 0;
    list-style: none;
}

.itinerary-page-section .itinerary-page__tab-nav .tab-btn {
    margin: 0;
    padding: 12px 24px;
    border: 1px solid rgba(var(--theme-color2-rgb), 0.12);
    border-radius: 999px;
    background: #fff;
    color: var(--theme-color2);
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.25s ease;
    box-shadow: none;
}

.itinerary-page-section .itinerary-page__tab-nav .tab-btn:hover,
.itinerary-page-section .itinerary-page__tab-nav .tab-btn.active-btn {
    background: var(--theme-color1);
    border-color: var(--theme-color1);
    color: #fff;
    padding: 12px 24px;
}

.itinerary-page-section .tabs-content {
    position: relative;
}

.itinerary-page-section .tabs-content .icon-wheel-compass-3 {
    display: none;
}

.itinerary-page-section .itinerary-page__panel .tab-block {
    margin: 0;
    padding: 0;
    background: none;
    min-height: auto;
}

.itinerary-page-section .itinerary-page__card {
    display: grid;
    grid-template-columns: minmax(0, 380px) minmax(0, 1fr);
    gap: 32px;
    align-items: stretch;
    padding: 28px;
    border-radius: 24px;
    background: #fff;
    border: 1px solid rgba(var(--theme-color1-rgb), 0.2);
    box-shadow: 0 20px 60px rgba(var(--theme-color2-rgb), 0.08);
}

.itinerary-page-section .itinerary-page__info {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 8px 4px;
}

.itinerary-page-section .itinerary-page__label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    width: fit-content;
    margin-bottom: 14px;
    padding: 6px 12px;
    border-radius: 999px;
    background: rgba(var(--theme-color1-rgb), 0.15);
    color: var(--theme-color1-dark);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.itinerary-page-section .itinerary-page__name {
    margin: 0 0 16px;
    font-family: var(--title-font);
    font-size: 32px;
    line-height: 1.25;
    color: var(--headings-color);
}

.itinerary-page-section .itinerary-page__desc {
    margin: 0 0 22px;
    color: var(--text-color);
    font-size: 15px;
    line-height: 1.8;
}

.itinerary-page-section .itinerary-page__btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 22px;
    border-radius: 999px;
    background: var(--theme-color2);
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 10px 24px rgba(var(--theme-color2-rgb), 0.2);
}

.itinerary-page-section .itinerary-page__btn:hover {
    background: var(--theme-color1);
    color: var(--theme-color2);
    transform: translateY(-2px);
}

.itinerary-page-section .itinerary-page__btn i {
    font-size: 12px;
    transition: transform 0.25s ease;
}

.itinerary-page-section .itinerary-page__btn:hover i {
    transform: translateX(4px);
}

.itinerary-page-section .itinerary-page__map {
    min-width: 0;
}

.itinerary-page-section .itinerary-page__figure {
    margin: 0;
    height: 100%;
    min-height: 280px;
    border-radius: 18px;
    overflow: hidden;
    background: #eef4f8;
    box-shadow: inset 0 0 0 1px rgba(var(--theme-color2-rgb), 0.06);
}

.itinerary-page-section .itinerary-page__figure img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
}

.itinerary-page-section .itinerary-page__empty {
    padding: 48px 24px;
    border-radius: 20px;
    background: #fff;
    text-align: center;
    color: var(--text-color);
    box-shadow: 0 12px 40px rgba(var(--theme-color2-rgb), 0.06);
}

@media (max-width: 991.98px) {
    .itinerary-page-section .itinerary-page__card {
        grid-template-columns: 1fr;
        gap: 24px;
        padding: 22px;
    }

    .itinerary-page-section .itinerary-page__info {
        order: 1;
    }

    .itinerary-page-section .itinerary-page__map {
        order: 2;
    }

    .itinerary-page-section .itinerary-page__figure {
        min-height: 220px;
    }
}

@media (max-width: 767.98px) {
    .itinerary-page-section.destination-section {
        padding: 56px 0 72px;
    }

    .itinerary-page-section .itinerary-page__intro h2 {
        font-size: 28px;
    }

    .itinerary-page-section .itinerary-page__tab-nav {
        flex-wrap: nowrap;
        justify-content: flex-start;
        overflow-x: auto;
        padding-bottom: 8px;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }

    .itinerary-page-section .itinerary-page__tab-nav::-webkit-scrollbar {
        display: none;
    }

    .itinerary-page-section .itinerary-page__tab-nav .tab-btn {
        flex: 0 0 auto;
        white-space: nowrap;
    }

    .itinerary-page-section .itinerary-page__name {
        font-size: 26px;
    }

    .itinerary-page-section .itinerary-page__card {
        padding: 18px;
        border-radius: 18px;
    }
}
</style>
@endsection
@section('content')

<section class="page-title style-two" style="background-image: url({{ url('frontend/images/hai-trinh.jpg') }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title wow fadeInUp" data-wow-delay="700ms">Hải trình Halora</h1>
            <ul class="page-breadcrumb wow fadeInUp" data-wow-delay="900ms">
                <li>Hải trình Halora</li>
            </ul>
        </div>
    </div>
</section>
<section class="destination-section itinerary-page-section">
    <div class="auto-container">
        @if(isset($itineraries) && $itineraries->count())
        <div class="itinerary-page__intro wow fadeInUp">
            <h2>Khám phá hải trình</h2>
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
                                    <i class="fa fa-compass" aria-hidden="true"></i> Hải trình
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