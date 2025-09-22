@props([
    'title' => 'ĐĂNG KÝ NHẬN MẪU BẢN VẼ MIỄN PHÍ',
    'showInfo' => false,
    'class' => ''
])

@push('styles')
<style>
    :root {
        --lux-dark: #0b1c2c;
        --lux-dark-2: #081420;
        --lux-text-light: #f5f2e7;
        --anphu-gold: #d6aa3a;
        --anphu-gold-2: #d4a537;
    }

    .consulting-form-container {
        background-color: rgba(255, 255, 255, 0.05);
        border: 2px solid var(--anphu-gold);
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(214, 170, 58, 0.2);
        padding: 2rem;
        color: var(--lux-text-light);
    }

    .consulting-overlay {
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

    .consulting-popup {
        background: #fff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        max-width: 400px;
        width: 90%;
        animation: fadeInScale 0.3s ease;
    }

    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .checkmark {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: block;
        stroke-width: 2;
        stroke: #4CAF50;
        stroke-miterlimit: 10;
        margin: 10px auto;
        box-shadow: inset 0px 0px 0px #4CAF50;
        animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
    }

    .checkmark-circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 2;
        stroke-miterlimit: 10;
        stroke: #4CAF50;
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }

    .checkmark-check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }

    .checkmark.error {
        stroke: #dc3545;
    }

    .checkmark.error .checkmark-circle {
        stroke: #dc3545;
    }

    .checkmark-x {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        stroke: #dc3545;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }

    @keyframes stroke {
        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes scale {
        0%, 100% {
            transform: none;
        }
        50% {
            transform: scale3d(1.1, 1.1, 1);
        }
    }

    @keyframes fill {
        100% {
            box-shadow: inset 0px 0px 0px 30px #4CAF50;
        }
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(214, 170, 58, 0.3);
        border-radius: 8px;
        color: var(--lux-text-light);
        transition: border-color 0.3s ease;
    }

    .form-control::placeholder {
        color: rgba(245, 242, 231, 0.7);
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.15);
        border-color: var(--anphu-gold);
        box-shadow: 0 0 0 0.2rem rgba(214, 170, 58, 0.25);
        color: var(--lux-text-light);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--anphu-gold), var(--anphu-gold-2));
        border: none;
        border-radius: 8px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--anphu-gold-2), var(--anphu-gold));
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(214, 170, 58, 0.4);
    }

    @media (max-width: 767.98px) {
        .consulting-form-container {
            padding: 1.5rem;
            margin: 1rem 0;
        }
    }
</style>
@endpush

<div class="row no-gutters shadow rounded overflow-hidden consulting-form-container {{ $class }}">
    <!-- Cột thông tin bên trái -->
    @if($showInfo)
    <div class="col-lg-6 mb-4 p-4">
        <h4 class="text-warning font-weight-bold text-center">NHỮNG GIÁ TRỊ VƯỢT TRỘI AN PHÚ MANG ĐẾN</h4>
        <ul class="text-white mt-4 pl-3">
            <li>Thiết kế thể hiện cá tính, <span class="content-amplify">phong cách sống</span> của gia chủ</li>
            <li>Ứng dụng <span class="content-amplify">Phong thủy khoa học</span> vào thiết kế</li>
            <li>
                Đảm bảo thiết kế phù hợp với ngân sách, <span class="content-amplify">không phát sinh</span>,
                tính toán phương án thi công khả thi thực dụng,
                phù hợp với mọi đối tượng khách hàng
            </li>
            <li>Kiểm tra <span class="content-amplify">quy hoạch pháp lý</span> trước khi thiết kế</li>
        </ul>
    </div>
    @endif

    <!-- Cột form bên phải -->
    <div class="{{ $showInfo ? 'col-lg-6' : 'col-12' }} p-4 d-flex flex-column justify-content-center">
        <h4 class="text-center mb-4 font-weight-bold" style="color: var(--anphu-gold); text-transform: uppercase; letter-spacing: 1px;">{{ $title }}</h4>

        <form class="consulting-form" method="POST" action="{{ route('consulting_requests.store') }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Họ và tên">
                </div>
                <div class="form-group col-md-6">
                    <input type="tel" name="phone" class="form-control" placeholder="Số điện thoại *" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="location" class="form-control" placeholder="Địa chỉ">
                </div>
            </div>

            <div class="form-group">
                <textarea class="form-control" name="requirements" rows="3" placeholder="Nhu cầu (Diện tích đất, số tầng,...)"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5 mb-3">
                    <i class="fa fa-paper-plane mr-2"></i>
                    Đăng ký ngay
                </button>

                <div class="mt-1">
                    <p class="small text-muted mb-2">Hoặc liên hệ qua:</p>
                    <x-social-media
                        size="medium"
                        style="default"
                        class="d-flex justify-content-center"
                    />
                </div>
            </div>
        </form>

        @if(!$showInfo)
        <div class="text-center mt-4">
            <p class="small text-muted mb-1">
                Sau khi nhận được yêu cầu của Quý khách, tư vấn viên của chúng tôi sẽ liên hệ trong thời gian sớm nhất
            </p>
        </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

<!-- OVERLAY -->
<div id="consulting-thank-you-overlay" class="consulting-overlay d-none">
    <div class="consulting-popup">
        <div class="checkmark-wrapper mb-3">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark-check" fill="none" d="M14 27l7 7 16-16"/>
            </svg>
        </div>
        <h5 class="text-success">Đã gửi thành công!</h5>
        <p class="text-muted mb-3">Cảm ơn bạn đã để lại thông tin, chúng tôi sẽ liên hệ sớm nhất.</p>
        <button id="consulting-back-button" class="btn btn-back">← Xem tiếp</button>
    </div>
</div>

<div id="consulting-error-overlay" class="consulting-overlay d-none">
    <div class="consulting-popup bg-white text-center">
        <div class="checkmark-wrapper mb-3">
            <svg class="checkmark error" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark-x" fill="none" d="M16 16 36 36 M36 16 16 36"/>
            </svg>
        </div>
        <h5 class="text-danger font-weight-bold">Bạn đã đăng ký hôm nay!</h5>
        <p class="text-muted mb-3">Chúng tôi đã nhận được thông tin của bạn hôm nay. Vui lòng quay lại sau.</p>
        <button class="btn btn-back btn-outline-danger mt-2" onclick="document.getElementById('consulting-error-overlay').classList.add('d-none')">← Quay lại</button>
    </div>
</div>

@once
@push('scripts')
<script>
document.querySelector('.consulting-form').addEventListener('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': this.querySelector('input[name="_token"]').value,
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) throw response;
        return response.json();
    })
    .then(data => {
        this.reset();
        document.getElementById('consulting-thank-you-overlay').classList.remove('d-none');
    })
    .catch(async error => {
        let errorText = 'Đã có lỗi xảy ra. Vui lòng thử lại!';

        if (error.status === 429) {
            document.getElementById('consulting-error-overlay').classList.remove('d-none');
            return;
        }

        if (error.json) {
            const err = await error.json();
            if (err.errors) {
                if (err.errors.phone && err.errors.phone.some(msg => msg.includes('taken'))) {
                    document.getElementById('consulting-error-overlay').classList.remove('d-none');
                    return;
                }
                errorText = Object.values(err.errors).flat().join('<br>');
            }
        }

        alert(errorText);
    });
});

document.getElementById('consulting-back-button').addEventListener('click', function () {
    document.getElementById('consulting-thank-you-overlay').classList.add('d-none');
});
</script>
@endpush
@endonce
