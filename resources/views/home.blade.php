@extends('layouts.main.master')
@section('title')
    {{ $setting->company }}
@endsection
@section('description')
    {{ $setting->webname }}
@endsection
@section('image')
    @php
        $ogBanner = $banner->first();
        $ogImage = $ogBanner && $ogBanner->image ? url($ogBanner->image) : url($setting->logo ?? '');
    @endphp
    {{ $ogImage }}
@endsection
@section('css')
@include('partials.revolution-slider-styles')
<style>
    
    .main-slider .rs-background-video-layer iframe {
        visibility: inherit !important;
        opacity: 1 !important;
    }

    .main-slider .slider-slide-overlay {
        position: absolute;
        inset: 0;
        z-index: 3;
        pointer-events: none;
        background: linear-gradient(323deg, rgb(1 20 37 / 38%) 0%, rgb(1 20 37 / 35%) 42%, rgb(0 0 0 / 5%) 100%);
    }

    .main-slider .slotholder {
        position: relative;
    }

    .main-slider .slotholder::after {
        content: '';
        position: absolute;
        inset: 0;
        z-index: 2;
        pointer-events: none;
        background: linear-gradient(323deg, rgb(1 20 37 / 38%) 0%, rgb(1 20 37 / 35%) 42%, rgb(0 0 0 / 5%) 100%);
    }

    .main-slider .rs-background-video-layer {
        position: relative;
    }

    .main-slider .rs-background-video-layer::after {
        content: '';
        position: absolute;
        inset: 0;
        z-index: 2;
        pointer-events: none;
        background: linear-gradient(323deg, rgb(1 20 37 / 38%) 0%, rgb(1 20 37 / 35%) 42%, rgb(0 0 0 / 5%) 100%);
    }

    .main-slider .slider-caption-stack {
        z-index: 10 !important;
        text-shadow: 0 2px 18px rgba(0, 0, 0, 0.35);
    }

    .main-slider .slider-caption-stack .title {
        text-shadow: 0 2px 24px rgba(0, 0, 0, 0.45);
    }

    .main-slider .banner-description {
        color: #fff;
        font-size: 18px;
        line-height: 1.6;
        max-width: 700px;
        margin-top: 0;
    }

    .main-slider .slider-caption-stack {
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-start;
        gap: 16px;
        width: 100%;
        max-width: 760px;
    }

    .main-slider .slider-caption-stack > div {
        display: flex !important;
        flex-direction: column !important;
        align-items: inherit;
        gap: inherit;
        width: 100%;
    }

    .main-slider .slider-caption-stack__brand {
        display: block;
        font-family: var(--style-font);
        font-size: 120px;
        font-weight: 400;
        line-height: 1.1;
        letter-spacing: 4px;
        color: #fff;
        opacity: 0.92;
        margin: 0;
    }

    .main-slider .slider-caption-stack .title {
        margin: 0;
        line-height: 1.15;
        text-transform: none;
    }

    .main-slider .slider-caption-stack .banner-description {
        max-width: 100%;
    }

    .main-slider .slider-caption-stack .theme-btn {
        margin-top: 4px;
    }

    @media (max-width: 1039.98px) {
        .main-slider .slider-caption-stack {
            max-width: 640px;
            gap: 14px;
        }

        .main-slider .slider-caption-stack__brand {
            font-size: 28px;
        }
    }

    @media (max-width: 801.98px) {
        .main-slider .slider-caption-stack,
        .main-slider .slider-caption-stack > div {
            align-items: center !important;
        }

        .main-slider .slider-caption-stack {
            align-items: center;
            text-align: center;
            max-width: 92%;
            gap: 12px;
            padding: 0 12px;
        }

        .main-slider .slider-caption-stack__brand {
            font-size: 24px;
            letter-spacing: 3px;
        }

        .main-slider .slider-caption-stack .title {
            line-height: 1.2;
            font-size: 34px;
        }

        .main-slider .banner-description {
            font-size: 16px;
            line-height: 1.55;
        }
    }

    @media (max-width: 575.98px) {
        .main-slider .slider-caption-stack {
            gap: 10px;
            padding: 0 8px;
        }

        .main-slider .slider-caption-stack__brand {
            font-size: 40px;
        }

        .main-slider .slider-caption-stack .title {
            font-size: 26px;
        }

        .main-slider .banner-description {
            font-size: 14px;
        }

        .main-slider .slider-caption-stack .theme-btn {
            margin-top: 2px;
            padding: 10px 24px;
        }
    }

    .main-slider .title + .banner-description {
        margin-top: 0;
    }
    .main-slider .banner-description p {
        color: #fff;
    }
    .main-slider .banner-description p:last-child {
        margin-bottom: 0;
    }

    /* .back-about {
        position: relative;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        overflow: hidden;
    } */

    .about-section .inner-column.back-about {
        background-color: transparent;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        border-radius: 10px;
    }

    /* .back-about::after {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 36, 54, 0.048);
        z-index: 0;
        pointer-events: none;
    } */

   .back-about > .auto-container {
        position: relative;
        z-index: 1;
    }

    .about-section .about-panel {
        position: relative;
        z-index: 2;
        max-width: 560px;
        margin-left: auto;
        padding: 44px 48px;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 32px;
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
    }

    .about-section .about-panel .sec-title {
        margin-bottom: 22px;
    }

    .about-section .about-panel .sec-title .sub-title {
        display: block;
        margin-bottom: 14px;
        font-family: var(--style-font);
        font-size: 30px;
        font-weight: 400;
        color: #fff;
        letter-spacing: 0;
        text-transform: none;
        line-height: 1.1;
    }

    .about-section .about-panel .sec-title h2 {
        color: #fff;
        font-family: var(--title-font);
        font-size: 36px;
        font-weight: 400;
        font-style: italic;
        line-height: 1.35;
        margin-bottom: 0;
        text-transform: none;
    }

    .about-section .about-panel .text {
        color: #fff;
        font-family: var(--text-font);
        font-size: 15px;
        font-weight: 400;
        line-height: 1.8;
        text-align: left;
    }

    @media (max-width: 991.98px) {
        .about-section .about-panel {
            max-width: 100%;
            margin-left: 0;
        }
    }

    @media (max-width: 767.98px) {
        .about-section .about-panel {
            padding: 28px 24px;
            border-radius: 22px;
        }

        .about-section .about-panel .sec-title h2 {
            font-size: 28px;
        }

        .about-section .about-panel .sec-title .sub-title {
            font-size: 24px;
        }
    }

    .destination-section .tabs-content .icon-wheel-compass-3 {
        display: none;
    }

    .destination-section .itinerary-map-wrap {
        width: 100%;
        max-width: 920px;
        margin: 20px auto 0;
        padding: 0 16px;
    }

    .destination-section .itinerary-map-figure {
        margin: 0;
    }

    .destination-section .itinerary-map-img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
        aspect-ratio: 16 / 10;
    }

    .destination-section .itinerary-map-title {
        margin: 22px 0 0;
        color: var(--theme-color2);
        font-family: var(--title-font);
        font-size: 30px;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        line-height: 1.3;
    }

    @media (max-width: 767.98px) {
        .destination-section .itinerary-map-wrap {
            margin-top: 20px;
        }

        .destination-section .itinerary-map-figure {
            border-radius: 14px;
        }

        .destination-section .itinerary-map-title {
            font-size: 22px;
            letter-spacing: 1px;
        }
    }

    .services-section .service-block .inner-box {
        background: linear-gradient(
            150deg,
            #0a3d62 0%,
            #1a6b8a 48%,
            #2a9d8f 90%,
            rgba(144, 224, 239, 0.35) 100%
        );
        border-color: rgba(20, 99, 138, 0.3);
        overflow: hidden;
        box-shadow: 0 12px 32px rgba(10, 61, 98, 0.08);
    }

    /* Home contact form — promo style */
    .contact-section.home-promo-form-section {
        position: relative;
        /* overflow: hidden chặn backdrop-filter lấy ảnh nền phía sau */
        overflow: visible;
    }

    .contact-section.home-promo-form-section::before {
        content: '';
        position: absolute;
        inset: 0;
        /* Overlay nhẹ hơn để ảnh nền lộ qua khung glass — blur mới thấy rõ */
        background: rgba(0, 0, 0, 0.28);
        z-index: 0;
        pointer-events: none;
    }

    .contact-section.home-promo-form-section .auto-container {
        position: relative;
        z-index: 1;
    }

    .contact-section.home-promo-form-section .form-column .inner-column {
        padding: 80px 0 90px;
    }

    .home-contact-form__wrap {
        max-width: 620px;
        margin: 0 auto;
        text-align: center;
    }

    .home-contact-form__header {
        margin-bottom: 28px;
        color: #fff;
    }

    .home-contact-form__eyebrow {
        display: block;
        margin-bottom: 10px;
        font-family: var(--text-font);
        font-size: 13px;
        font-weight: 500;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.88);
    }

    .home-contact-form__title {
        margin: 0 0 14px;
        font-family: var(--title-font);
        font-size: clamp(30px, 4vw, 42px);
        font-weight: 400;
        font-style: italic;
        line-height: 1.2;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: #fff;
    }

    .home-contact-form__desc {
        margin: 0 auto;
        max-width: 520px;
        font-family: var(--text-font);
        font-size: 14px;
        line-height: 1.75;
        color: rgba(255, 255, 255, 0.88);
    }

    .contact-section .contact-form.home-contact-form {
        padding: 0;
        background: transparent;
        border-radius: 0;
    }

    .home-contact-form__box {
        position: relative;
        margin-top: 8px;
        padding: 36px 32px 32px;
        border: 1px solid rgba(255, 255, 255, 0.45);
        border-radius: 20px;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.25);
        /* Cần nền bán trong suốt — không có thì blur gần như không nhìn thấy */
        background: rgba(0, 0, 0, 0.22);
        backdrop-filter: blur(16px) saturate(1.15);
        -webkit-backdrop-filter: blur(16px) saturate(1.15);
    }

    .contact-section .contact-form.home-contact-form .home-contact-form__label {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    .contact-section .contact-form.home-contact-form .home-contact-form__control > i {
        display: none;
    }

    .contact-section .contact-form.home-contact-form input:not([type=submit]):not([type=hidden]),
    .contact-section .contact-form.home-contact-form select,
    .contact-section .contact-form.home-contact-form textarea {
        width: 100%;
        height: 48px;
        padding: 12px 22px;
        border: 1px solid rgba(255, 255, 255, 0.85);
        border-radius: 999px;
        background: transparent;
        color: #fff;
        font-size: 14px;
        line-height: 1.4;
        box-shadow: none;
        transition: border-color 0.25s ease, background-color 0.25s ease;
    }

    .contact-section .contact-form.home-contact-form select {
        appearance: none;
        background-color: transparent;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23ffffff' d='M6 8 0 0h12z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
        padding-right: 44px;
        cursor: pointer;
    }

    .contact-section .contact-form.home-contact-form select option {
        color: #222;
        background: #fff;
    }

    .contact-section .contact-form.home-contact-form textarea {
        height: auto;
        min-height: 48px;
        border-radius: 24px;
        padding-top: 14px;
        padding-bottom: 14px;
        resize: vertical;
    }

    .contact-section .contact-form.home-contact-form ::placeholder {
        color: rgba(255, 255, 255, 0.92);
        opacity: 1;
    }

    .contact-section .contact-form.home-contact-form input:not([type=submit]):not([type=hidden]):focus,
    .contact-section .contact-form.home-contact-form select:focus,
    .contact-section .contact-form.home-contact-form textarea:focus {
        outline: none;
        border-color: #fff;
        background: rgba(255, 255, 255, 0.08);
        box-shadow: none;
    }

    .contact-section .contact-form.home-contact-form .form-group {
        margin-bottom: 14px;
    }

    .contact-section .contact-form.home-contact-form .home-contact-form__submit {
        margin-top: 8px;
        width: 100%;
        min-height: 48px;
        padding: 12px 24px;
        border: none !important;
        border-radius: 999px !important;
        background: #e5d1b3 !important;
        color: #1a1a1a !important;
        font-family: var(--text-font);
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        box-shadow: none;
    }

    .contact-section .contact-form.home-contact-form .home-contact-form__submit:hover {
        background: #d9c4a3 !important;
        color: #000 !important;
    }

    .contact-section .contact-form.home-contact-form .home-contact-form__submit .btn-title {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: inherit;
    }

    .contact-section .contact-form.home-contact-form .home-contact-form__submit .btn-title i {
        display: inline-block;
        font-size: 14px;
    }

    @media (max-width: 767.98px) {
        .contact-section.home-promo-form-section .form-column .inner-column {
            padding: 56px 0 64px;
        }

        .home-contact-form__box {
            padding: 28px 20px 24px;
            border-radius: 16px;
        }

        .home-contact-form__title {
            font-size: 28px;
        }

        .contact-section .contact-form.home-contact-form input:not([type=submit]):not([type=hidden]),
        .contact-section .contact-form.home-contact-form select {
            height: 46px;
            font-size: 13px;
        }
    }

</style>
@endsection
@section('js')
@include('partials.revolution-slider-scripts')
<script>
(function () {
    var serviceSelect = document.getElementById('home_contact_service');
    var slugInput = document.getElementById('home_contact_service_slug');
    if (!serviceSelect || !slugInput) return;

    var syncSlug = function () {
        var option = serviceSelect.options[serviceSelect.selectedIndex];
        slugInput.value = option ? (option.getAttribute('data-slug') || '') : '';
    };

    serviceSelect.addEventListener('change', syncSlug);
    syncSlug();
})();
</script>
@endsection
@section('content')
<!--Main Slider-->
<section class="main-slider">
   <div class="outer-box">
       <div class="rev_slider_wrapper fullwidthbanner-container" id="rev_slider_one_wrapper"
           data-source="gallery">
           <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
               <ul>
                   @foreach ($banner as $item)
                   @php
                       $bannerDescription = languageName($item->description);
                       $slideImage = $item->image
                           ? url($item->image)
                           : ($item->isYoutube()
                               ? 'https://img.youtube.com/vi/' . $item->youtube_id . '/hqdefault.jpg'
                               : '');
                       $slideAlt = strip_tags($item->title ?: $bannerDescription);
                       $videoOrigin = url('/');
                   @endphp
                   <li data-index="rs-{{ $loop->iteration }}" data-transition="fade" data-masterspeed="2000">
                       @if ($loop->first)
                       <img src="{{ $slideImage }}" alt="{{ $slideAlt }}" class="rev-slidebg" fetchpriority="high">
                       @else
                       <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                           data-lazyload="{{ $slideImage }}" alt="{{ $slideAlt }}" class="rev-slidebg">
                       @endif
                       @if ($item->isYoutube())
                       <div class="rs-background-video-layer"
                           data-ytid="{{ $item->youtube_id }}"
                           data-videowidth="100%"
                           data-videoheight="100%"
                           data-volume="mute"
                           data-autoplay="true"
                           data-autoplayonlyfirsttime="false"
                           data-videoloop="loopandnoslidestop"
                           data-forcerewind="on"
                           data-aspectratio="16:9"
                           data-videoattributes="version=3&enablejsapi=1&html5=1&hd=1&wmode=opaque&showinfo=0&rel=0&origin={{ $videoOrigin }}">
                       </div>
                       @endif
                       <div class="slider-slide-overlay" aria-hidden="true"></div>
                       @if ($setting->company || $item->title || $bannerDescription || $item->link)
                       <div class="tp-caption slider-caption-stack"
                           data-paddingbottom="[0,0,0,0]"
                           data-paddingleft="[15,15,15,15]"
                           data-paddingright="[15,15,15,15]"
                           data-paddingtop="[0,0,0,0]"
                           data-responsive_offset="on"
                           data-type="text"
                           data-height="none"
                           data-width="['950','800','700','420']"
                           data-whitespace="normal"
                           data-hoffset="['80','40','0','0']"
                           data-voffset="['0','0','0','0']"
                           data-x="['left','left','center','center']"
                           data-y="['middle','middle','middle','middle']"
                           data-textalign="['left','left','center','center']"
                           data-frames='[{"delay":1200,"speed":1800,"frame":"0","from":"x:[-120%];o:0;z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","to":"o:1;x:0;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                           {{-- @if ($setting->company)
                           <span class="slider-caption-stack__brand">Halora</span>
                           @endif --}}
                           @if ($item->title)
                           <h1 class="title" style="color:#fff;">{!! $item->title !!}</h1>
                           @endif
                           @if ($bannerDescription)
                           <div class="banner-description">{!! $bannerDescription !!}</div>
                           @endif
                           @if ($item->link)
                           <a href="{{ $item->link }}"
                               class="theme-btn slider-btn-style-one btn-style-two"><span
                                   class="btn-title">Xem thêm</span></a>
                           @endif
                       </div>
                       @endif
                   </li>
                   @endforeach
               </ul>
           </div>
       </div>
   </div>
