@php
    $cbwZalo = trim((string) ($setting->phone2 ?? ''));
    if ($cbwZalo === '') {
        $cbwZalo = trim((string) ($setting->phone1 ?? ''));
    }

    $cbw = array_merge([
        'phone' => $setting->phone1 ?? '',
        'facebook' => $setting->facebook ?? '',
        'zalo' => $cbwZalo,
        'messenger' => $setting->google ?? '',
        'position' => 'right',
        'theme' => 'brand',
        'above_totop' => true,
        'hint' => 'Liên hệ ngay',
        'labels' => [
            'phone' => 'Gọi hotline',
            'facebook' => 'Facebook',
            'zalo' => 'Zalo',
            'messenger' => 'Messenger',
        ],
    ], $cbw ?? []);

    $cbwPhone = preg_replace('/\s+/', '', $cbw['phone'] ?? '');
    $cbwZaloDigits = preg_replace('/\D+/', '', $cbw['zalo'] ?? '');
    $cbwMessengerRaw = trim((string) ($cbw['messenger'] ?? ''));
    $cbwMessengerHref = '';
    if ($cbwMessengerRaw !== '') {
        if (preg_match('#^https?://#i', $cbwMessengerRaw)) {
            $cbwMessengerHref = $cbwMessengerRaw;
        } elseif (preg_match('#^(m\.me|www\.messenger\.com|messenger\.com)#i', $cbwMessengerRaw)) {
            $cbwMessengerHref = 'https://' . ltrim($cbwMessengerRaw, '/');
        } else {
            $cbwMessengerHref = 'https://m.me/' . ltrim($cbwMessengerRaw, '@/');
        }
    }
    $hasAny = $cbwPhone || ($cbw['facebook'] ?? '') || $cbwZaloDigits || $cbwMessengerHref;
@endphp

@if($hasAny)
<aside
    class="cbw{{ ($cbw['position'] ?? 'right') === 'left' ? ' cbw--left' : '' }}{{ ($cbw['theme'] ?? 'brand') === 'light' ? ' cbw--theme-light' : '' }}{{ !empty($cbw['above_totop']) ? ' cbw--above-totop' : '' }}"
    id="call-button-widget"
    aria-label="Liên hệ nhanh"
    data-cbw-phone="{{ $cbw['phone'] ?? '' }}"
    data-cbw-facebook="{{ $cbw['facebook'] ?? '' }}"
    data-cbw-zalo="{{ $cbw['zalo'] ?? '' }}"
    data-cbw-messenger="{{ $cbw['messenger'] ?? '' }}"
    data-cbw-position="{{ $cbw['position'] ?? 'right' }}"
    data-cbw-theme="{{ $cbw['theme'] ?? 'brand' }}"
    data-cbw-above-totop="{{ !empty($cbw['above_totop']) ? 'true' : 'false' }}"
>
    <div class="cbw__panel" role="group" aria-label="Kênh liên hệ">
        <a
            class="cbw__item cbw__item--phone{{ $cbwPhone ? ' is-visible' : '' }}"
            data-cbw-link="phone"
            href="{{ $cbwPhone ? 'tel:' . $cbwPhone : '#' }}"
            target="_self"
            rel="noopener"
            aria-label="{{ $cbw['labels']['phone'] ?? 'Gọi hotline' }}"
            @unless($cbwPhone) hidden @endunless
        >
            <span class="cbw__label">{{ $cbw['labels']['phone'] ?? 'Gọi hotline' }}</span>
            <span class="cbw__icon"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></span>
        </a>
        <a
            class="cbw__item cbw__item--facebook{{ !empty($cbw['facebook']) ? ' is-visible' : '' }}"
            data-cbw-link="facebook"
            href="{{ !empty($cbw['facebook']) ? (preg_match('#^https?://#i', $cbw['facebook']) ? $cbw['facebook'] : 'https://' . ltrim($cbw['facebook'], '/')) : '#' }}"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="{{ $cbw['labels']['facebook'] ?? 'Facebook' }}"
            @if(empty($cbw['facebook'])) hidden @endif
        >
            <span class="cbw__label">{{ $cbw['labels']['facebook'] ?? 'Facebook' }}</span>
            <span class="cbw__icon"><i class="fa-brands fa-facebook" aria-hidden="true"></i></span>
        </a>
        <a
            class="cbw__item cbw__item--zalo{{ $cbwZaloDigits ? ' is-visible' : '' }}"
            data-cbw-link="zalo"
            href="{{ $cbwZaloDigits ? 'https://zalo.me/' . $cbwZaloDigits : '#' }}"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="{{ $cbw['labels']['zalo'] ?? 'Zalo' }}"
            @unless($cbwZaloDigits) hidden @endunless
        >
            <span class="cbw__label">{{ $cbw['labels']['zalo'] ?? 'Zalo' }}</span>
            <span class="cbw__icon">
                <img src="/frontend/callbutton/60px-Icon_of_Zalo.svg.webp" alt="" class="cbw__zalo-img" width="26" height="26" aria-hidden="true">
            </span>
        </a>
        <a
            class="cbw__item cbw__item--messenger{{ $cbwMessengerHref ? ' is-visible' : '' }}"
            data-cbw-link="messenger"
            href="{{ $cbwMessengerHref ?: '#' }}"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="{{ $cbw['labels']['messenger'] ?? 'Messenger' }}"
            @unless($cbwMessengerHref) hidden @endunless
        >
            <span class="cbw__label">{{ $cbw['labels']['messenger'] ?? 'Messenger' }}</span>
            <span class="cbw__icon"><i class="fa-brands fa-facebook-messenger" aria-hidden="true"></i></span>
        </a>
    </div>

    <button type="button" class="cbw__toggle" aria-expanded="false" aria-controls="call-button-widget">
        <span class="cbw__pulse" aria-hidden="true"></span>
        <span class="cbw__toggle-icon cbw__toggle-icon--open" aria-hidden="true"><i class="fa-solid fa-phone"></i></span>
        <span class="cbw__toggle-icon cbw__toggle-icon--close" aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
    </button>
    <span class="cbw__hint" role="tooltip">{{ $cbw['hint'] ?? 'Liên hệ ngay' }}</span>
</aside>
@endif
