@extends('customers.layouts.master')


@section('content')
<section class="py-5 section-bg">
    <div class="container">
        <div class="page-wrapper">
            {{-- Nội dung chính --}}
            <div class="main-content" data-aos="fade-up">
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
            <div class="sidebar">
                {{-- Thông tin công ty --}}
                <div class="sidebar-box" data-aos="fade-left" data-aos-delay="200">
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
                <div class="sidebar-box" data-aos="fade-left" data-aos-delay="300">
                    <h5><i class="fas fa-list me-2"></i> Trang khác</h5>
                    <ul class="toc-list">
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
                <div class="sidebar-box" data-aos="fade-left" data-aos-delay="400">
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
