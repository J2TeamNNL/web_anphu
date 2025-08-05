<footer class="footer-info py-5 border-top" style="background-image: url('{{ asset('assets/img/gallery/background_wooden_1.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase font-weight-bold border-left pl-2 mb-3">Thông Tin Liên Hệ</h5>
                <p><strong>CÔNG TY TNHH TƯ VẤN THIẾT KẾ KIẾN TRÚC VÀ NỘI THẤT AN PHÚ</strong></p>
                <p><i class="fa fa-map-marker-alt mr-2 text-warning"></i> Số 35 phố Ngõ Huyện, Phường Hàng Trống, Quận Hoàn Kiếm, Thành phố Hà Nội, Việt Nam</p>
                <p><i class="fa fa-phone-alt mr-2 text-warning"></i><strong class="text-white">0969 317 331</strong></p>
                <p><i class="fa fa-envelope mr-2 text-warning"></i> kientrucnoithat.anphu@gmail.com</p>
                <p class="small text-white">Giấy chứng nhận ĐKKD số 0108588362 do Sở KHĐT T.P. Hà Nội cấp ngày 15/01/2019</p>
                <p><a href="#" class="text-white">▶ Chính Sách Bảo Mật</a></p>
                <img src="{{ asset('assets/img/logo/bocongthuong_thongbao.png') }}" alt="Thông báo Bộ Công Thương" style="height: 150px;">
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase font-weight-bold border-left pl-2 mb-3">Bản Đồ</h5>
                <div class="embed-responsive embed-responsive-4by3 border rounded">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4651.941213619061!2d105.76204787601887!3d20.9752479896129!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134530013984bd5%3A0xa071284b1bd0393f!2sAn%20Ph%C3%BA%20Design!5e1!3m2!1svi!2s!4v1751625845553!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="col-md-4">
                <h5 class="text-warning font-weight-bold text-center" >ĐĂNG KÝ TƯ VẤN</h5>
                <div id="consulting-form-wrapper">
                    <form class="consulting-form text-dark p-4 rounded" method="post" action="{{ route('consulting_requests.store') }}">
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
                        <div class="d-flex align-items-center">
                            <button type="submit" class="btn btn-warning mr-3">Gửi cho chúng tôi</button>
                            <a href="#" class="btn btn-outline-warning mr-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><img src="{{ asset('assets/img/logo/logo_zalo.png') }}" style="height: 24px;" alt="Zalo"></a>
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
        <hr>

        <div class="footer-copyright text-center py-2">
            © 2025 – Công Ty TNHH Tư vấn Thiết Kế Kiến trúc và Nội thất An Phú.
        </div>
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

            // (429)
            if (error.status === 429) {
                document.getElementById('error-overlay').classList.remove('d-none');
                return;
            }

            // validation
            if (error.json) {
                const err = await error.json();
                if (err.errors) {
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

const errorOverlay = document.getElementById('error-overlay');
if (errorOverlay) {
    errorOverlay.querySelector('.btn-back')?.addEventListener('click', () => {
        errorOverlay.classList.add('d-none');
    });
}
</script>
@endpush
@endonce
