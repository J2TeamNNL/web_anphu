
@push('styles')
<style>
    .card-luxury-gold {
        background: linear-gradient(135deg, #0b1c2c, #142d4c);
        border: 2px solid #C9B037;
        border-radius: 12px;
        padding: 40px 20px 20px;
        text-align: center;
        transition: all 0.3s ease;
        color: #fff;
        position: relative;
    }

    /* Icon vòng tròn vàng */
    .card-luxury-gold .icon-circle {
        background: var(--anphu-gold);
        position: absolute;
        top: -35px;
        left: 50%;
        transform: translateX(-50%);
        width: 90px;
        height: 90px;
        border-radius: 50%;
        border: 2px solid #C9B037;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(201, 176, 55, 0.4);
        z-index: 999;
    }

    .card-luxury-gold .icon-circle img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
    }

    /* Tiêu đề */
    .card-luxury-gold h5 {
        margin-top: 50px;
        font-weight: bold;
        color: #ffc107;
        text-shadow: 0 1px 0px rgba(201,176,55,0.8);
    }

    /* Mô tả */
    .card-luxury-gold p {
        color: #f8f9fa;
        min-height: 60px;
    }

    /* Hover effect */
    .card-luxury-gold:hover {
        border-color: #eac976;
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(201,176,55,0.5);
        color: #0b1c2c;
    }

    .card-luxury-gold:hover h5{
        color: #C9B037;
        text-shadow: none;
    }

    .card-luxury-gold:hover p {
        color: white;
        text-shadow: none;
    }

    .card-luxury-gold:hover .icon-circle img {
        filter: none; /* icon về màu gốc */
    }

    .btn-luxury {
        border: 1px solid #C9B037;
        color: white;
        background-color: transparent;
        transition: all 0.3s ease;
    }

    .btn-luxury:hover {
        background-color: #C9B037;
        color: #0b1c2c;
        border-color: #C9B037;
    }
</style>
@endpush
@php
use App\Models\Service;

$services = Service::all();
@endphp

<section class="bg-light py-5 section-bg-solution">
   <div class="container">
        <div class="text-center mb-5">
                <h3 class="text-warning font-weight-bold">GIẢI PHÁP TOÀN DIỆN</h3>
                <h4 class="font-weight-bold text-white">Quy trình nhanh chóng, dịch vụ chuyên nghiệp tận tình</h4>
                <h4 class="font-weight-bold text-white">Đồng bộ Thiết kế và Thi công</h4>
        </div>

        <div class="row justify-content-center">
            @foreach ($services as $service)
            <div class="col-lg-5 col-md-6 mb-5 d-flex">
                <div class="card-luxury-gold d-flex flex-column w-100">
                    <!-- Icon -->
                    <div class="icon-circle">
                        <img
                           src="{{ $service->image }}"
                           alt="{{ $service->name ?? 'Service logo' }}"
                        >
                    </div>

                    <!-- Tiêu đề & mô tả -->
                    <h5>{{ $service['name'] }}</h5>
                    <p class="flex-grow-1">
                            {{ $service['description'] }}
                    </p>

                  <!-- Nút Xem thêm -->
                    <div class="mt-auto pt-3">
                        <a
                        href="{{ route('customers.service.detail', $service->slug) }}"
                        class="btn btn-outline-light btn-sm w-100 btn-luxury"
                        >Xem thêm</a>
                    </div>
               </div>
            </div>
            @endforeach
        </div>
   </div>
</section>
