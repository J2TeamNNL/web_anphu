@extends('customers.layouts.master')

@push('styles')
<style>
    /* Biến màu riêng cho view này */
    :root {
        --anphu-gold: #d6aa3a;
        --anphu-gold-2: #d4a537;
        --anphu-navy-dark: #0b1c2c;
        --anphu-navy-dark-2: #081420;
        --anphu-text-light: #f5f2e7;
    }

    /* Section nền */
    .voucher-section-bg {
        background-color: var(--anphu-navy-dark); /* fallback */
        background-image:
            linear-gradient(rgba(11, 28, 44, 0.6), rgba(11, 28, 44, 0.6)),
            url('/assets/img/gallery/background_danmask_1.jpg');
        background-position: center;
        background-repeat: repeat;
        background-size: auto;
        background-attachment: fixed; /* parallax */
        border-bottom: 3px solid var(--anphu-gold);
    }

    .voucher-section-bg img{
        max-width: 100%;
        height: auto;
        display: block;
        margin: 1rem auto;
        border-radius: 6px;
    }

    /* Tiêu đề vàng luxury */
    .heading-voucher {
        text-align: center;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        background: linear-gradient(90deg, var(--anphu-gold), var(--anphu-gold-2));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Nội dung chính */
    .voucher-content {
        color: var(--anphu-text-light);
        padding: 2rem;
        text-align: center;
        border-radius: 20px;
    }

    /* Nội dung phụ chia 2 cột */
    .voucher-extra-content h3 {
        background: linear-gradient(90deg, var(--anphu-gold), var(--anphu-gold-2));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
        text-transform: uppercase;
        text-align: center;
    }
    .voucher-extra-content {
        background-color: rgba(255, 255, 255, 0.05);
        padding: 1.5rem;
        border-radius: 15px;
        color: var(--anphu-text-light);
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
    }
    .blog-overlay h5 {
        color: var(--anphu-gold);
    }
    .blog-overlay p {
        color: var(--lux-text-light);
    }
    

    /* Responsive fix */
    @media (max-width: 767.98px) {
        .voucher-content,
        .voucher-extra-content {
            padding: 1rem;
        }
    }
</style>
@endpush

@section('content')

    <section class="py-5 voucher-section-bg">
        <div class="container">
            <div class="row">

                {{-- SƠ LƯỢC --}}
                <div class="col-md-12 voucher-content" data-aos="fade-right">
                    <h2 class="heading-voucher">{{ $page->title_1 }}</h2>
                    {!! $page->custom_content_1 !!}

                    @include('customers.partials.sign_up_2')
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 voucher-section-bg">
        <div class="container">
            <div class="row voucher-content">
                {{-- SƠ LƯỢC --}}
                <div class="col-md-12" data-aos="fade-right">
                    <h2 class="heading-voucher">{{ $page->title_2 }}</h2>
                    {!! $page->custom_content_2 !!}
                </div>
            </div>
            <div class="row mt-4 voucher-extra-content" data-aos="fade-up">
                <x-article-list 
                    :articles="$congTrinhArticles" 
                    title="Dự án thi công"
                    :show-category="true"
                    :show-date="true" />
                
                <x-customer-feedback 
                    :articles="$camNhanArticles" 
                    title="Cảm nhận khách hàng"
                    :show-category="true"
                    :show-date="true" />
            </div>
        </div>
    </section>
    

    @include('customers.partials.anphu.demo_projects')
    
    @include('customers.partials.anphu.partner')
@endsection