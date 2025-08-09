@extends('customers.layouts.master')

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

            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 mb-5 d-flex">
                    <a href="{{ route('customers.service.price', $service->slug) }}">
                        <button class="btn btn-primary">Báo giá dịch vụ</button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    @include('customers.partials.sign_up_1')

    @include('customers.partials.anphu.demo_projects')
    
    @include('customers.partials.anphu.partner')
@endsection

