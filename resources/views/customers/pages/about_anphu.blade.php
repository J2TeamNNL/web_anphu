@extends('customers.layouts.master')

@push('styles')
<style>
    .about-section-bg {
        background-color: #0b1c2c; /* fallback */
        background-image:
            linear-gradient(rgba(11, 28, 44, 0.6), rgba(11, 28, 44, 0.6)),
            url('/assets/img/gallery/background_danmask_1.jpg');
        background-position: center;
        background-repeat: repeat;
        background-size: auto;
        background-attachment: fixed; /* parallax */
        position: relative;
        border-bottom: 3px solid var(--anphu-gold);
    }

    .heading-about {
        text-align: center;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        background: linear-gradient(90deg, #d6aa3a, #d4a537);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
        text-shadow: 0 0 10px rgba(201,176,55,0.6);
    }

    .about-content {
        background-color: var(--navy-dark);
        color: white;
        padding: 2rem;
        text-align: center;
        font-size: 1.05rem;
        line-height: 1.75;
        margin-bottom: 1rem;
    }

    .about-img {
        
    }
</style>

@endpush

@section('content')

    <section class="py-5 about-section-bg">
        <div class="col-md-12 about-img" data-aos="fade-left">
                    <img src="{{ $page->image_1 }}" class="img-fluid mb-4 rounded shadow-sm" alt="anphu_crew">
                </div>
        <div class="container ">
            <div class="row">

                {{-- SƠ LƯỢC --}}
                <div class="col-md-12 about-content" data-aos="fade-right">
                    <h4 class="heading-about">Sơ lược về {{ config('company.name.brand') }}</h4>
                    <hr class="border-warning">
                    
                    <p>
                        <span class="font-weight-bold">Tên công ty: </span>
                        {{ $companySettings->company_name ?? 'Chưa cập nhật' }}
                    </p>

                    <p>
                        <span class="font-weight-bold">Tên quốc tế: </span>
                        {{ $companySettings->international_name ?? 'Chưa cập nhật' }}
                    </p>

                    <p>
                        <span class="font-weight-bold">Ngày thành lập: </span>
                        {{ optional($companySettings->established_date)->format('d/m/Y') ?? 'Chưa cập nhật' }}
                    </p>

                    <p>
                        <span class="font-weight-bold">Mã số thuế: </span>
                        {{ $companySettings->tax_code ?? 'Chưa cập nhật' }}
                    </p>

                    <p>
                        <span class="font-weight-bold">Người đại diện: </span>
                        {{ $companySettings->director ?? 'Chưa cập nhật' }}
                    </p>
                </div>

                {{-- LỊCH SỬ HÌNH THÀNH --}}
                <div class="col-md-12 about-content" data-aos="fade-right">
                    <h4 class="heading-about">{{ $page->title_2 }}</h4>
                    <hr class="border-warning">
                    <p>
                        {!! $page->custom_content_2 !!}
                    </p>
                </div>

                {{-- CHỨNG CHỈ HOẠT ĐỘNG --}}
                <div class="col-md-12 about-content" data-aos="fade-right">
                    <h4 class="heading-about">Chứng chỉ hoạt động</h4>
                    <hr class="border-warning">
                    @if(!empty($companySettings->certificates))
                        <div class="row justify-content-center">
                            @foreach($companySettings->certificates as $img)
                                <div class="col-md-4 text-center">
                                    <div class="certificate-box mb-3">
                                        <img src="{{ $img }}" alt="certificate" class="img-fluid rounded shadow-sm">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Chưa cập nhật chứng chỉ</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @include('customers.partials.anphu.solution')
    
    @include('customers.partials.sign_up_1')

    @include('customers.partials.anphu.demo_projects')
    
    @include('customers.partials.anphu.partner')
@endsection

