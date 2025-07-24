<section class="py-5 bg-light">
    <div class="container">
        <h4 class="text-center text-uppercase font-weight-bold mb-4">Công Trình Biệt Thự</h4>
        <hr class="border-warning">
        <div class="row">
            @foreach($portfolios as $portfolio)
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="#">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $portfolio->image) }}" class="card-img-top">
                    <div class="card-body">
                        <h6 class="card-title font-weight-bold">{{$portfolio->name}}</h6>
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
            @foreach($portfolios as $portfolio)
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="#">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $portfolio->image) }}" class="card-img-top">
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