</section>
<section class="form-booking">
   <div class="auto-container">
       <form class="booking-inline-form" action="#" method="get">
           <div class="booking-field">
               <label for="departure-date">Ngày khởi hành</label>
               <input type="text" id="departure-date" name="departure_date"
                   placeholder="Chọn ngày khởi hành" autocomplete="off">
           </div>
           <div class="booking-field">
               <label for="service-type">Dịch vụ</label>
               <select id="service-type" name="service">
                   <option value="">Chọn dịch vụ</option>
                   <option value="private-yacht">Thuê du thuyền riêng</option>
                   <option value="sunset-tour">Tour hoàng hôn</option>
                   <option value="island-trip">Tour tham quan đảo</option>
               </select>
           </div>
           <div class="booking-field">
               <label for="guest-count">Số lượng khách</label>
               <select id="guest-count" name="guests">
                   <option value="">Chọn số khách</option>
                   <option value="1-2">1 - 2 khách</option>
                   <option value="3-5">3 - 5 khách</option>
                   <option value="6-10">6 - 10 khách</option>
                   <option value="10+">Trên 10 khách</option>
               </select>
           </div>
           <div class="booking-field">
               <label for="promo-code">Mã khuyến mãi</label>
               <input type="text" id="promo-code" name="promo_code" placeholder="Nhập mã khuyến mãi">
           </div>
           <div class="booking-field booking-action">
               <button type="submit" class="theme-btn btn-style-two"><span class="btn-title">Tìm
                       kiếm</span></button>
           </div>
       </form>
   </div>
