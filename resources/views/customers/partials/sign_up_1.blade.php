<section id="sign_up_1" class="py-5 position-relative" style="background-image: url('{{ asset('assets/img/gallery/form_background.webp') }}'); background-size: cover; background-attachment: fixed; background-position: center;">
    <div class="container py-5">
        <div class="row">
            <!-- LEFT: Values -->
            <div class="col-lg-6 mb-4">
                <h4 class="text-warning font-weight-bold">NHỮNG GIÁ TRỊ VƯỢT TRỘI AN PHÚ MANG ĐẾN</h4>
                <ul class="text-white mt-4 pl-3">
                    <li>Thiết kế cá nhân hóa</li>
                    <li>Bố trí công năng khoa học, tối ưu</li>
                    <li>Cảnh quan mang mảng xanh vào công trình</li>
                    <li>Thiết kế đối lưu không khí tự nhiên</li>
                    <li>Tính toán kết cấu bền chắc</li>
                    <li>Hệ thống ME điện nước, tiết kiệm năng lượng, an toàn</li>
                    <li>Kiểm tra thông số pháp lý trước khi thiết kế</li>
                    <li>Ứng dụng Phong thủy mang</li>
                    <li>Đảm bảo Thi công thực hiện được</li>
                </ul>
            </div>

            <!-- RIGHT: Form -->
            <div class="col-lg-6">
               <form class="text-dark p-4 rounded" method="post" action="#">
                  @csrf
                  <div class="form-group">
                     <input type="text" class="form-control" placeholder="Họ Tên *" required>
                  </div>

                  <div class="form-row">
                     <div class="form-group col-md-6">
                        <input type="tel" class="form-control" placeholder="Số Điện Thoại *" required>
                     </div>
                     <div class="form-group col-md-6">
                        <input type="email" class="form-control" placeholder="Email">
                     </div>
                  </div>

                  <div class="form-group">
                     <input type="text" class="form-control" placeholder="Vị Trí Xây Dựng *" required>
                  </div>

                  <div class="form-group">
                  <label class="d-block text-primary">Chi Phí Đầu Tư</label>
                  <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="duoi15">
                        <label class="form-check-label text-primary" for="duoi15">Dưới 1.5 tỷ</label>
                  </div>

                  <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="tu15">
                        <label class="form-check-label text-primary" for="tu15">1.5 - 2 tỷ</label>
                  </div>

                  <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="tu2">
                        <label class="form-check-label text-primary" for="tu2">2 - 3 tỷ</label>
                  </div>

                  <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="tren3">
                        <label class="form-check-label text-primary" for="tren3">Trên 3 tỷ</label>
                  </div>

                  <div class="d-flex align-items-center">
                     <button type="submit" class="btn btn-warning mr-3">Gửi cho chúng tôi</button>
                     <a href="#" class="btn btn-outline-warning mr-2"><i class="fab fa-facebook-f"></i></a>
                     <a href="#"><img src="{{ asset('assets/img/logo/logo_zalo.png') }}" style="height: 24px;" alt="Zalo"></a>
                  </div>
               </form>
            </div>
        </div>
    </div>
</section>