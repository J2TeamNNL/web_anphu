<section class="bg-light py-5">
<div class="container">
    <div class="text-center mb-5">
        <h3 class="text-warning font-weight-bold">GIẢI PHÁP TOÀN DIỆN</h3>
        <h4 class="font-weight-bold">Quy trình nhanh chóng, dịch vụ chuyên nghiệp tận tình</h4>
        <h4 class="font-weight-bold">Đồng bộ Thiết kế và Thi công</h4>
    </div>

    <div class="row justify-content-center">

        @foreach ($services as $service)

        <div class="col-lg-5 col-md-6 mb-5 d-flex">
            <div class="card border-0 shadow rounded p-4 position-relative d-flex flex-column w-100">

                <!-- Icon nổi -->
                <div class="icon-circle-1 position-absolute d-flex align-items-center justify-content-center">
                    <img 
                        src="{{ $service->image }}"
                        alt="{{ $service->name ?? 'Service logo' }}"
                        style="height: 50px;"
                    >
                </div>

                <!-- Tiêu đề & mô tả -->
                <h5 class="font-weight-bold mt-4">{{ $service['name'] }}</h5>
                <p class="text-black flex-grow-1">
                    {{ $service['description'] }}
                </p>

                <!-- Nút Xem thêm dưới cùng bên trái -->
                <div class="mt-auto pt-3">
                    <a
                        href="{{ route('customers.service.detail', $service->slug) }}"
                        class="btn-general"
                    >Xem thêm</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</section>