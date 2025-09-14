@props([
    'title' => 'ĐĂNG KÝ NHẬN MẪU BẢN VẼ MIỄN PHÍ',
    'showValues' => false,
    'style' => 'default', // default, voucher
    'class' => ''
])

@push('styles')
<style>
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

    /* Voucher style */
    :root {
        --lux-dark: #0b1c2c;
        --lux-dark-2: #081420;
        --lux-gold: #C9B037;
        --lux-gold-light: #e4c465;
        --lux-gold-dark: #b2972b;
        --lux-text-dark: #0b1c2c;
        --lux-text-light: #f5f2e7;
    }

    .voucher-container {
        border: 2px solid var(--lux-dark-2);
        border-radius: 30px !important;
        background: linear-gradient(135deg, var(--lux-gold-light) 0%, var(--lux-gold) 50%, var(--lux-gold-dark) 100%);
        padding: 1.5rem;
    }

    .voucher-form {
        color: var(--lux-text-dark);
    }

    .voucher-form .form-control,
    .voucher-form textarea {
        background-color: transparent;
        border: 1px solid var(--lux-dark-2);
        color: var(--lux-text-dark);
    }

    .voucher-form .form-control::placeholder {
        color: var(--lux-dark);
    }

    .voucher-form .btn.btn-submit {
        background-color: #0c2b3a !important;
        border-color: #0c2b3a !important;
        color: var(--lux-text-dark) !important;
        font-weight: bold;
    }

    .voucher-form .btn.btn-submit:hover {
        background-color: #0c2b3a !important;
        border-color: #0c2b3a !important;
        color: var(--lux-text-dark) !important;
        box-shadow: 0 0 0 0.2rem rgba(12, 43, 58, 0.25);
        filter: brightness(1.05);
    }

    .voucher-card-preview {
        background-color: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .voucher-card {
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.5);
        max-width: 500px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .voucher-card img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    .voucher-card:hover {
        transform: scale(1.03);
        box-shadow: 0 12px 30px rgba(201,176,55,0.4);
    }

    @media (max-width: 767.98px) {
        .voucher-container {
            border-radius: 20px !important;
        }
        .voucher-card-preview {
            padding: 1rem;
        }
        .voucher-card {
            max-width: 100%;
        }
    }
</style>
@endpush

@if($style === 'voucher')
    <div class="row no-gutters shadow rounded overflow-hidden voucher-container {{ $class }}">
        <!-- Cột ảnh bên trái -->
        <div class="col-md-6 voucher-card-preview">
            <div class="voucher-card">
                <img src="{{ asset('assets/img/gallery/anphu_card.jpg') }}" alt="Ưu đãi">
            </div>
        </div>

        <!-- Cột form bên phải -->
        <div class="col-md-6 p-4 d-flex flex-column justify-content-center voucher-form">
            <form class="consulting-form" method="POST" action="{{ route('consulting_requests.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-6">
                        <input type="text" name="name" class="form-control" placeholder="Họ và tên">
                    </div>
                    <div class="form-group col-6">
                        <input type="text" name="phone" class="form-control" placeholder="Số điện thoại *" required>
                    </div>
                    <div class="form-group col">
                        <input type="text" name="location" class="form-control" placeholder="Địa chỉ">
                    </div>
                </div>

                <div class="form-group">
                    <textarea class="form-control" name="requirements" rows="3" placeholder="Nhu cầu (Diện tích đất, số tầng,...)"></textarea>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-submit btn-block">GỬI YÊU CẦU</button>
                </div>

                <p class="small mb-1">
                    Sau khi nhận được yêu cầu của Quý khách, tư vấn viên của chúng tôi sẽ liên hệ trong thời gian sớm nhất
                </p>
                <p class="small mb-0">
                    <strong>Hotline:</strong>
                    <a href="tel:{{ company()->company_phone_1 }}">
                        <span class="font-weight-bold">{{ company()->company_phone_1 }}</span>
                    </a>
                    <br>
                    <strong>Email:</strong>
                    <a href="mailto:{{ company()->company_email }}">
                        <span class="font-weight-bold">{{ company()->company_email }}</span>
                    </a>
                </p>
            </form>
        </div>
    </div>
@else
    <section class="py-5 position-relative section-bg-signup {{ $class }}"
        style="background-image: url('{{ asset('assets/img/gallery/form_background.webp') }}'); background-size: cover; background-attachment: fixed; background-position: center;">
        <div class="container py-5">
            <div class="row">
                @if($showValues)
                <!-- LEFT: Values -->
                <div class="col-lg-6 mb-4">
                    <h4 class="text-warning font-weight-bold">NHỮNG GIÁ TRỊ VƯỢT TRỘI AN PHÚ MANG ĐẾN</h4>
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

                <!-- RIGHT: Form -->
                <div class="{{ $showValues ? 'col-lg-6' : 'col-12' }}">
                    <h4 class="text-warning font-weight-bold text-center">{{ $title }}</h4>
                    <div id="consulting-form-wrapper">
                        <form class="consulting-form text-dark p-4 rounded" method="post" action="{{ route('consulting_requests.store') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Họ tên">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="tel" class="form-control" name="phone" placeholder="Số điện thoại *" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="location" placeholder="Địa chỉ">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="requirements" rows="3" placeholder="Nhu cầu (Diện tích đất, số tầng,...)"></textarea>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-warning mr-3">Gửi cho chúng tôi</button>
                                <x-social-media 
                                    size="small" 
                                    style="outline" 
                                    class="d-flex justify-content-center" 
                                />
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
            </div>
        </div>
    </section>
@endif

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
            document.getElementById('consulting-thank-you-overlay').classList.remove('d-none');
        })
        
        .catch(async error => {
            let errorText = 'Đã có lỗi xảy ra. Vui lòng thử lại!';

            // (429) Too Many Requests
            if (error.status === 429) {
                document.getElementById('consulting-error-overlay').classList.remove('d-none');
                return;
            }

            // Validation
            if (error.json) {
                const err = await error.json();
                if (err.errors) {
                    // kiểm tra riêng lỗi phone
                    if (err.errors.phone && err.errors.phone.some(msg => msg.includes('taken'))) {
                        document.getElementById('consulting-error-overlay').classList.remove('d-none');
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

document.getElementById('consulting-back-button').addEventListener('click', function () {
    document.getElementById('consulting-thank-you-overlay').classList.add('d-none');
});
</script>
@endpush
@endonce
