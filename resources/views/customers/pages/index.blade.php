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


</style>
@endpush

@section('content')
    {{-- Slide Carousel Component --}}
    <x-slide-carousel/>

    {{-- Hero Tabs Component --}}
    <x-about-tabs />
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

            <button class="carousel-control-prev" type="button" data-target="#contactImageCarousel" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#contactImageCarousel" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
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

    <!-- Hero Section -->
    <section class="hero-static-slider d-flex align-items-center justify-content-center py-3 py-md-5" id="hero-static-slider"
        style="background-image: url('{{ asset('assets/img/gallery/background_project_1.jpg') }}'); background-size: cover; background-position: center; min-height: 60vh;">
        <div class="container text-white">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                    <div class="custom-box">
                        <div class="text-content">
                            <h2 class="h5 h4-md h3-lg mb-3 text-center text-align-center text-warning">
                                {{ $page?->title_1}}
                            </h2>
                            {!! $page?->custom_content_1 !!}
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


