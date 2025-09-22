@extends('customers.layouts.master')

@push('styles')
<style>
    .text-content ul {
        padding-left: 1.2rem;
        list-style-type: disc;
        color: white;
    }
    .text-content li {
        margin-bottom: 0.5rem;
    }

    .custom-box {
        background-color: rgba(20, 20, 20, 0.54); /* nền tối mờ nhẹ */
        backdrop-filter: blur(8px); /* làm mờ ảnh nền phía sau */
        -webkit-backdrop-filter: blur(8px); /* hỗ trợ Safari */
        padding: 30px;
        width: 100%;
        max-width: 2000px;
        margin: 0 auto;
        border-radius: 10px;
    }

/* Tùy chọn responsive cho mobile */
@media (max-width: 768px) {
    .custom-box {
        padding: 20px;
        max-width: 100%;
    }
}

    /* Carousel */
    .contact-carousel {
        width: 100vw;
    }
    .contact-carousel .carousel-item {
        height: 60vh;
    }
    .contact-carousel .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 1px solid var(--anphu-gold);
    }

    /* Responsive fix */
    @media (max-width: 767.98px) {
        .contact-content,
        .contact-extra-content {
            padding: 1rem;
        }
    }

    /* CSS variables */
    :root {
        --lux-dark: #0b1c2c;
        --anphu-gold: #d6aa3a;
    }

    /* Carousel indicators tụt hẳn xuống dưới */
    .carousel-indicators.custom-indicators {
        position: absolute;
        bottom: -40px; /* Đặt indicators trong khu vực spacing section */
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        justify-content: center;
        padding-left: 0;
        margin: 0;
        list-style: none;
        z-index: 10;
    }

    .carousel-indicators.custom-indicators li {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        margin: 0 6px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .carousel-indicators.custom-indicators li.active,
    .carousel-indicators.custom-indicators li:hover {
        background-color: var(--anphu-gold);
        transform: scale(1.2);
    }

    /* Hiệu ứng slide ảnh nhẹ */
    .carousel-inner .carousel-item {
        transition: transform 0.8s ease, opacity 0.8s ease;
    }

    /* Bootstrap accordion custom styles */
    .item_blog .card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 8px;
        overflow: hidden;
    }
    
    .item_blog .btn-link {
        color: #2c3e50;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .item_blog .btn-link:hover {
        background-color: rgba(214, 170, 58, 0.1);
        text-decoration: none;
        color: var(--anphu-gold);
    }
    
    .item_blog .btn-link:not(.collapsed) {
        background-color: rgba(214, 170, 58, 0.1);
        color: var(--anphu-gold);
    }
    
    .item_blog .btn-link i {
        transition: transform 0.3s ease;
        color: #6c757d;
    }
    
    .item_blog .btn-link:not(.collapsed) i {
        transform: rotate(45deg);
        color: var(--anphu-gold);
    }
    
    .item_blog .card-body {
        line-height: 1.6;
    }
</style>
@endpush

@section('content')
    @php
        preg_match_all('/<img[^>]+src="([^">]+)"/i', $page->custom_content_2 ?? '', $matches);
        $images = array_unique($matches[1] ?? []); // loại bỏ ảnh trùng
    @endphp

    @if(count($images) > 0)
        <!-- Top Spacing Section -->
        <section style="
            background-image: linear-gradient(rgba(11, 28, 44, 0.6), rgba(11, 28, 44, 0.6)),
                url('/assets/img/gallery/background_danmask_1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 40px;
        "></section>

        {{-- Carousel --}}
        <div id="contactImageCarousel" class="carousel slide contact-carousel" data-ride="carousel" style="margin-bottom: 0;">
            <div class="carousel-inner">
                @foreach($images as $index => $img)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ $img }}" alt="Slide {{ $index + 1 }}">
                    </div>
                @endforeach
            </div>

            {{-- 3 chấm dưới carousel --}}
            <ol class="carousel-indicators custom-indicators">
                @foreach($images as $index => $img)
                    <li data-target="#contactImageCarousel" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>

            <a class="carousel-control-prev" href="#contactImageCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#contactImageCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>

    <!-- Spacing Section -->
    <section style="
        background-image: linear-gradient(rgba(11, 28, 44, 0.6), rgba(11, 28, 44, 0.6)),
            url('/assets/img/gallery/background_danmask_1.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 60px;
    "></section>
    @endif

    <!-- Hero Section with Accordion -->
    <section class="hero-static-slider py-3 py-md-5" id="hero-static-slider"
        style="background-image: url('{{ asset('assets/img/gallery/background_project_1.jpg') }}'); background-size: cover; background-position: center; min-height: 60vh;">
        <div class="container">
            <div class="row">                
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 mt-3 mt-lg-0">
                    <div class="mb-4">
                        <p class="text-warning text-uppercase font-weight-bold mb-2">Chúng tôi là ai</p>
                    </div>
                    
                    <div class="content-blog-index">
                        <div class="list-blog-index">
                            @for($i = 1; $i <= 4; $i++)
                                @if(!empty($page->{"title_$i"}) || !empty($page->{"custom_content_$i"}))
                                    <div class="item_blog mb-3">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light p-0 border-0">
                                                <button class="btn btn-link btn-block text-left p-3 text-decoration-none {{ $i !== 1 ? 'collapsed' : '' }}" 
                                                        type="button" 
                                                        data-toggle="collapse" 
                                                        data-target="#content{{ $i }}" 
                                                        aria-expanded="{{ $i === 1 ? 'true' : 'false' }}" 
                                                        aria-controls="content{{ $i }}">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h4 class="mb-0 font-weight-bold text-dark">
                                                            {{ $page->{"title_$i"} ?? "Block $i" }}
                                                        </h4>
                                                        <i class="fas fa-plus"></i>
                                                    </div>
                                                </button>
                                            </div>
                                            <div id="content{{ $i }}" 
                                                 class="collapse {{ $i === 1 ? 'show' : '' }}" 
                                                 data-parent=".list-blog-index">
                                                <div class="card-body bg-white">
                                                    @if(!empty($page->{"custom_content_$i"}))
                                                        {!! $page->{"custom_content_$i"} !!}
                                                    @else
                                                        <p class="text-muted mb-0">Nội dung đang được cập nhật...</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('customers.partials.anphu.solution')

    @include('customers.partials.form_signup_with_info')

    @include('customers.partials.anphu.partner')
@endsection


