<section class="bg-light py-5">
<div class="container">
    <div class="text-center mb-5">
        <h3 class="text-warning font-weight-bold">GIẢI PHÁP TOÀN DIỆN</h3>
        <h4 class="font-weight-bold">Quy trình nhanh chóng, dịch vụ chuyên nghiệp tận tình</h4>
        <h4 class="font-weight-bold">Đồng bộ Thiết kế và Thi công</h4>
    </div>

    <div class="row justify-content-center">
        @php
            $services = [
                [
                    'title' => 'XÂY NHÀ TRỌN GÓI',
                    'icon' => 'ic_service_construction_full.jpg',
                    'desc' => 'Giải pháp toàn diện và đồng bộ từ thiết kế, xin phép xây dựng, tổ chức thi công đến hoàn thiện nội thất và hoàn công công trình'
                ],
                [
                    'title' => 'THIẾT KẾ KIẾN TRÚC',
                    'icon' => 'ic_service_design_architect.jpg',
                    'desc' => 'Tư duy thiết kế sáng tạo, nắm bắt xu hướng phong cách, kỹ thuật, vật liệu mới... cá nhân hóa theo nhu cầu và ngân sách'
                ],
                [
                    'title' => 'THIẾT KẾ NỘI THẤT',
                    'icon' => 'ic_service_design_interior.jpg',
                    'desc' => 'Thiết kế nội thất phong cách, kỹ thuật, vật liệu, đáp ứng nhu cầu ngân sách, giải pháp toán diện, đồng bộ, với đáp ứng tốt nhấtt'
                ],
                [
                    'title' => 'CẢI TẠO NHÀ CŨ',
                    'icon' => 'ic_service_construction_renovate.jpg',
                    'desc' => 'Giải pháp nâng cấp không gian toàn diện phù hợp với nhu cầu ngân sách trên cơ sở tối ưu công năng sử dụng, thẩm mỹ, đảm bảo chịu lực theo tiêu chuẩn thiết kế hiện hành.'
                ]
            ];
        @endphp

        @foreach ($services as $service)
        <div class="col-lg-5 col-md-6 mb-5 d-flex">
            <div class="card border-0 shadow rounded p-4 position-relative d-flex flex-column w-100">

                <!-- Icon nổi -->
                <div class="icon-circle-1 position-absolute d-flex align-items-center justify-content-center">
                    <img src="{{ asset('assets/img/icon/' . $service['icon']) }}" alt="Icon" style="height: 50px;">
                </div>

                <!-- Tiêu đề & mô tả -->
                <h5 class="font-weight-bold mt-4">{{ $service['title'] }}</h5>
                <p class="text-black flex-grow-1">
                    {{ $service['desc'] }}
                </p>

                <!-- Nút Xem thêm dưới cùng bên trái -->
                <div class="mt-auto pt-3">
                    <a href="#" class="btn-general">Xem thêm</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</section>