</section>
<!-- End Main Slider-->
<!-- About Section -->
<section class="about-section">
   <div class="auto-container">
       <div class="outer-box">
           <div class="row">
               <div class="content-column col-xl-9 offset-xl-3 col-lg-9 offset-lg-3">
                @php
                $aboutImages = (!empty($gioithieu) && !empty($gioithieu->image))
                    ? json_decode($gioithieu->image, true)
                    : [];
                $aboutBoatImage = (is_array($aboutImages) && !empty($aboutImages[0]))
                    ? url($aboutImages[0])
                    : '';
                $aboutBackgroundImage = (is_array($aboutImages) && !empty($aboutImages[1]))
                    ? url($aboutImages[1])
                    : '';
            @endphp
                   <div class="inner-column back-about" data-bg-lazy="{{ url($aboutBackgroundImage) }}">
                       <div class="inner">
                          
                           <div class="icon-wheel-1"></div>
                           <div class="icon-big-boat-1 bounce-x"@if($aboutBoatImage) data-bg-lazy="{{ $aboutBoatImage }}"@endif></div>
                           <div class="about-panel">
                               <div class="sec-title">
                                   <span class="sub-title">About Us</span>
                                   <h2 class="words-slide-up text-split">Hệ sinh thái Halora Holding</h2>
                               </div>
                               <div class="text">{!! languageName($gioithieu->description) !!}</div>
                               <a href="{{ route('aboutUs') }}"
                               class="theme-btn btn-style-two"><span
                                   class="btn-title">Xem thêm</span></a>
                              </div>
                              
                           {{-- <div class="bottom-box">
                               <div class="since-box">
                                   <div class="inner">
                                       <figure class="image"><img
                                               src="https://html.kodesolution.com/2023/voyacht-html/images/resource/about1-1.jpg"
                                               alt="Image"></figure>
                                       <div class="since-info">
                                           <h6 class="since-title">Since year</h6>
                                           <div class="since-year">1992</div>
                                       </div>
                                   </div>
                               </div>
                           </div> --}}
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</section>



