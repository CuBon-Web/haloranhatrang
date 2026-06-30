@extends('layouts.main.master')
@section('title')
{{ $detail->name }}
@endsection
@section('description')
{{ $detail->short_description ?: $detail->name }}
@endsection
@section('image')
@php
    $coverImage = $detail->featured_image ?: $detail->map_image;
@endphp
{{ $coverImage ? url($coverImage) : url('frontend/images/hai-trinh.jpg') }}
@endsection
@section('body_class')
itinerary-detail-page
@endsection
@section('css')
<style>
.itinerary-detail-page .itinerary-detail__back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 24px;
    color: var(--theme-color1-dark);
    font-weight: 600;
    text-decoration: none;
}

.itinerary-detail-page .itinerary-detail__back:hover {
    color: var(--headings-color);
}

.itinerary-detail-page .itinerary-detail__hero-meta {
    margin-top: 16px;
    max-width: 720px;
    color: rgba(255, 255, 255, 0.92);
    font-size: 16px;
    line-height: 1.75;
}

.itinerary-detail-section {
    padding: 0px 0 90px;
    background: linear-gradient(180deg, #fff 0%, var(--theme-light-background) 100%);
}

.itinerary-detail-sidebar {
    padding: 0;
}

.itinerary-detail-section .itinerary-detail__map {
    margin-bottom: 40px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 16px 48px rgba(var(--theme-color2-rgb), 0.1);
}

.itinerary-detail-section .itinerary-detail__map img {
    width: 100%;
    display: block;
}

.itinerary-detail-section .itinerary-detail__days-title {
    margin: 0 0 24px;
    font-family: var(--title-font);
    font-size: 28px;
    color: var(--headings-color);
}

.itinerary-detail-section .itinerary-day__label {
    display: inline-block;
    margin-right: 12px;
    padding: 4px 10px;
    border-radius: 999px;
    background: rgba(var(--theme-color1-rgb), 0.2);
    color: var(--theme-color1-dark);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    vertical-align: middle;
}

.itinerary-detail-section .itinerary-days-accordion {
    --bs-accordion-border-radius: 14px;
    --bs-accordion-inner-border-radius: 14px;
}

.itinerary-detail-section .itinerary-days-accordion .accordion-item {
    margin-bottom: 12px;
    border: 1px solid rgba(var(--theme-color1-rgb), 0.25);
    border-radius: 14px !important;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 8px 24px rgba(var(--theme-color2-rgb), 0.05);
}

.itinerary-detail-section .itinerary-days-accordion .accordion-item:last-child {
    margin-bottom: 0;
}

.itinerary-detail-section .itinerary-days-accordion .accordion-button {
    padding: 18px 22px;
    font-family: var(--title-font);
    font-size: 18px;
    font-weight: 500;
    color: var(--headings-color);
    background: linear-gradient(90deg, rgba(var(--theme-color1-rgb), 0.08) 0%, #fff 100%);
    box-shadow: none;
}

.itinerary-detail-section .itinerary-days-accordion .accordion-button:not(.collapsed) {
    color: var(--headings-color);
    background: linear-gradient(90deg, rgba(var(--theme-color1-rgb), 0.18) 0%, #fff 100%);
    box-shadow: none;
}

.itinerary-detail-section .itinerary-days-accordion .accordion-button:focus {
    border-color: rgba(var(--theme-color1-rgb), 0.4);
    box-shadow: 0 0 0 3px rgba(var(--theme-color1-rgb), 0.15);
}

.itinerary-detail-section .itinerary-days-accordion .accordion-button::after {
    background-size: 1rem;
    filter: opacity(0.65);
}

.itinerary-detail-section .itinerary-day-accordion__head {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    padding-right: 12px;
    text-align: left;
}

.itinerary-detail-section .itinerary-day-accordion__title {
    line-height: 1.35;
}

.itinerary-detail-section .itinerary-days-accordion .accordion-body {
    padding: 0 22px 22px;
    border-top: 1px solid rgba(var(--theme-color1-rgb), 0.15);
}

.itinerary-detail-section .itinerary-days-accordion .accordion-body .wrapper {
    padding-top: 18px;
}

.itinerary-detail-sidebar .sidebar__title {
    margin-bottom: 16px;
}

.itinerary-detail-sidebar .itinerary-detail__nav a {
    display: block;
    padding: 12px 14px;
    margin-bottom: 8px;
    border-radius: 10px;
    background: #fff;
    border: 1px solid rgba(var(--theme-color2-rgb), 0.08);
    color: var(--headings-color);
    text-decoration: none;
    transition: all 0.25s ease;
}

.itinerary-detail-sidebar .itinerary-detail__nav a:hover,
.itinerary-detail-sidebar .itinerary-detail__nav a.active {
    background: var(--theme-color1);
    border-color: var(--theme-color1);
    color: #fff;
}

/* page-wrapper overflow:hidden chặn sticky */
body.itinerary-detail-page .page-wrapper {
    overflow: visible;
}

body.itinerary-detail-page .blog-details.itinerary-detail-section,
body.itinerary-detail-page .itinerary-detail-section .container {
    overflow: visible;
}

@media (min-width: 992px) {
    .itinerary-detail-sidebar-col {
        position: relative;
    }
}

.itinerary-detail-page .itinerary-detail-sidebar__others {
    margin-top: 0;
    padding: 22px 20px;
    border-radius: 16px;
    background: #fff;
    border: 1px solid rgba(var(--theme-color2-rgb), 0.08);
    box-shadow: 0 10px 30px rgba(var(--theme-color2-rgb), 0.05);
}

.itinerary-detail-page .itinerary-detail-sidebar__others .sidebar__title {
    margin: 0 0 16px;
    font-family: var(--title-font);
    font-size: 20px;
    color: var(--headings-color);
}

@media (max-width: 991.98px) {
    .itinerary-detail-page .itinerary-detail-sidebar-col {
        margin-top: 40px;
    }

    .itinerary-detail-section .itinerary-days-accordion .accordion-button {
        padding: 14px 16px;
        font-size: 16px;
    }

    .itinerary-detail-section .itinerary-day-accordion__head {
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
    }
}
</style>
@endsection
@section('content')
@php
    $coverImage = $detail->featured_image ?: $detail->map_image;
    $heroBg = $coverImage ? url($coverImage) : url('frontend/images/hai-trinh.jpg');
    $mapImage = $detail->map_image ? url($detail->map_image) : null;
    $days = is_array($detail->days) ? $detail->days : (json_decode($detail->days, true) ?: []);
@endphp

<section class="page-title" style="background-image: url({{ $heroBg }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title wow fadeInUp" data-wow-delay="700ms">{{ $detail->name }}</h1>
            <ul class="page-breadcrumb wow fadeInUp mt-3" data-wow-delay="900ms">
                <li><a href="{{ route('haitrinh') }}">Hải trình</a></li>
                <li>{{ $detail->name }}</li>
            </ul>
        </div>
    </div>
</section>

<section class="blog-details itinerary-detail-section">
    <div class="container">
        <div class="row itinerary-detail-layout">
            <div class="col-xl-8 col-lg-7">
                @if($mapImage)
                <figure class="itinerary-detail__map">
                    <img src="{{ $mapImage }}" alt="Bản đồ {{ $detail->name }}" loading="lazy">
                </figure>
                @endif

                @if(!empty($detail->content))
                <div class="wrapper mb-40">
                    {!! $detail->content !!}
                </div>
                @endif

                @if(count($days))
                <h2 class="itinerary-detail__days-title">Lộ trình chi tiết</h2>
                <div class="accordion itinerary-days-accordion" id="itineraryDaysAccordion-{{ $detail->id }}">
                @foreach($days as $index => $day)
                @php
                    $dayName = is_array($day) ? ($day['name'] ?? '') : '';
                    $dayContent = is_array($day) ? ($day['content'] ?? '') : '';
                    $dayCollapseId = 'itinerary-day-' . $detail->id . '-' . $index;
                @endphp
                @if($dayName || $dayContent)
                    <div class="accordion-item itinerary-day-accordion">
                        <h3 class="accordion-header" id="heading-{{ $dayCollapseId }}">
                            <button
                                class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#{{ $dayCollapseId }}"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-controls="{{ $dayCollapseId }}">
                                <span class="itinerary-day-accordion__head">
                                    <span class="itinerary-day__label">Ngày {{ $index + 1 }}</span>
                                    <span class="itinerary-day-accordion__title">{{ $dayName ?: 'Chi tiết hành trình' }}</span>
                                </span>
                            </button>
                        </h3>
                        <div
                            id="{{ $dayCollapseId }}"
                            class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                            aria-labelledby="heading-{{ $dayCollapseId }}"
                            data-bs-parent="#itineraryDaysAccordion-{{ $detail->id }}">
                            <div class="accordion-body">
                                @if($dayContent)
                                <div class="wrapper">{!! $dayContent !!}</div>
                                @else
                                <p class="text-muted mb-0">Chưa có nội dung cho ngày này.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @endforeach
                </div>
                @endif
            </div>

            <div class="col-xl-4 col-lg-5 itinerary-detail-sidebar-col">
                <div class="sidebar itinerary-detail-sidebar">
                    @if(isset($itineraries) && $itineraries->count() > 1)
                    <div class="itinerary-detail-sidebar__others">
                        <h3 class="sidebar__title">Hải trình khác</h3>
                        <nav class="itinerary-detail__nav">
                            @foreach($itineraries as $item)
                            <a href="{{ route('haitrinhDetail', ['slug' => $item->slug]) }}"
                               class="{{ $item->id === $detail->id ? 'active' : '' }}">
                                {{ $item->name }}
                            </a>
                            @endforeach
                        </nav>
                    </div>
                    @endif
                    <br>
                    @include('partials.service-register-form', [
                        'idPrefix' => 'itinerary_register',
                        'title' => 'Đăng ký hải trình',
                        'itineraries' => $itineraries,
                        'selectedItinerary' => old('itinerary', $detail->name),
                        'showItineraryPlaceholder' => false,
                        'useLanguageName' => true,
                        'cardClass' => 'service-register-card--sticky',
                    ])

                   
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
