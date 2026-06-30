@php
    $frontendStyles = [
        'frontend/css/bootstrap.min.css',
        'frontend/plugins/revolution/css/settings.css',
        'frontend/plugins/revolution/css/layers.css',
        'frontend/plugins/revolution/css/navigation.css',
        'frontend/css/style.css',
        'frontend/css/swiper.min.css',
        'frontend/callbutton/call-button.css',
    ];
    $preloadStyles = [
        'frontend/css/bootstrap.min.css',
        'frontend/css/style.css',
    ];
@endphp
@foreach ($preloadStyles as $style)
<link rel="preload" href="{{ frontend_asset($style) }}" as="style">
@endforeach
@foreach ($frontendStyles as $style)
<link rel="stylesheet" href="{{ frontend_asset($style) }}">
@endforeach