<!--End About Section -->
<!-- Marquee Section -->
<section class="marquee-section">
   <div class="marquee">
       <div class="marquee-group">
           <div class="text" data-text="HALORA NHA TRANG CRUISE">HALORA NHA TRANG CRUISE</div>
       </div>
       <div aria-hidden="true" class="marquee-group">
           <div class="text" data-text="HALORA NHA TRANG CRUISE">HALORA NHA TRANG CRUISE</div>
           
       </div>
   </div>
</section>
<!-- End Marquee Section -->
<section class="video-section">
   <div class="bg bg-image"
       data-bg-lazy="/frontend/images/bg-video1.jpg">
   </div>
   <div class="auto-container">
       <div class="row justify-content-center">
           <div class="col-xl-10">
               <div class="outer-box">
                   <a href="{{$setting->GA}}" class="play-now"
                       data-fancybox="gallery" data-caption=""> <i class="icon fa-thin fa-play"
                           aria-hidden="true"></i> <span class="ripple"></span> </a>
                   <h2 class="title words-slide-up text-split"> Trải nghiệm tại Halora Nha Trang Cruise</h2>
                   <div class="text">Sự kết hợp tinh tế giữa thưởng ngoạn, ẩm thực và sự kiện, kiến tạo những khoảng lặng thong thả giữa lòng đại dương.</p>
               </div>
           </div>
       </div>
       <div class="row align-items-center section-onepage section-home-2">
         
         <div class="col-lg-12 col-12 position-relative">
             <div id="swiperThemarina" class="swiper-partner-themarina position-relative">
                 <div class="swiper mySwiper">
                     <div class="swiper-wrapper">
                        @foreach ($servicehome as $item)
                        <div class="swiper-slide">
                            <div class="item">
                                <div class="image hover-scale">
                                    <a href="{{route('serviceList',['slug'=>$item->slug])}}" title="{{ languageName($item->name) }}"><img
                                            src="{{ url(json_decode($item->image, true)[0]) }}"
                                            alt="{{ languageName($item->name) }}" class="img-fluid"
                                            loading="lazy" decoding="async"></a>
                                    <div class="title">
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                height="20" viewBox="0 0 18 20" fill="none">
                                                <path
                                                    d="M16.213 10.3644C15.6153 11.0461 15.0353 11.7072 14.4178 12.4111H15.413C15.0001 15.2052 12.0882 17.0631 9.73203 17.1365C9.73203 13.9658 9.73203 10.7951 9.73203 7.60087H13.3115V6.24697H9.73203V4.83731C10.7972 4.52714 11.5719 3.58594 11.5719 2.47271C11.5719 1.10723 10.4065 0 8.96815 0C7.52985 0 6.36439 1.10723 6.36439 2.47271C6.36439 3.60438 7.16531 4.55803 8.25804 4.85189V6.25984H4.69526V7.61417H8.25804V17.1494C5.35252 16.9546 2.85582 14.7367 2.60511 12.3974H3.57362C2.96198 11.6999 2.38106 11.0375 1.7902 10.3644C1.19663 11.0409 0.615705 11.7033 0 12.4047H1.10764C1.12796 12.5008 1.14784 12.5754 1.16004 12.651C1.41888 14.2661 2.23696 15.5878 3.51986 16.6543C4.76799 17.692 6.23475 18.278 7.87271 18.4904C8.12071 18.5226 8.21828 18.5367 8.25849 18.6281V19.432L8.99571 20L9.73293 19.432V19.0026C9.74377 18.9249 9.74467 18.8434 9.73293 18.7564V18.5753C9.75687 18.5406 9.80385 18.5226 9.86574 18.5166C10.055 18.4981 10.2456 18.4839 10.4327 18.4526C11.7517 18.2304 12.9682 17.7701 14.0402 16.9992C15.3493 16.058 16.2685 14.8547 16.695 13.3352C16.7799 13.0323 16.8359 12.7222 16.9082 12.4009H18C17.3857 11.7012 16.8034 11.0375 16.213 10.3644ZM7.75165 2.47271C7.75165 1.8348 8.29643 1.31743 8.96815 1.31743C9.63987 1.31743 10.1847 1.8348 10.1847 2.47271C10.1847 3.11062 9.63987 3.62798 8.96815 3.62798C8.29643 3.62798 7.75165 3.11104 7.75165 2.47271Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        {{ languageName($item->name) }}
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="title">
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                height="20" viewBox="0 0 18 20" fill="none">
                                                <path
                                                    d="M16.213 10.3644C15.6153 11.0461 15.0353 11.7072 14.4178 12.4111H15.413C15.0001 15.2052 12.0882 17.0631 9.73203 17.1365C9.73203 13.9658 9.73203 10.7951 9.73203 7.60087H13.3115V6.24697H9.73203V4.83731C10.7972 4.52714 11.5719 3.58594 11.5719 2.47271C11.5719 1.10723 10.4065 0 8.96815 0C7.52985 0 6.36439 1.10723 6.36439 2.47271C6.36439 3.60438 7.16531 4.55803 8.25804 4.85189V6.25984H4.69526V7.61417H8.25804V17.1494C5.35252 16.9546 2.85582 14.7367 2.60511 12.3974H3.57362C2.96198 11.6999 2.38106 11.0375 1.7902 10.3644C1.19663 11.0409 0.615705 11.7033 0 12.4047H1.10764C1.12796 12.5008 1.14784 12.5754 1.16004 12.651C1.41888 14.2661 2.23696 15.5878 3.51986 16.6543C4.76799 17.692 6.23475 18.278 7.87271 18.4904C8.12071 18.5226 8.21828 18.5367 8.25849 18.6281V19.432L8.99571 20L9.73293 19.432V19.0026C9.74377 18.9249 9.74467 18.8434 9.73293 18.7564V18.5753C9.75687 18.5406 9.80385 18.5226 9.86574 18.5166C10.055 18.4981 10.2456 18.4839 10.4327 18.4526C11.7517 18.2304 12.9682 17.7701 14.0402 16.9992C15.3493 16.058 16.2685 14.8547 16.695 13.3352C16.7799 13.0323 16.8359 12.7222 16.9082 12.4009H18C17.3857 11.7012 16.8034 11.0375 16.213 10.3644ZM7.75165 2.47271C7.75165 1.8348 8.29643 1.31743 8.96815 1.31743C9.63987 1.31743 10.1847 1.8348 10.1847 2.47271C10.1847 3.11062 9.63987 3.62798 8.96815 3.62798C8.29643 3.62798 7.75165 3.11104 7.75165 2.47271Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        {{ languageName($item->name) }}
                                    </div>
                                    <div class="desc">
                                        <p class="text-white">
                                            {!! languageName($item->description) !!}
                                        </p>
                                        <a href="{{route('serviceList',['slug'=>$item->slug])}}"
                                        class="theme-btn btn-style-two"><span
                                            class="btn-title">Xem chi tiết</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                         
                     </div>
                 </div>
                 <div class="swiper-button">
                     <div class="swiper-button-prev">
                         <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                             viewBox="0 0 40 40" fill="none">
                             <circle cx="20" cy="20" r="19.5" stroke="white"
                                 stroke-opacity="1" />
                             <path
                                 d="M11.6464 19.6464C11.4512 19.8417 11.4512 20.1583 11.6464 20.3536L14.8284 23.5355C15.0237 23.7308 15.3403 23.7308 15.5355 23.5355C15.7308 23.3403 15.7308 23.0237 15.5355 22.8284L12.7071 20L15.5355 17.1716C15.7308 16.9763 15.7308 16.6597 15.5355 16.4645C15.3403 16.2692 15.0237 16.2692 14.8284 16.4645L11.6464 19.6464ZM28 19.5H12V20.5H28V19.5Z"
                                 fill="white" fill-opacity="1" />
                         </svg>
                     </div>
                     <div class="swiper-button-next">
                         <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                             viewBox="0 0 40 40" fill="none">
                             <circle cx="20" cy="20" r="19.5" transform="matrix(-1 0 0 1 40 0)"
                                 stroke="white" />
                             <path
                                 d="M28.3536 19.6464C28.5488 19.8417 28.5488 20.1583 28.3536 20.3536L25.1716 23.5355C24.9763 23.7308 24.6597 23.7308 24.4645 23.5355C24.2692 23.3403 24.2692 23.0237 24.4645 22.8284L27.2929 20L24.4645 17.1716C24.2692 16.9763 24.2692 16.6597 24.4645 16.4645C24.6597 16.2692 24.9763 16.2692 25.1716 16.4645L28.3536 19.6464ZM12 19.5H28V20.5H12V19.5Z"
                                 fill="white" />
                         </svg>
                     </div>
                 </div>
             </div>
         </div>
     </div>
   </div>
