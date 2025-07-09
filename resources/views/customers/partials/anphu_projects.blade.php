<section class="py-5 bg-light">
    <div class="container">
        <h4 class="text-center text-uppercase font-weight-bold mb-4">Công Trình Biệt Thự</h4>
        <hr class="border-warning">
        <div class="row">
            @foreach(range(1, 4) as $i)
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('assets/img/gallery/construction'.$i.'.jpg') }}" class="card-img-top" alt="Biệt thự {{ $i }}">
                    <div class="card-body">
                        <h6 class="card-title font-weight-bold">Công trình {{ $i }}</h6>
                        <p class="card-text text-muted small">Mẫu biệt thự theo xu hướng hiện đại, tiết kiệm diện tích và tối ưu công năng.</p>
                        <a href="#" class="btn btn-sm btn-outline-success">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <h4 class="text-center text-uppercase font-weight-bold mb-4">Sản phẩm nội thất</h4>
        <hr class="border-warning">
        <div class="row">
            @foreach(range(1, 4) as $i)
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('assets/img/gallery/modern'.$i.'.jpg') }}" class="card-img-top" alt="modern {{ $i }}">
                    <div class="card-body">
                        <h6 class="card-title font-weight-bold">Nội thất</h6>
                        <p class="card-text text-muted small">Mẫu biệt thự theo xu hướng hiện đại, tiết kiệm diện tích và tối ưu công năng.</p>
                        <a href="#" class="btn btn-sm btn-outline-success">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endforeach

            @foreach(range(1, 4) as $i)
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('assets/img/gallery/scadinavian'.$i.'.jpg') }}" class="card-img-top" alt="scadinavian {{ $i }}">
                    <div class="card-body">
                        <h6 class="card-title font-weight-bold">Nội thất</h6>
                        <p class="card-text text-muted small">Mẫu biệt thự theo xu hướng hiện đại, tiết kiệm diện tích và tối ưu công năng.</p>
                        <a href="#" class="btn btn-sm btn-outline-success">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endforeach 
        </div>
    </div>
</section>