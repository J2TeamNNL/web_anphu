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

    .portfolio-content {
        padding: 0 1rem;
    }

    .portfolio-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 1rem auto;
        object-fit: contain;
        border-radius: 6px;
    }

    .portfolio-content p, 
    .portfolio-content h1, 
    .portfolio-content h2, 
    .portfolio-content h3 {
        word-break: break-word;
        line-height: 1.6;
    }
</style>
@endpush

@section('content')
<div class="container my-4">
    <h2 class="mb-3">{{ $portfolio->name }}</h2>

    <p class="text-muted small">
        Đăng ngày {{ $portfolio->created_at->format('d/m/Y') }}
    </p>

    <div class="portfolio-content mb-4">
        {!! $portfolio->content !!}
    </div>

    @if ($portfolio->media->count())
        <div class="media-gallery">
            <div class="row">
                @foreach ($portfolio->media as $media)
                    <div class="col-md-4 mb-4 d-flex align-items-stretch">
                        <div class="card shadow-sm w-100">
                            @if(Str::contains($media->type, 'image'))
                                <div class="text-center p-2">
                                    <div class="img-wrapper bg-light border rounded overflow-hidden">
                                        <img src="{{ asset('storage/' . $media->file_path) }}"
                                            class="img-fixed"
                                            alt="media">
                                    </div>
                                </div>
                            @elseif(Str::contains($media->type, 'youtube'))
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{ $media->file_path }}" allowfullscreen></iframe>
                                </div>
                            @endif

                            @if ($media->caption)
                                <div class="card-body p-2">
                                    <p class="card-text small text-muted">{{ $media->caption }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@include('customers.partials.sign_up_1')

    
{{-- @include('customers.partials.anphu.demo_projects', [
   'interiorProjects' => $interiorProjects,
   'otherProjects' => $otherProjects,
]) --}}

@include('customers.partials.anphu.partner')

@endsection