</section>
<section class="destination-section itinerary-page-section">
    <div class="auto-container">
        @if(isset($haitrinh) && $haitrinh->count())
        <div class="itinerary-page__intro wow fadeInUp">
            <h2>Dịch vụ của chúng tôi</h2>
            <p>Chọn tuyến đi phù hợp — xem mô tả và bản đồ hành trình chi tiết bên dưới.</p>
        </div>

        <div class="itinerary-page__tabs default-tabs tabs-box wow fadeInUp" data-wow-delay="150ms">
            <ul class="itinerary-page__tab-nav tab-buttons clearfix">
                @foreach($haitrinh as $index => $item)
                <li class="tab-btn {{ $index === 0 ? 'active-btn' : '' }}" data-tab="#itinerary-tab-{{ $item->id }}">
                    <span class="title">{{ $item->name }}</span>
                </li>
                @endforeach
            </ul>

            <div class="tabs-content">
                @foreach($haitrinh as $index => $item)
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
@if(isset($duan) && $duan->count())
 <section class="services-section">
    <div class="bg bg-image" data-bg-lazy="/frontend/images/pattern1-3.png"></div>
    <div class="auto-container">
      <div class="outer-box">
        <div class="bg-two bg-image" data-bg-lazy="/frontend/images/pattern1-4.png"></div>
          <h2 class="words-slide-up text-split">Ưu đãi</h2>
        </div>
        <div class="row services-content"> 
            @foreach ($duan as $item)
                <!-- Service Block -->
          <div class="service-block col-lg-4 col-md-6 wow fadeInUp">
            <div class="inner-box">
              <div class="image-box">
                <figure class="image"><a href="{{route('duanTieuBieuDetail',['slug'=>$item->slug])}}"><img src="{{ url(json_decode($item->images, true)[0]) }}" alt="{{ languageName($item->name) }}" loading="lazy" decoding="async"></a></figure>
              </div>
              <div class="content-box">
                <div class="info-box">
                  <h5 class="title"><a href="{{route('duanTieuBieuDetail',['slug'=>$item->slug])}}">{{ languageName($item->name) }}</a></h5>
                  <div class="text">{!! languageName($item->description) !!}</div>
                </div>
                <ul class="service-list">
                  <li>Giá: {{ $item->location }}</li>
                </ul>
              </div>
            </div>
          </div>
            @endforeach
        </div>
      </div>
    </div>
  </section>
  @endif
