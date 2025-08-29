<style>
    .thank-you-overlay,
    .error-signup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1050;
    }

    .thank-you-popup,
    .error-popup {
        background: #fff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        max-width: 400px;
        width: 90%;
        animation: fadeInScale 0.3s ease;
    }
</style>

<footer class="footer-info pt-5 section-bg-footer">
    <div class="container footer-wrapper">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase font-weight-bold border-left pl-2 mb-3">Thông Tin Liên Hệ</h5>
                <p><strong>{{ config('company.name.full') }}</strong></p>
                <p>
                    <i class="fa fa-home mr-1 text-warning"></i>
                    <span style="font-weight: bold" class="text-warning">
                        VPGD 1:
                    </span>
                    {{ $companySettings?->company_address_1 ?? ''}}
                </p>

                <p>
                    <i class="fa fa-home mr-1 text-warning"></i>
                    <span style="font-weight: bold" class="text-warning">
                        VPGD 2:
                    </span>
                    {{ $companySettings?->company_address_2 ?? ''}}
                </p>

                <p>
                    <a href="tel:{{ $companySettings?->company_phone_1 ?? ''}}">
                        <i class="fas fa-phone me-2 text-warning"></i>
                        <span style="font-weight: bold" class="text-warning">
                            Zalo:
                        </span>
                        {{ $companySettings?->company_phone_1 ?? ''}}
                    </a>
                    
                </p>

                <p>
                    <a href="tel:{{ $companySettings?->company_phone_2 ?? ''}}">
                        <i class="fas fa-phone me-2 text-warning"></i>
                        <span style="font-weight: bold" class="text-warning">
                            Hotline:
                        </span>
                        {{ $companySettings?->company_phone_2 ?? ''}}
                    </a>
                </p>

                <p>
                    <a href="mailto:{{ $companySettings?->company_email ?? ''}}">
                        <i class="fa fa-envelope me-2 text-warning"></i>
                        <span style="font-weight: bold" class="text-warning">
                            Email:
                        </span>
                        {{ $companySettings?->company_email ?? ''}}
                    </a>
                </p>

                <p class="small text-white">
                    {{ config('company.business.license_full_text') }}
                </p>

                <p>
                    <a href="{{ route('customers.policy.detail')}}" class="text-white">▶ {{ config('company.privacy_policy.text') }}</a>
                </p>
                <img src="{{ asset(config('company.assets.certification.bocongthuong')) }}" alt="Thông báo Bộ Công Thương" style="height: 150px;">
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase font-weight-bold border-left pl-2 mb-3">Bản Đồ</h5>

                <div class="embed-responsive embed-responsive-4by3 border rounded">
                    <iframe
                        src="{{ $maps['map_1']['embed_url'] ?? '' }}"
                        width="500"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    >
                    </iframe>
                </div>
                <hr>
                <div class="embed-responsive embed-responsive-4by3 border rounded">
                    <iframe
                        src="{{ $maps['map_2']['embed_url'] ?? '' }}"
                        width="500"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    >
                    </iframe>
                </div>
            </div>


            <div class="col-md-4">
                <h5 class="text-warning font-weight-bold text-center">ĐĂNG KÝ TƯ VẤN</h5>
                <div id="consulting-form-wrapper">
                    <form class="consulting-form text-dark p-4 rounded"
                    method="post"
                    action="{{ route('consulting_requests.store') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Họ Tên *" required>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="tel" class="form-control" name="phone" placeholder="Số Điện Thoại *" required>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="location" placeholder="Vị Trí Xây Dựng *" required>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-warning w-100 mb-3">
                                <i class="fas fa-paper-plane me-2"></i>Gửi Yêu Cầu Tư Vấn
                            </button>
                            
                            <div class="social-connect text-center">
                                <p class="social-text mb-2 small text-muted">Hoặc liên hệ qua:</p>
                                <x-social-media 
                                    size="small" 
                                    style="outline" 
                                    class="d-flex justify-content-center" 
                                />
                            </div>
                        </div>
                    </form>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- OVERLAY -->
            <div id="thank-you-overlay" class="thank-you-overlay d-none">
            <div class="thank-you-popup">
                <div class="checkmark-wrapper mb-3">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark-check" fill="none" d="M14 27l7 7 16-16"/>
                    </svg>
                </div>
                <h5 class="text-success">Đã gửi thành công!</h5>
                <p class="text-muted mb-3">Cảm ơn bạn đã để lại thông tin, chúng tôi sẽ liên hệ sớm nhất.</p>
                <button id="back-button" class="btn btn-back">← Xem tiếp</button>
            </div>
            </div>

            <div id="error-overlay" class="error-overlay d-none">
            <div class="error-popup bg-white text-center">
                <div class="checkmark-wrapper mb-3">
                    <svg class="checkmark error" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark-x" fill="none" d="M16 16 36 36 M36 16 16 36"/>
                    </svg>
                </div>
                <h5 class="text-danger font-weight-bold">Bạn đã đăng ký hôm nay!</h5>
                <p class="text-muted mb-3">Chúng tôi đã nhận được thông tin của bạn hôm nay. Vui lòng quay lại sau.</p>
                <button class="btn btn-back btn-outline-danger mt-2" onclick="document.getElementById('error-overlay').classList.add('d-none')">← Quay lại</button>
            </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright text-center py-3 mt-4" style="border-top: 1px solid #C9B037">
        <p
            style="font-family: 'Great Vibes', cursive"
        >{{ config('company.copyright.text') }}</p>
    </div>
</footer>

@once
@push('scripts')
<script>
document.querySelectorAll('.consulting-form').forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) throw response;
            return response.json();
        })
        .then(data => {
            form.reset();
            document.getElementById('thank-you-overlay').classList.remove('d-none');
        })
        
        .catch(async error => {
            let errorText = 'Đã có lỗi xảy ra. Vui lòng thử lại!';

            // (429) Too Many Requests
            if (error.status === 429) {
                document.getElementById('error-signup-overlay').classList.remove('d-none');
                return;
            }

            // Validation
            if (error.json) {
                const err = await error.json();
                if (err.errors) {
                    // kiểm tra riêng lỗi phone
                    if (err.errors.phone && err.errors.phone.some(msg => msg.includes('taken'))) {
                        document.getElementById('error-signup-overlay').classList.remove('d-none');
                        return;
                    }

                    // nếu không phải phone thì hiện ra alert mặc định
                    errorText = Object.values(err.errors).flat().join('<br>');
                }
            }

            // Fallback alert
            alert(errorText);
        });

    });
});

document.getElementById('back-button').addEventListener('click', function () {
    document.getElementById('thank-you-overlay').classList.add('d-none');
});

const errorSignupOverlay = document.getElementById('error-overlay');
if (errorSignupOverlay) {
    errorSignupOverlay.querySelector('.btn-back')?.addEventListener('click', () => {
        errorSignupOverlay.classList.add('d-none');
    });
}
</script>
@endpush
@endonce