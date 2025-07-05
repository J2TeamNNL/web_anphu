<section class="py-5 bg-light">
    <div class="container">
        <h4 class="text-center text-uppercase font-weight-bold mb-4">Công Trình Biệt Thự</h4>
        <div class="row">
            @foreach(range(1, 8) as $i)
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/villa'.$i.'.jpg') }}" class="card-img-top" alt="Biệt thự {{ $i }}">
                    <div class="card-body">
                        <h6 class="card-title font-weight-bold">Biệt Thự {{ $i }} Hiện Đại</h6>
                        <p class="card-text text-muted small">Mẫu biệt thự theo xu hướng hiện đại, tiết kiệm diện tích và tối ưu công năng.</p>
                        <a href="#" class="btn btn-sm btn-outline-success">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>