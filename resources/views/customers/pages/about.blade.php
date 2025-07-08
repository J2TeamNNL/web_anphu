@extends('customers.layouts.master')

@section('about')

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row">
                {{-- SƠ LƯỢC --}}
                <div class="col-md-12" data-aos="fade-right">
                    <h4 class="text-uppercase text-primary font-weight-bold">Sơ lược về An Phú Design</h4>
                    <hr class="border-warning">
                    <p>Tên công ty: Công ty TNHH Tư vấn Thiết kế Kiến trúc và Nội thất An Phú</p>
                    <p>Tên quốc tế: LACO Construction Design Joint Stock Company</p>
                    <p>Ngày thành lập: 15/01/2019</p>
                    <p>Mã số thuế: 0108588362</p>
                    <p>Số 35 phố Ngõ Huyện, Phường Hàng Trống, Quận Hoàn Kiếm, Thành phố Hà Nội, Việt Nam</p>
                    <p>Người đại diện: Nguyễn Đức Tú</p>
                </div>

                {{-- LỊCH SỬ HÌNH THÀNH --}}
                <div class="col-md-12" data-aos="fade-right">
                    <h4 class="text-uppercase text-primary font-weight-bold">Sơ lược về An Phú Design</h4>
                    <hr class="border-warning">
                    <p>
                        Bắt đầu thành lập công ty ngày 07/10/2015 với tên gọi Công Ty TNHH Tư Vấn Thiết Kế Xây Dựng Nhà Xinh Thông Minh.
                        Với mong muốn, những ngôi nhà nhỏ được xây lên phải xinh xắn, đầy đủ tiện nghi, đáp ứng mọi công năng sinh hoạt, đem lại cảm giác thoải mái cho gia chủ.
                    </p>
                    <p>
                        Đáp ứng nhu cầu ngày càng cao của khách hàng, ngày 24/08/2016.
                        Ban giám đốc đã đổi tên Công Ty TNHH Tư Vấn Thiết Kế Xây Dựng Nhà Xinh Thông Minh thành Công Ty Cổ Phần Thiết Kế Xây Dựng LACO, tầm nhìn tạo bạo hơn: tạo ra những giải pháp xây dựng chất lượng cao, đánh tin cậy, những không gian kết nối hạnh phúc cho mọi thành viên trong gia đình.
                    </p>
                    <p>
                        LACO được viết tắt của Land & Construction đất đai và xây dựng.
                        Với mục đích để có một ngôi nhà hạnh phúc thì cần có miếng đất tốt và đội thầu xây dựng phải chất lượng. 
                        Bên cạnh đó, LACO định hướng tạo một hệ sinh thái xoay quanh đến đất đai và xây dựng.
                    </p>
                    <p>
                        Trải qua một thời gian xây dựng và phát triển, LACO đã và đang ngày càng trưởng thành.
                        Công Ty Cổ phần Thiết Kế Xây Dựng LACO hoạt động mạnh mẽ trong lĩnh vực thi công công trình dân dụng, đặt biệt là nhà phố, biệt thự, toàn văn phòng công ty.
                    </p>
                    <p>
                        Công Ty Cổ Phần Thiết Kế Xây Dựng LACO luôn tự hào mang đến cho khách hàng những công trình hoàn hảo,
                        chắc bền theo thời gian phù hợp với xu hướng phát triển của Xã hội hiện đại.
                    </p>
                </div>


                {{-- CHỨNG CHỈ HOẠT ĐỘNG --}}
                <div class="col-md-12" data-aos="fade-right">
                    <h4 class="text-uppercase text-primary font-weight-bold">Chứng chỉ hoạt động</h4>
                    <hr class="border-warning">
                    <div class="row justify-content-center">
                        <div class="col-md-4 text-center">
                            <div class="certificate-box mb-3">
                                <img src="{{ asset('assets/img/hero/certificate1.jpg') }}" alt="certificate1" style="width: 300px">
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="certificate-box mb-3">
                                <img src="{{ asset('assets/img/hero/certificate2.jpg') }}" alt="certificate2" style="width: 300px">
                            </div>
                        </div>

                        <div class="col-md-4 text-center">
                            <div class="certificate-box mb-3">
                                <img src="{{ asset('assets/img/hero/certificate3.jpg') }}" alt="certificate3" style="width: 300px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('customers.partials.index_nuclear')

    @include('customers.partials.index_projects')
    
    @include('customers.partials.index_partner')
@endsection

