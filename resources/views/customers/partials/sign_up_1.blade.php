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

<section
    id="sign_up_1"
    class="py-5 position-relative section-bg-signup"
    style="
        background-image: url('{{ asset('assets/img/gallery/form_background.webp') }}'); background-size: cover; background-attachment: fixed; background-position: center;
    "
>
    <div class="container py-5">
        <div class="row">
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

            <!-- RIGHT: Form -->
            <div class="col-lg-6">
            <h4 class="text-warning font-weight-bold text-center" >ĐĂNG KÝ TƯ VẤN</h4>
            <div id="consulting-form-wrapper">
                <form class="consulting-form text-dark p-4 rounded"
                method="post"
                action="{{ route('consulting_requests.store') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Họ Tên">
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
                        <input type="text" class="form-control" name="location" placeholder="Vị Trí Xây Dựng">
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

            <div id="error-signup-overlay" class="error-signup-overlay d-none">
                <div class="error-popup bg-white text-center">
                    <div class="checkmark-wrapper mb-3">
                        <svg class="checkmark error" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                            <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                            <path class="checkmark-x" fill="none" d="M16 16 36 36 M36 16 16 36"/>
                        </svg>
                    </div>
                    <h5 class="text-danger font-weight-bold">Bạn đã đăng ký hôm nay!</h5>
                    <p class="text-muted mb-3">Chúng tôi đã nhận được thông tin của bạn hôm nay. Vui lòng quay lại sau.</p>
                    <button class="btn btn-back btn-outline-danger mt-2" onclick="document.getElementById('error-signup-overlay').classList.add('d-none')">← Quay lại</button>
                </div>
            </div>
        </div>
    </div>
</section>

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
