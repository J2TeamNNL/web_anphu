<section class="bg-light py-5">
<div class="container">
    <div class="text-center mb-5">
        <h5 class="text-warning font-weight-bold">GIẢI PHÁP TOÀN DIỆN</h5>
        <h2 class="font-weight-bold">Pháp lý nhanh chóng, đồng bộ Thiết kế và Thi công</h2>
        <p class="text-muted">
            Trên nền tảng "chuẩn" về năng lực tư vấn thiết kế, tổ chức thi công vận hành đảm bảo tính đồng bộ sản phẩm từ ngôn ngữ thiết kế đến chất lượng thi công thực tế
        </p>
    </div>

    <div class="row">
        @php
            $services = [
                [
                    'title' => 'Xây nhà trọn gói',
                    'icon' => 'ic_service_build.webp',
                    'desc' => 'Giải pháp toàn diện và đồng bộ từ thiết kế, xin phép xây dựng, tổ chức thi công đến hoàn thiện nội thất và hoàn công công trình'
                ],
                [
                    'title' => 'Thiết kế kiến trúc, nội thất',
                    'icon' => 'ic_service_design.webp',
                    'desc' => 'Tư duy thiết kế sáng tạo, nắm bắt xu hướng phong cách, kỹ thuật, vật liệu mới... cá nhân hóa theo nhu cầu và ngân sách'
                ],
                [
                    'title' => 'Thi công phần thô',
                    'icon' => 'ic_service_construct.webp',
                    'desc' => 'Giải pháp tổ chức thi công chuyên nghiệp, nhà thầu cung cấp nhân công và vật tư các hạng mục xây dựng phần thô và nhân công hoàn thiện. CĐT lựa chọn hình thức cung ứng vật liệu phần thô.'
                ],
                [
                    'title' => 'Hoàn thiện công trình đã xây thô',
                    'icon' => 'ic_service_interior.webp',
                    'desc' => 'Giải pháp tư vấn và thi công hoàn thiện chuyên nghiệp, độc đáo, nhà thầu cung ứng toàn bộ vật tư và nhân công hoàn thiện từ xây dựng đến nội thất.'
                ],
                [
                    'title' => 'Sản xuất lắp đặt nội thất',
                    'icon' => 'ic_service_manufacture.webp',
                    'desc' => 'Xưởng sản xuất nội thất trực tiếp, vận hành sản xuất và thi công lắp đặt bài bản chuyên nghiệp, đảm bảo chất lượng sản phẩm, độ hoàn thiện sắc nét với chi phí tối ưu.'
                ],
                [
                    'title' => 'Cải tạo, nâng cấp công trình',
                    'icon' => 'ic_service_ornamentation.webp',
                    'desc' => 'Giải pháp nâng cấp không gian toàn diện phù hợp với nhu cầu ngân sách trên cơ sở tối ưu công năng sử dụng, thẩm mỹ, đảm bảo chịu lực theo tiêu chuẩn thiết kế hiện hành.'
                ]
            ];
        @endphp

        @foreach ($services as $service)
        <div class="col-lg-4 col-md-6 mb-5 d-flex">
            <div class="card border-0 shadow rounded p-4 position-relative d-flex flex-column w-100">

                <!-- Icon nổi -->
                <div class="icon-circle-1 position-absolute d-flex align-items-center justify-content-center">
                    <img src="{{ asset('assets/img/icon/' . $service['icon']) }}" alt="Icon" style="height: 50px;">
                </div>

                <!-- Tiêu đề & mô tả -->
                <h5 class="font-weight-bold mt-4">{{ $service['title'] }}</h5>
                <p class="text-muted flex-grow-1">
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