@extends('customers.layouts.master')

@push('styles')
<style>
    .img-wrapper {
        width: 100%;
        height: 300px;
        overflow: hidden;
    }

    .img-wrapper img {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    .service-content {
        padding: 0 1rem;
    }

    .service-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 1rem auto;
        object-fit: contain;
        border-radius: 6px;
    }

    .service-content p, 
    .service-content h1, 
    .service-content h2, 
    .service-content h3 {
        word-break: break-word;
        line-height: 1.6;
    }
</style>
@endpush

@section('content')

    <div class="container my-4">
        <h2 class="mb-3">Báo giá dịch vụ: {{ $service->name }}</h2>

        <div class="service-content mb-4">
            {!! $service->content_price !!}
        </div>
    </div>

    @include('customers.partials.sign_up_1')

    @include('customers.partials.anphu.demo_projects')
    
    @include('customers.partials.anphu.partner')
@endsection

