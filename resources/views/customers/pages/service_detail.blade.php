@extends('customers.layouts.master')

@push('styles')
<style>
    .btn-outline-shadow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: white;
        color: #007bff;
        font-size: 1.05rem;
        font-weight: 600;
        border: 2px solid #007bff;
        border-radius: 50px;
        padding: 12px 28px;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.25);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-outline-shadow:hover {
        background-color: #007bff;
        color: white;
        box-shadow: 0 6px 16px rgba(0, 123, 255, 0.4);
        transform: translateY(-2px);
    }

    .btn-outline-shadow:active {
        transform: translateY(0);
        box-shadow: 0 3px 8px rgba(0, 123, 255, 0.3);
    }
</style>
@endpush


@section('content')

    <section class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h5 class="text-primary font-weight-bold">{{ $service->name }}</h5>
                <h2 class="font-weight-bold">
                {{ $service->slogan }}
                </h2>
                <p class="text-dark">
                    {{ $service->description }}
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 mb-5 d-flex">
                    <div class="card card-service shadow rounded p-4 position-relative d-flex flex-column w-100">

                    <!-- Icon nổi -->
                    <div class="icon-circle-2 position-absolute d-flex align-items-center justify-content-center">
                        <img src="{{ $service->icon_1 }}" alt="Icon" style="height: 50px;">
                    </div>

                    <!-- Tiêu đề & mô tả -->
                    <h5 class="font-weight-bold mt-4 text-primary">{{ $service->title_1 }}</h5>
                    <p>
                        {{ $service->content_1 }}
                    </p>
                    </div>
                </div>

                <div class="col-lg-5 col-md-6 mb-5 d-flex">
                    <div class="card card-service shadow rounded p-4 position-relative d-flex flex-column w-100">

                    <!-- Icon nổi -->
                    <div class="icon-circle-2 position-absolute d-flex align-items-center justify-content-center">
                        <img src="{{ $service->icon_2 }}" alt="Icon" style="height: 50px;">
                    </div>

                    <!-- Tiêu đề & mô tả -->
                    <h5 class="font-weight-bold mt-4 text-primary">{{ $service->title_2 }}</h5>
                    <p>
                        {{ $service->content_2 }}
                    </p>
                    </div>
                </div>

                <div class="col-lg-5 col-md-6 mb-5 d-flex">
                    <div class="card card-service shadow rounded p-4 position-relative d-flex flex-column w-100">

                    <!-- Icon nổi -->
                    <div class="icon-circle-2 position-absolute d-flex align-items-center justify-content-center">
                        <img src="{{ $service->icon_3 }}" alt="Icon" style="height: 50px;">
                    </div>

                    <!-- Tiêu đề & mô tả -->
                    <h5 class="font-weight-bold mt-4 text-primary">{{ $service->title_3 }}</h5>
                    <p>
                        {{ $service->content_3 }}
                    </p>
                    </div>
                </div>

                <div class="col-lg-5 col-md-6 mb-5 d-flex">
                    <div class="card card-service shadow rounded p-4 position-relative d-flex flex-column w-100">

                    <!-- Icon nổi -->
                    <div class="icon-circle-2 position-absolute d-flex align-items-center justify-content-center">
                        <img src="{{ $service->icon_4 }}" alt="Icon" style="height: 50px;">
                    </div>

                    <!-- Tiêu đề & mô tả -->
                    <h5 class="font-weight-bold mt-4 text-primary">{{ $service->title_4 }}</h5>
                    <p>
                        {{ $service->content_4 }}
                    </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center mt-4">
                    <a href="{{ route('customers.service.price', $service->slug) }}" class="btn-outline-shadow">
                        📄 Báo giá dịch vụ
                    </a>
                </div>
            </div>
        </div>
    </section>

    @include('customers.partials.sign_up_1')

    @include('customers.partials.anphu.demo_projects')
    
    @include('customers.partials.anphu.partner')
@endsection

