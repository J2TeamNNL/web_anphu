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


    /* Bootstrap accordion custom styles - AnPhu Theme */
    .item_blog .card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid rgba(7, 15, 71, 0.1);
    }
    
    .item_blog .btn-link {
        color: #070f47;
        font-weight: 600;
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    
    .item_blog .btn-link:hover {
        background-color: rgba(201, 176, 55, 0.1);
        text-decoration: none;
        color: #070f47;
        border-left-color: #C9B037;
    }
    
    .item_blog .btn-link:not(.collapsed) {
        background-color: rgba(201, 176, 55, 0.15);
        color: #070f47;
        border-left-color: #C9B037;
    }
    
    .item_blog .btn-link i {
        transition: transform 0.3s ease;
        color: #C9B037;
        font-weight: bold;
    }
    
    .item_blog .btn-link:not(.collapsed) i {
        transform: rotate(45deg);
        color: #070f47;
    }
    
    .item_blog .card-body {
        line-height: 1.6;
        background: #f8f9fa;
        color: #444;
        border-top: 2px solid #C9B037;
    }
</style>
@endpush

@section('content')
    {{-- Slide Carousel Component --}}
    <x-slide-carousel 
        carousel-id="homeSlideCarousel" 
    />

    <!-- Hero Section with Accordion -->
    <section class="py-5" style="
        background-color: #0b1c2c;
        background-image: linear-gradient(rgba(11, 28, 44, 0.6), rgba(11, 28, 44, 0.6)),
            url('/assets/img/gallery/background_danmask_1.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        border-bottom: 3px solid #C9B037;
    ">
        <div class="container">
            <div class="row">                
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 mt-3 mt-lg-0">
                    <div class="mb-4">
                        <p class="text-uppercase font-weight-bold mb-2" style="color: #C9B037;">Giới thiệu về An Phú</p>
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