<!-- Testimonial Section -->
<section class="testimonial-section">
    <div class="bg bg-image"
       data-bg-lazy="/frontend/images/bg-feedback.jpg">
   </div>
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2 class="words-slide-up text-split text-white">Trải nghiệm khách hàng
            </h2>
        </div>
        <div class="carousel-outer">
            <div class="testimonial-carousel owl-carousel owl-theme default-dots">
                <!-- Testimonial Block -->
                @foreach ($ReviewCus as $item)
                <div class="testimonial-block">
                    <div class="inner-box">
                        <div class="text">{!! languageName($item->content) !!}</div>
                        <div class="info-box">
                            <div class="info-box-content">
                                <h6 class="name">{!! languageName($item->name) !!}</h6>
                                <span class="designation">{!! languageName($item->position) !!}</span>
                                <span class="star">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star" style="color: #9d8710;"></i>
                                    @endfor
                                </span>
                            </div>
                        </div>
                        <div class="icon-quote"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
 </section>
 <!-- End Testimonial Section -->

<!-- Blog Section -->
<section class="blog-section">
   <div class="icon-plane-4 bounce-y"></div>
   <div class="auto-container">
       <div class="sec-title text-center">
           <h2 class="words-slide-up text-split">Tin tức & Sự Kiện</h2>
       </div>
       <div class="row">
        @foreach ($hotnews as $item)
            <!-- News Block -->
           <div class="blog-block col-lg-4 col-md-6 wow fadeInUp">
            <div class="inner-box">
                <div class="image-box">
                    <figure class="image">
                        <a href="news-details.html">
                            <img src="{{ url(($item->image)) }}"
                                alt="{{ languageName($item->title) }}"
                                loading="lazy" decoding="async">
                            <img src="{{ url(($item->image)) }}"
                                alt="{{ languageName($item->title) }}"
                                loading="lazy" decoding="async">
                        </a>
                    </figure>
                    <span class="date"> <strong>{{date_format($item->created_at,'d')}} <span>{{date_format($item->created_at,'M')}}</span> </strong> </span>
                </div>
                <div class="content-box">
                    <ul class="post-meta">
                        <li><i class="fal fa-user"></i>Admin</li>
                    </ul>
                    <h4 class="title"><a href="{{route('detailBlog',['slug'=>$item->slug])}}">{{languageName($item->title)}}</a></h4>
                    <a class="read-more" href="{{route('detailBlog',['slug'=>$item->slug])}}">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
       </div>
   </div>
