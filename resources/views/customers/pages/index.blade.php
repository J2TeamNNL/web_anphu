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

    @include('customers.partials.anphu.demo_projects')

    @include('customers.partials.anphu.solution')

    @include('customers.partials.sign_up_1')

    @include('customers.partials.anphu.partner')
@endsection

