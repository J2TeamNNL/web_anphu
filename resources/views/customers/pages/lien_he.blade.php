@extends('customers.layouts.master')

@push('styles')
<style>
    :root {
        --lux-dark: #0b1c2c;
        --lux-dark-2: #081420;
        --lux-text-light: #f5f2e7;
        --anphu-gold: #d6aa3a;
        --anphu-gold-2: #d4a537;

    }

    .section-bg-contact {
        background-color: var(--lux-dark);
        background-image:
            linear-gradient(rgba(11, 28, 44, 0.85), rgba(11, 28, 44, 0.85)),
            url('/assets/img/gallery/background_danmask_1.jpg');
        background-position: center;
        background-repeat: repeat;
        background-size: auto;
        background-attachment: fixed;
        position: relative;
        border-bottom: 2px solid var(--anphu-gold);
        width: 100%;
    }

    .lux-map-title {
        color: var(--anphu-gold);
        border-left: 4px solid var(--anphu-gold);
        padding-left: 10px;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    /* Tiêu đề vàng luxury */
    .heading-contact {
        text-align: center;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        background: #ffc107;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Nội dung chính */
    .contact-content {
        color: var(--lux-text-light);
        padding: 2rem;
        text-align: center;
        border-radius: 20px;
    }

    /* Nội dung phụ chia 2 cột */
    .contact-extra-content h3 {
        background: linear-gradient(90deg, var(--anphu-gold), var(--anphu-gold-2));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
        text-transform: uppercase;
        text-align: center;
    }
    .contact-extra-content {
        background-color: rgba(255, 255, 255, 0.05);
        padding: 1.5rem;
        border-radius: 15px;
        color: var(--lux-text-light);
    }

    .card-blog {
        border: 1px solid #C9B037;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        min-height: 250px;
        transition: transform 0.3s ease;
    }
    .card-blog:hover {
        transform: translateY(-4px);
    }

    .blog-overlay {
        background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.7));
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        border: 1px solid var(--lux-text-light);
    }
    .blog-overlay h5 {
        color: var(--anphu-gold);
    }
    .blog-overlay p {
        color: var(--lux-text-light);
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

    /* Carousel indicators tụt hẳn xuống dưới */
    .carousel-indicators.custom-indicators {
        position: absolute;
        bottom: -48px; /* -25px trước + -30px nữa = -55px */
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

</style>
@endpush

@section('content')

<section class="py-5 section-bg-contact">
    <h4 class="heading-contact mb-4">Liên hệ với chúng tôi</h4>

    <div class="container py-3">
        <div class="row">
            <!-- Cột 1: Map -->
            <div class="col-12 col-md-4 d-flex flex-column align-items-center justify-content-start mb-3 mb-md-0">
                <div class="text-left">
                    <div>
                        <i class="fa fa-map-marker-alt mr-1 text-warning"></i>
                        <span class="text-white">
                            {{ company()->company_address_1 ?? '' }}
                        </span>
                    </div>
                    <div class="mt-2">
                        <i class="fa fa-map-marker-alt mr-1 text-warning"></i>
                        <span class="text-white">
                            {{ company()->company_address_2 ?? '' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Cột 2: Điện thoại -->
            <div class="col-12 col-md-4 d-flex flex-column align-items-center justify-content-start mb-3 mb-md-0">
                <div class="text-left">
                    <div>
                        <a href="tel:{{ company()->company_phone_1 ?? '' }}">
                            <i class="fa fa-phone-alt mr-1 text-warning"></i>
                            <span class="text-white">
                                {{ company()->company_phone_1 ?? '' }}
                            </span>
                        </a>
                    </div>
                    <div class="mt-2">
                        <a href="tel:{{ company()->company_phone_2 ?? '' }}">
                            <i class="fa fa-phone-alt mr-1 text-warning"></i>
                            <span class="text-white">
                                {{ company()->company_phone_2 ?? '' }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Cột 3: Email -->
            <div class="col-12 col-md-4 d-flex flex-column align-items-center justify-content-start mb-3 mb-md-0">
                <div class="text-left">
                    <div>
                        <a href="mailto:{{ company()->company_email ?? '' }}">
                            <i class="fa fa-envelope mr-1 text-warning"></i>
                            <span class="text-white">
                                {{ company()->company_email ?? '' }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="container">
        {{-- FORM LIÊN HỆ & MAP --}}
        <div class="row">
            <!-- Bên trái: Form liên hệ -->
            <div class="col-md-6 mb-4">
                @include('customers.partials.sign_up_3')
            </div>

            <!-- Bên phải: Map -->
            <div class="col-md-6 mb-4">
                <div class="embed-responsive embed-responsive-4by3 border rounded">
                    <iframe
                        src="{{ company()->google_map['embed_url'] ?? '' }}"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

    </div>
</section>


@include('customers.partials.anphu.partner')

@endsection