</section>
<!--End Blog Section -->
<!-- Contact Section -->
<section class="contact-section home-promo-form-section">
    <div class="bg bg-image"
        data-bg-lazy="/frontend/images/bg-uu-dai.jpg">
    </div>
    <div class="auto-container">
        <div class="outer-box">
            <div class="row justify-content-center">
                <div class="form-column col-lg-10 col-xl-8">
                    <div class="inner-column">
                        <div class="home-contact-form__wrap">
                            <div class="home-contact-form__header">
                                <span class="home-contact-form__eyebrow">Đăng ký</span>
                                <h2 class="home-contact-form__title">Nhận thông tin ưu đãi</h2>
                                <p class="home-contact-form__desc">Chúng tôi sẽ cập nhật cho bạn những tin tức mới nhất, cẩm nang du lịch và các ưu đãi đặc biệt.</p>
                            </div>
                            <div class="contact-form wow fadeInUp home-contact-form">
                                <div class="home-contact-form__box">
                                    <form id="contact_form" method="post" name="contact_form" action="{{ route('postcontact') }}">
                                        @csrf
                                        <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                                        <div class="form-group">
                                            <label class="home-contact-form__label" for="home_contact_name">Họ và tên</label>
                                            <div class="home-contact-form__control">
                                                <input type="text" id="home_contact_name" name="name" placeholder="Nhập họ và tên" required value="{{ old('name') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="home-contact-form__label" for="home_contact_phone">Số điện thoại</label>
                                            <div class="home-contact-form__control">
                                                <input type="tel" id="home_contact_phone" name="phone" placeholder="Nhập số điện thoại" required value="{{ old('phone') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="home-contact-form__label" for="home_contact_service">Dịch vụ</label>
                                            <div class="home-contact-form__control">
                                                <select id="home_contact_service" name="service_name">
                                                    <option value="" data-slug="" {{ old('service_name') ? '' : 'selected' }}>Chọn dịch vụ</option>
                                                    @foreach ($servicehome as $item)
                                                    @php $serviceLabel = strip_tags(languageName($item->name)); @endphp
                                                    <option value="{{ $serviceLabel }}" data-slug="{{ $item->slug }}" {{ old('service_name') == $serviceLabel ? 'selected' : '' }}>
                                                        {{ languageName($item->name) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" id="home_contact_service_slug" name="service_cate_slug" value="{{ old('service_cate_slug') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="home-contact-form__label" for="home_contact_itinerary">Hải trình</label>
                                            <div class="home-contact-form__control">
                                                <select id="home_contact_itinerary" name="itinerary">
                                                    <option value="" {{ old('itinerary') ? '' : 'selected' }}>Chọn hải trình</option>
                                                    @foreach ($haitrinh as $item)
                                                    <option value="{{ $item->name }}" {{ old('itinerary') == $item->name ? 'selected' : '' }}>
                                                        {{ languageName($item->name) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="home-contact-form__label" for="home_contact_email">Email</label>
                                            <div class="home-contact-form__control">
                                                <input type="email" id="home_contact_email" name="email" placeholder="Nhập email (không bắt buộc)" value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="home-contact-form__label" for="home_contact_mess">Nội dung</label>
                                            <div class="home-contact-form__control home-contact-form__control--textarea">
                                                <textarea id="home_contact_mess" name="mess" placeholder="Nhập nội dung cần tư vấn..." rows="3">{{ old('mess') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <input name="form_botcheck" type="hidden" value="" />
                                            <button type="submit" class="theme-btn btn-style-one home-contact-form__submit" data-loading-text="Vui lòng chờ...">
                                                <span class="btn-title"><i class="far fa-paper-plane"></i> Gửi yêu cầu</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 <!-- End Contact Section -->
@endsection
