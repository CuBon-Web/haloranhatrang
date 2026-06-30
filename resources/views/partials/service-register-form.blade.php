@php
    $idPrefix = $idPrefix ?? 'register';
    $title = $title ?? 'Đăng ký dịch vụ';
    $description = $description ?? 'Điền thông tin bên dưới — chúng tôi sẽ liên hệ tư vấn sớm nhất.';
    $eyebrow = $eyebrow ?? 'Đặt chuyến ngay';
    $serviceName = $serviceName ?? '';
    $serviceCateSlug = $serviceCateSlug ?? null;
    $services = $services ?? (isset($servicehome) ? $servicehome : collect());
    $selectedService = $selectedService ?? old('service_name', $serviceName);
    $selectedServiceSlug = $selectedServiceSlug ?? old('service_cate_slug', $serviceCateSlug);
    $showServicePlaceholder = $showServicePlaceholder ?? true;
    $lockService = $lockService ?? false;
    $itineraries = $itineraries ?? (isset($haitrinh) ? $haitrinh : collect());
    $selectedItinerary = $selectedItinerary ?? old('itinerary');
    $showItineraryPlaceholder = $showItineraryPlaceholder ?? true;
    $useLanguageName = $useLanguageName ?? false;
    $cardClass = trim('service-register-card ' . ($cardClass ?? 'mb-30'));
    $bare = $bare ?? false;
    $showNote = $showNote ?? !$bare;
@endphp

@if(!$bare)
<div class="{{ $cardClass }}">
    <div class="service-register-card__header">
        <span class="service-register-card__eyebrow">
            <i class="fa fa-ship"></i> {{ $eyebrow }}
        </span>
        <h3 class="service-register-card__title">{{ $title }}</h3>
        <p class="service-register-card__desc">{{ $description }}</p>
    </div>

    @if(session('success') && !session('open_book_now_modal'))
        <div class="service-register-alert service-register-alert--success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="service-register-alert service-register-alert--error">{{ session('error') }}</div>
    @endif
