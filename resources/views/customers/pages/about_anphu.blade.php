@extends('customers.layouts.master')

@section('content')

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12" data-aos="fade-left">
                    <img src="{{ asset('assets/img/gallery/anphu_crew.jpg') }}" class="img-fluid mb-4 rounded shadow-sm" alt="anphu_crew">
                </div>

                {{-- SƠ LƯỢC --}}
                <div class="col-md-12" data-aos="fade-right">
                    <h4 class="text-uppercase text-primary font-weight-bold">Sơ lược về {{ config('company.name.brand') }}</h4>
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
                <div class="col-md-12" data-aos="fade-right">
                    <h4 class="text-uppercase text-primary font-weight-bold">Lịch sử hình thành</h4>
                    <hr class="border-warning">
                    <p>
                        Bắt đầu thành lập công ty ngày <span class="font-weight-bold">{{ $companySettings->established_date->format('d/m/Y') }}</span>
                        với tên gọi <span class="font-weight-bold">{{ $companySettings->company_name }}</span>.
                        Với mong muốn, những ngôi nhà nhỏ được xây lên phải xinh xắn, đầy đủ tiện nghi, đáp ứng mọi công năng sinh hoạt, đem lại cảm giác thoải mái cho gia chủ.
                    </p>
                    <p>
                        <span class="font-weight-bold">
                            {{ $companySettings->company_brand ?? 'Chưa cập nhật' }}
                        </span>
                        đại diện cho Bình an và Phú quý.
                        Đó là kim chỉ nam cho đội ngũ của
                         <span class="font-weight-bold">
                            {{ $companySettings->company_brand ?? 'Chưa cập nhật' }}
                        </span>
                        , nhằm đem lại cho khách hàng một ấm hiện đại, công năng cao.
                    </p>
                </div>

                {{-- CHỨNG CHỈ HOẠT ĐỘNG --}}
                <div class="col-md-12" data-aos="fade-right">
                    <h4 class="text-uppercase text-primary font-weight-bold">Chứng chỉ hoạt động</h4>
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

