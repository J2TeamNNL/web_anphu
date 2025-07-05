<section class="py-5 bg-light">
    <div class="container">
    
        <div class="text-center mt-5">
            <h4 class="text-blue font-weight-bold mb-4">DỊCH VỤ CỦA XÂY DỰNG AN PHÚ</h4>

            <div class="row" data-aos="zoom-in" data-aos-delay="200">
                @php
                    $services = [
                        ['icon' => 'fa-file-alt', 'title' => 'Xin phép xây dựng'],
                        ['icon' => 'fa-pencil-ruler', 'title' => 'Thiết kế kiến trúc'],
                        ['icon' => 'fa-home', 'title' => 'Xây nhà trọn gói'],
                        ['icon' => 'fa-check-circle', 'title' => 'Hoàn công xây dựng'],
                    ];
                @endphp

                @foreach($services as $service)
                    <div class="col-6 col-md-3 mb-4">
                        <div class="border p-3 rounded shadow-sm h-100">
                            <i class="fa {{ $service['icon'] }} fa-2x text-warning mb-3"></i>
                            <h6 class="font-weight-bold text-uppercase">{{ $service['title'] }}</h6>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
