@push('styles')
<style>
    .project-desc {
        height: 60px; /* cố định chiều cao */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Giới hạn 3 dòng */
        -webkit-box-orient: vertical;
    }

    .heading-demo-project {
        text-align: center;
        font-weight: 720;
        margin: 2rem 0;
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        background: #d4a537;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }

    .card-luxury-gold {
        background: linear-gradient(135deg, #0b1c2c, #142d4c);
        border: 1.5px solid var(--anphu-gold);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        color: #fff;
    }

    .card-luxury-gold .card-title {
        color: #fff;
        text-shadow: 0 1px 1px rgba(201, 176, 55, 0.7);
        font-weight: bold;
        min-height: 48px;
    }

    .card-luxury-gold .icon-wrapper {
        width: 70px;
        height: 70px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #15596e;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-luxury-gold .icon-wrapper i {
        color: #fff;
        font-size: 28px;
    }

    .card-luxury-gold:hover {
        background: linear-gradient(135deg, #0c2b3a, #134e60);
        border: 2px solid var(--color-secondary);
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(201, 176, 55, 0.4);
    }

    .card-luxury-gold:hover .card-title {
        color: #0b1c2c;
        text-shadow: none;
    }

    .card-luxury-gold:hover .icon-wrapper {
        background: #0b1c2c;
    }

    .card-luxury-gold:hover .icon-wrapper i {
        color: #15596e;
    }

    .btn-luxury {
        border: 1px solid #C9B037;
        color: #C9B037;
        font-weight: bold;
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

<section class="py-5 bg-light section-bg-demo">
    <div class="container">
        @foreach ($portfolioByCategories as $item)
            @if (isset($item['projects']) && count($item['projects']) > 0)
                <h3 class="heading-demo-project">{{ $item['category']->name }}</h3>
                <hr class="border-warning">
                <div class="row">
                    @foreach ($item['projects'] as $portfolio)
                        <a href="{{ route('customers.project.detail', $item->slug) }}" class="text-decoration-none">
                            <div class="col-md-4 mb-4 project-item">
                                <div class="card card-project"
                                    style="background-image: url('{{ $item->thumbnail }}');">
                                    <div class="project-overlay text-white">
                                        <p>
                                            {{$portfolio}}
                                        </p>
                                        <!-- <h5 class="font-weight-bold text-warning">{{ $item->name }}</h5>

                                        <p class="mb-1">
                                            <i class="fa fa-user mr-2 text-warning"></i> Chủ đầu tư:
                                            {{ $item->client }}
                                        </p>

                                        <p class="mb-1">
                                            <i class="fa fa-map-marker-alt mr-2 text-warning"></i> Địa điểm:
                                            {{ $item->location }}
                                        </p>

                                        <p class="mb-1">
                                            <i class="fa fa-ruler-combined mr-2 text-warning"></i> Diện tích:
                                            {{ $item->area }}
                                        </p>

                                        <p class="mb-1">
                                            <i class="fa fa-building mr-2 text-warning"></i> Số tầng:
                                            {{ $item->floors ?? 'N/A' }}
                                        </p>

                                        <p class="mb-0">
                                            <i class="fa fa-paint-brush mr-2 text-warning"></i> Phong cách:
                                            {{ $item->category?->name ?? 'Không rõ' }}
                                        </p> -->
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
</section>

