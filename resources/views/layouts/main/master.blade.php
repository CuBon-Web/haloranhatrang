{{--  https://html.kodesolution.com/2023/voyacht-html/index.html --}}
<!DOCTYPE html>
<html lang="vi">

<head>
    @php
        $seoCanonical = trim($__env->yieldContent('canonical')) ?: seo_canonical_url();
        $seoRobots = trim($__env->yieldContent('robots')) ?: seo_robots_directive();
        $seoTitle = trim($__env->yieldContent('title'));
        $seoDescription = trim($__env->yieldContent('description'));
        $seoImage = trim($__env->yieldContent('image'));
        $seoSiteName = $setting->webname ?? ($setting->company ?? config('app.name'));
    @endphp
    <meta charset="UTF-8" />
    <meta name="theme-color" content="#d70018">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seoTitle }}</title>
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <meta http-equiv="Content-Language" content="vi" />
    <link rel="alternate" href="{{ $seoCanonical }}" hreflang="vi" />
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="{{ $seoRobots }}" />
    <meta name="googlebot" content="{{ $seoRobots }}">
    <meta name="revisit-after" content="3 days" />
    <meta name="rating" content="General">
    <meta name="application-name" content="{{ $seoSiteName }}" />
    <meta name="theme-color" content="#ed3235" />
    <meta name="msapplication-TileColor" content="#ed3235" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="{{ $seoSiteName }}" />
    @if ($seoImage)
        <link rel="apple-touch-icon-precomposed" href="{{ $seoImage }}" sizes="700x700">
    @endif
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:site_name" content="{{ $seoSiteName }}">
    <meta property="og:image:alt" content="{{ $seoTitle }}">
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="vi_VN" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $seoTitle }}" />
    <meta name="twitter:description" content="{{ $seoDescription }}" />
    <meta name="twitter:image" content="{{ $seoImage }}" />
    <meta name="twitter:url" content="{{ $seoCanonical }}" />
    <meta itemprop="name" content="{{ $seoTitle }}">
    <meta itemprop="description" content="{{ $seoDescription }}">
    <meta itemprop="image" content="{{ $seoImage }}">
    <meta itemprop="url" content="{{ $seoCanonical }}">
    <link rel="canonical" href="{{ $seoCanonical }}">
    @if ($seoImage)
        <link rel="image_src" href="{{ $seoImage }}" />
    @endif
    <link rel="shortcut icon" href="{{ url('' . $setting->favicon) }}" type="image/x-icon">
    <link rel="icon" href="{{ url('' . $setting->favicon) }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @hasSection('schema')
        @yield('schema')
    @else
        @include('partials.seo-organization')
    @endif
    @include('partials.google-fonts')
    <!-- Stylesheets -->
    <link href="/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/frontend/css/style.css" rel="stylesheet">
    <link href="/frontend/css/swiper.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/frontend/callbutton/call-button.css">
    <link href="/frontend/css/lazy-images.css" rel="stylesheet">
    <link href="/frontend/googletranslate/google-translate-lang.css" rel="stylesheet">
    @yield('css')
</head>

<body class="@yield('body_class')">
    <div id="google_translate_element" class="notranslate" aria-hidden="true"></div>
    <div class="page-wrapper">
        <!-- Preloader -->
        <div class="preloader"></div>
        <!-- Main Header-->
        @include('layouts.header.index')
        <!--End Main Header -->
        @yield('content')
        <!-- Main Footer -->
        @include('layouts.footer.index')
        <!--End Main Footer -->
        @include('partials.call-button')
        @include('partials.book-now-modal')
    </div>
    <!-- Scroll To Top -->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>
    <script src="/frontend/js/jquery.js"></script>
    <script src="/frontend/js/popper.min.js"></script>
    <script src="/frontend/js/bootstrap.min.js"></script>
    <script src="/frontend/js/jquery.fancybox.js"></script>
    <script src="/frontend/js/jquery-ui.js"></script>
    <script src="/frontend/js/gsap.min.js"></script>
    <script src="/frontend/js/ScrollTrigger.min.js"></script>
    <script src="/frontend/js/swiper.min.js"></script>
    <script src="/frontend/js/splitType.js"></script>
    <script src="/frontend/js/wow.js"></script>
    <script src="/frontend/js/appear.js"></script>
    <script src="/frontend/js/owl.js"></script>
    <script src="/frontend/js/bxslider.js"></script>
    <script src="/frontend/js/script.js"></script>
    <script src="/frontend/callbutton/call-button.js"></script>
    <script src="/frontend/js/lazy-images.js" defer></script>
    <script src="/frontend/googletranslate/google-translate-lang.js" defer></script>
    <!-- form submit -->
    <script src="/frontend/js/jquery.validate.min.js"></script>
    <script src="/frontend/js/jquery.form.min.js"></script>
    @yield('js')
</body>

</html>
