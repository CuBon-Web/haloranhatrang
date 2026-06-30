<div class="modal fade book-now-modal" id="bookNowModal" tabindex="-1" aria-labelledby="bookNowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div>
                    <span class="service-register-card__eyebrow d-inline-flex mb-2">
                        <i class="fa fa-ship"></i> Đặt chuyến ngay
                    </span>
                    <div class="h4 modal-title mb-1" id="bookNowModalLabel">Book Now</div>
                    <p class="mb-0 text-muted small">Điền thông tin bên dưới — chúng tôi sẽ liên hệ tư vấn sớm nhất.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body pt-3">
                @if(session('success') && session('open_book_now_modal'))
                <div class="service-register-alert service-register-alert--success mb-3">{{ session('success') }}</div>
                @endif
                @if(session('error') && session('open_book_now_modal'))
                <div class="service-register-alert service-register-alert--error mb-3">{{ session('error') }}</div>
                @endif
                @if(session('open_book_now_modal') && isset($errors) && $errors->any())
                <div class="service-register-alert service-register-alert--error mb-3">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @include('partials.service-register-form', [
                    'idPrefix' => 'book_now',
                    'bare' => true,
                    'useLanguageName' => true,
                    'showNote' => true,
                ])
            </div>
        </div>
    </div>
</div>

@if(session('open_book_now_modal'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    var modalEl = document.getElementById('bookNowModal');
    if (modalEl && window.bootstrap && bootstrap.Modal) {
        bootstrap.Modal.getOrCreateInstance(modalEl).show();
    }
});
</script>
@endif
