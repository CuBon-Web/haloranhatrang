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

            <label class="service-register-form__label" for="{{ $idPrefix }}_service">Trải nghiệm</label>

            <div class="service-register-form__control">

                <i class="far fa-door-open" aria-hidden="true"></i>

                <select

                    id="{{ $idPrefix }}_service"

                    name="service_name"

                    class="form-select form-control service-register-form__service-select"

                    data-slug-input="{{ $idPrefix }}_service_cate_slug"

                    required>

                    @if($showServicePlaceholder)

                    <option value="" disabled data-slug="" {{ $selectedService ? '' : 'selected' }}>Chọn trải nghiệm</option>

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

            <label class="service-register-form__label" for="{{ $idPrefix }}_itinerary">Dịch vụ</label>

            <div class="service-register-form__control">

                <i class="far fa-map" aria-hidden="true"></i>

                <select id="{{ $idPrefix }}_itinerary" name="itinerary" class="form-select form-control" required>

                    @if($showItineraryPlaceholder)

                    <option value="" disabled {{ $selectedItinerary ? '' : 'selected' }}>Chọn dịch vụ</option>

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



        <div class="service-register-form__row">

            <div class="service-register-form__field">

                <label class="service-register-form__label" for="{{ $idPrefix }}_adult_count">Số người lớn</label>

                <div class="service-register-form__control">

                    <i class="far fa-user" aria-hidden="true"></i>

                    <input id="{{ $idPrefix }}_adult_count" name="adult_count" class="form-control" type="number"

                        min="1" max="99" step="1" inputmode="numeric" placeholder="VD: 2" required

                        value="{{ old('adult_count') }}">

                </div>

            </div>



            <div class="service-register-form__field">

                <label class="service-register-form__label" for="{{ $idPrefix }}_child_count">Số trẻ em</label>

                <div class="service-register-form__control">

                    <i class="fas fa-child" aria-hidden="true"></i>

                    <input id="{{ $idPrefix }}_child_count" name="child_count" class="form-control" type="number"

                        min="0" max="99" step="1" inputmode="numeric" placeholder="VD: 1"

                        value="{{ old('child_count', '0') }}">

                </div>

            </div>

        </div>



        <button type="submit" class="service-register-form__submit theme-btn btn-style-one w-100" data-loading-text="Vui lòng chờ...">

            <span class="btn-title"><i class="far fa-paper-plane"></i> Đăng ký ngay</span>

        </button>

    </form>






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

