@extends('admins.layouts.master')

@php
    use Illuminate\Support\Str;
@endphp

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
    <h2 class="mb-3">{{ $service->name }}</h2>

    {{-- Ảnh đại diện chính --}}

    {{-- Nội dung mô tả --}}
    @if ($service->description)
        <div class="mb-4">
            <p class="" style="white-space: pre-line;">{{ $service->description }}</p>
        </div>
    @endif

    {{-- Nội dung 1--}}
    @if ($service->title_1)
        <div class="mb-4">
            <h3 class="" style="white-space: pre-line;">{{ $service->title_1 }}</h3>
        </div>
    @endif
    @if ($service->content_1)
        <div class="mb-4">
            <p class="" style="white-space: pre-line;">{{ $service->content_1 }}</p>
        </div>
    @endif

    {{-- Nội dung 1--}}
    @if ($service->title_2)
        <div class="mb-4">
            <h3 class="" style="white-space: pre-line;">{{ $service->title_2 }}</h3>
        </div>
    @endif
    @if ($service->content_2)
        <div class="mb-4">
            <p class="" style="white-space: pre-line;">{{ $service->content_2 }}</p>
        </div>
    @endif

    {{-- Nội dung 1--}}
    @if ($service->title_3)
        <div class="mb-4">
            <h3 class="" style="white-space: pre-line;">{{ $service->title_3 }}</h3>
        </div>
    @endif
    @if ($service->content_3)
        <div class="mb-4">
            <p class="" style="white-space: pre-line;">{{ $service->content_3 }}</p>
        </div>
    @endif

    {{-- Nội dung 4--}}
    @if ($service->title_4)
        <div class="mb-4">
            <h3 class="" style="white-space: pre-line;">{{ $service->title_4 }}</h3>
        </div>
    @endif
    @if ($service->content_4)
        <div class="mb-4">
            <p class="" style="white-space: pre-line;">{{ $service->content_4 }}</p>
        </div>
    @endif

</div>
@endsection
