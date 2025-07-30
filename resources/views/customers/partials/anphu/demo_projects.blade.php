<section class="py-5 bg-light">
    <div class="container">
        <h4 class="text-center text-uppercase font-weight-bold mb-4">Sản phẩm kiến trúc</h4>
        <hr class="border-warning">
        <div class="row">
            @foreach ($otherProjects as $project)
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="#">
                    <div class="card h-100 shadow-sm">
                        <img
                            src="{{ asset('storage/' . $project->image) }}"
                            class="card-img-top object-cover"
                            style="height: 200px; width: 100%; object-fit: cover;"
                        >
                        <div class="card-body">
                            <h6 class="card-title font-weight-bold">{{$project->name}}</h6>
                            <p class="card-text text-muted small">Mẫu biệt thự theo xu hướng hiện đại, tiết kiệm diện tích và tối ưu công năng.</p>
                            <a
                                href="{{ route('customers.project.detail', ['slug' => $project->slug]) }}"
                                class="btn btn-sm btn-outline-success"
                            >
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <h4 class="text-center text-uppercase font-weight-bold mb-4">Sản phẩm nội thất</h4>
        <hr class="border-warning">
        <div class="row">
            @foreach ($interiorProjects as $project)
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="#">
                    <div class="card h-100 shadow-sm">
                        <img
                            src="{{ asset('storage/' . $project->image) }}"
                            class="card-img-top object-cover"
                            style="height: 200px; width: 100%; object-fit: cover;"
                        >
                        <div class="card-body">
                            <h6 class="card-title font-weight-bold">{{$project->name}}</h6>
                            <p class="card-text text-muted small">Mẫu biệt thự theo xu hướng hiện đại, tiết kiệm diện tích và tối ưu công năng.</p>
                            <a
                                href="{{ route('customers.project.detail', ['slug' => $project->slug]) }}"
                                class="btn btn-sm btn-outline-success"
                            >
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>