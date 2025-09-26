@extends('customers.layouts.master')

@push('styles')
<style>
    :root {
        --lux-dark: #0b1c2c;
        --lux-dark-2: #081420;
        --lux-gold: var(--color-secondary);
        --lux-gold-light: #e4c465;
        --lux-text-light: #f5f2e7;
        --anphu-gold: #d6aa3a;
    }

    .section-bg-about {
        background-color: var(--lux-dark);
        background-image:
            linear-gradient(rgba(11, 28, 44, 0.85), rgba(11, 28, 44, 0.85)),
            url('/assets/img/gallery/background_danmask_1.jpg');
        background-position: center;
        background-repeat: repeat;
        background-size: auto;
        background-attachment: fixed;
        position: relative;
        border-bottom: 2px solid var(--lux-gold);
        width: 100%;
    }

    .about-wrapper {
        display: flex;
        gap: 1rem;
        max-width: 1200px;
        margin: 0 auto;
        align-items: flex-start;
    }

    .about-content {
        flex: 1;
        padding: 2rem;
        background-color: var(--lux-dark-2);
        border: 1px solid var(--lux-gold);
        border-radius: 8px;
        color: var(--lux-text-light);
        box-shadow: 0 4px 15px rgba(0,0,0,0.6);
        animation: fadeInUp 0.6s ease;
    }

    .about-content h1,
    .about-content h2,
    .about-content h3,
    .about-content h4 {
        color: var(--lux-gold-light);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .about-content p {
        font-size: 1.05rem;
        line-height: 1.75;
        margin-bottom: 1rem;
    }

    .about-content ul {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }

    .about-content li {
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }

    .about-content img {
        max-width: 100% !important;
        height: auto !important;
        display: block;
        margin: 1rem auto;
        border-radius: 6px;
        border: 1px solid var(--lux-gold);
    }

    .about-right {
        width: 300px;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        position: sticky;
        top: 100px;
        align-self: flex-start;
    }

    .about-toc {
        background: var(--lux-dark-2);
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid var(--lux-gold);
        box-shadow: 0 4px 10px rgba(0,0,0,0.5);
        color: var(--lux-text-light);
    }

    .about-toc h5 {
        color: var(--lux-gold);
        margin-bottom: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .about-toc ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .about-toc li {
        margin-bottom: 0.5rem;
    }

    .about-toc a {
        color: var(--lux-text-light);
        text-decoration: none;
        font-size: 0.9rem;
        padding: 0.25rem 0;
        display: block;
        transition: color 0.3s ease;
    }

    .about-toc a:hover {
        color: var(--lux-gold);
        text-decoration: none;
    }

    .company-info {
        background: var(--lux-dark-2);
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid var(--lux-gold);
        box-shadow: 0 4px 10px rgba(0,0,0,0.5);
        color: var(--lux-text-light);
    }

    .company-info h5 {
        color: var(--lux-gold);
        margin-bottom: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
    }

    .company-info p {
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .company-info strong {
        color: var(--lux-gold-light);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .about-wrapper {
            flex-direction: column;
        }
        
        .about-right {
            width: 100%;
            position: static;
        }
        
        .about-content {
            padding: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<section class="py-5 section-bg-about">
    <div class="container">
        <div class="about-wrapper">
            {{-- Nội dung chính --}}
            <div class="about-content" data-aos="fade-up">
                <h1 class="mb-4">{{ $aboutPage->title }}</h1>
                
                @if($aboutPage->description)
                    <div class="mb-4">
                        <p class="lead">{{ $aboutPage->description }}</p>
                    </div>
                @endif
                
                <div class="about-body">
                    {!! $aboutPage->content !!}
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="about-right">
                {{-- Thông tin công ty --}}
                <div class="company-info" data-aos="fade-left" data-aos-delay="200">
                    <h5><i class="fas fa-building me-2"></i> Thông tin công ty</h5>
                    @if(company()->company_name)
                    <p><strong>Tên công ty:</strong><br>{{ company()->company_name }}</p>
                    @endif
                    @if(company()->international_name)
                    <p><strong>Tên quốc tế:</strong><br>{{ company()->international_name }}</p>
                    @endif
                    @if(company()->license_date)
                    <p><strong>Ngày thành lập:</strong><br>{{ optional(company()->license_date)->format('d/m/Y') }}</p>
                    @endif
                    @if(company()->license_number)
                    <p><strong>Mã số thuế:</strong><br>{{ company()->license_number }}</p>
                    @endif
                    @if(company()->director)
                    <p><strong>Người đại diện:</strong><br>{{ company()->director }}</p>
                    @endif
                </div>

                {{-- Menu điều hướng --}}
                <div class="about-toc" data-aos="fade-left" data-aos-delay="300">
                    <h5><i class="fas fa-list me-2"></i> Trang khác</h5>
                    <ul>
                        @foreach($otherPages as $page)
                            @if($page->id !== $aboutPage->id)
                                <li>
                                    <a href="{{ route('customers.about.detail', $page->slug) }}">
                                        <i class="fas fa-chevron-right me-1"></i> {{ $page->title }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                {{-- Chứng chỉ --}}
                @if(company()->certificates && count(company()->certificates) > 0)
                <div class="company-info" data-aos="fade-left" data-aos-delay="400">
                    <h5><i class="fas fa-certificate me-2"></i>Chứng chỉ</h5>
                    <div class="row">
                        @foreach(company()->certificates as $img)
                            <div class="col-12 mb-2">
                                <img src="{{ $img }}" alt="certificate" class="img-fluid rounded" style="width: 100%; height: auto;">
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@include('customers.partials.form_signup_with_info')
@include('customers.partials.anphu.partner')
@endsection
