<section class="py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12" data-aos="fade-left">
                <img src="{{ asset('assets/img/gallery/anphu_crew.jpg') }}" class="img-fluid mb-4 rounded shadow-sm" alt="anphu_crew">
            </div>

            {{-- SƠ LƯỢC --}}
            <div class="col-md-12" data-aos="fade-right">
                <h4 class="text-uppercase text-primary font-weight-bold">Sơ lược về An Phú Build</h4>
                <hr class="border-warning">
                <p>Tên công ty: {{ config('company.name.full') }}</p>
                <p>Tên quốc tế: {{ config('company.name.international') }}</p>
                <p>Ngày thành lập: {{ config('company.business.license_date') }}</p>
                <p>Mã số thuế: {{ config('company.business.license_number') }}</p>
                <p>Địa chỉ đăng </p>
                <p>Người đại diện: Phạm Đăng Thu</p>
            </div>

            {{-- LỊCH SỬ HÌNH THÀNH --}}
            <div class="col-md-12" data-aos="fade-right">
                <h4 class="text-uppercase text-primary font-weight-bold">Lịch sử hình thành</h4>
                <hr class="border-warning">
                <p>
                    Bắt đầu thành lập công ty ngày 15/01/2019 với tên gọi Công ty TNHH Tư vấn Thiết kế Kiến trúc và Nội thất An Phú.
                    Với mong muốn, những ngôi nhà nhỏ được xây lên phải xinh xắn, đầy đủ tiện nghi, đáp ứng mọi công năng sinh hoạt, đem lại cảm giác thoải mái cho gia chủ.
                </p>
                <p>
                    An Phú đại diện cho Bình an và Phú quý.
                    Đó là kim chỉ nam cho đội ngũ của An Phú, nhằm đem lại cho khách hàng một ấm hiện đại, công năng cao.
                </p>
            </div>

            {{-- CHỨNG CHỈ HOẠT ĐỘNG --}}
            <div class="col-md-12" data-aos="fade-right">
                <h4 class="text-uppercase text-primary font-weight-bold">Chứng chỉ hoạt động</h4>
                <hr class="border-warning">
                <div class="row justify-content-center">
                    <div class="col-md-4 text-center">
                        <div class="certificate-box mb-3">
                            <img src="{{ asset('assets/img/hero/certificate1.jpg') }}" alt="certificate1" class="img-fluid rounded shadow-sm">
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="certificate-box mb-3">
                            <img src="{{ asset('assets/img/hero/certificate2.jpg') }}" alt="certificate2" class="img-fluid rounded shadow-sm">
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="certificate-box mb-3">
                            <img src="{{ asset('assets/img/hero/certificate3.jpg') }}" alt="certificate3" class="img-fluid rounded shadow-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>