@endif

    <form class="service-register-form" action="{{ route('postcontact') }}" method="post">
        @csrf
        <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
        @if($bare)
            <input type="hidden" name="book_now_modal" value="1">
        @endif
        @if($lockService && $serviceName !== '')
            <input type="hidden" name="service_name" value="{{ $serviceName }}">
            @if($serviceCateSlug)
                <input type="hidden" name="service_cate_slug" value="{{ $serviceCateSlug }}">
            @endif
        @endif

        <div class="service-register-form__field">
            <label class="service-register-form__label" for="{{ $idPrefix }}_name">Họ và tên</label>
            <div class="service-register-form__control">
                <i class="far fa-user" aria-hidden="true"></i>
                <input id="{{ $idPrefix }}_name" name="name" class="form-control" type="text"
                    placeholder="Nhập họ và tên" required autocomplete="name"
                    value="{{ old('name') }}">
            </div>
        </div>

        <div class="service-register-form__field">
            <label class="service-register-form__label" for="{{ $idPrefix }}_phone">Số điện thoại</label>
            <div class="service-register-form__control">
                <i class="far fa-phone" aria-hidden="true"></i>
                <input id="{{ $idPrefix }}_phone" name="phone" class="form-control" type="tel"
                    placeholder="Nhập số điện thoại" required autocomplete="tel"
                    value="{{ old('phone') }}">
            </div>
        </div>

        <div class="service-register-form__field">
            <label class="service-register-form__label" for="{{ $idPrefix }}_departure_date">Ngày khởi hành</label>
            <div class="service-register-form__control">
                <i class="far fa-calendar-alt" aria-hidden="true"></i>
                <input id="{{ $idPrefix }}_departure_date" name="departure_date" class="form-control" type="date"
                    required value="{{ old('departure_date') }}">
            </div>
        </div>

        @if(!$lockService && $services->count())
        <div class="service-register-form__field">
            <label class="service-register-form__label" for="{{ $idPrefix }}_service">Dịch vụ</label>
            <div class="service-register-form__control">
                <i class="far fa-door-open" aria-hidden="true"></i>
                <select
                    id="{{ $idPrefix }}_service"
                    name="service_name"
                    class="form-select form-control service-register-form__service-select"
                    data-slug-input="{{ $idPrefix }}_service_cate_slug"
                    required>
                    @if($showServicePlaceholder)
                    <option value="" disabled data-slug="" {{ $selectedService ? '' : 'selected' }}>Chọn dịch vụ</option>
                    @endif
                    @foreach ($services as $item)
                    @php
                        $serviceValue = $useLanguageName ? strip_tags(languageName($item->name)) : $item->name;
                        $serviceLabel = $useLanguageName ? languageName($item->name) : $item->name;
                    @endphp
                    <option
                        value="{{ $serviceValue }}"
                        data-slug="{{ $item->slug }}"
                        {{ $selectedService == $serviceValue ? 'selected' : '' }}>
                        {{ $serviceLabel }}
                    </option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" id="{{ $idPrefix }}_service_cate_slug" name="service_cate_slug" value="{{ $selectedServiceSlug }}">
        </div>
        @endif

        @if($itineraries->count())
        <div class="service-register-form__field">
            <label class="service-register-form__label" for="{{ $idPrefix }}_itinerary">Hải trình</label>
            <div class="service-register-form__control">
                <i class="far fa-map" aria-hidden="true"></i>
                <select id="{{ $idPrefix }}_itinerary" name="itinerary" class="form-select form-control" required>
                    @if($showItineraryPlaceholder)
                    <option value="" disabled {{ $selectedItinerary ? '' : 'selected' }}>Chọn hải trình</option>
                    @endif
                    @foreach ($itineraries as $item)
                    @php
                        $itemValue = $useLanguageName ? strip_tags(languageName($item->name)) : $item->name;
                        $itemLabel = $useLanguageName ? languageName($item->name) : $item->name;
                    @endphp
                    <option value="{{ $itemValue }}" {{ $selectedItinerary == $itemValue ? 'selected' : '' }}>
                        {{ $itemLabel }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif

        <div class="service-register-form__field">
            <label class="service-register-form__label" for="{{ $idPrefix }}_guest_count">Số lượng khách</label>
            <div class="service-register-form__control">
                <i class="far fa-users" aria-hidden="true"></i>
                <select id="{{ $idPrefix }}_guest_count" name="guest_count" class="form-select form-control" required>
                    <option value="" disabled {{ old('guest_count') ? '' : 'selected' }}>Chọn số lượng khách</option>
                    <option value="1 - 2 khách" {{ old('guest_count') == '1 - 2 khách' ? 'selected' : '' }}>1 - 2 khách</option>
                    <option value="3 - 5 khách" {{ old('guest_count') == '3 - 5 khách' ? 'selected' : '' }}>3 - 5 khách</option>
                    <option value="6 - 10 khách" {{ old('guest_count') == '6 - 10 khách' ? 'selected' : '' }}>6 - 10 khách</option>
                    <option value="Trên 10 khách" {{ old('guest_count') == 'Trên 10 khách' ? 'selected' : '' }}>Trên 10 khách</option>
                </select>
            </div>
        </div>

        <button type="submit" class="service-register-form__submit theme-btn btn-style-one w-100" data-loading-text="Vui lòng chờ...">
            <span class="btn-title"><i class="far fa-paper-plane"></i> Đăng ký ngay</span>
        </button>
    </form>

@if(!$bare)
    <p class="service-register-card__note">
        <i class="fa fa-lock" aria-hidden="true"></i> Thông tin của bạn được bảo mật tuyệt đối.
    </p>
</div>
@elseif($showNote)
    <p class="service-register-card__note service-register-card__note--bare">
        <i class="fa fa-lock" aria-hidden="true"></i> Thông tin của bạn được bảo mật tuyệt đối.
    </p>
@endif

@if(!$lockService && $services->count())
<script>
(function () {
    document.querySelectorAll('.service-register-form__service-select').forEach(function (select) {
        var slugInputId = select.getAttribute('data-slug-input');
        var slugInput = slugInputId ? document.getElementById(slugInputId) : null;
        if (!slugInput) return;

        var syncSlug = function () {
            var option = select.options[select.selectedIndex];
            slugInput.value = option ? (option.getAttribute('data-slug') || '') : '';
        };

        select.addEventListener('change', syncSlug);
        syncSlug();
    });
})();
</script>
@endif
