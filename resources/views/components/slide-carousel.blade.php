@php
use App\Models\Slide;

$slides = Slide::with('media')->get();
@endphp

@if($slides->isNotEmpty())
<div class="carousel-wrapper">
    <div class="carousel-spacing carousel-spacing--top"></div>

    <div id="slideCarousel" class="carousel slide slide-carousel" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($slides as $index => $slide)
                <div class="carousel-item @if($index === 0) active @endif">
                    <img src="{{ $slide->media->url }}" alt="Slide {{ $index + 1 }}" class="carousel-image">
                </div>
            @endforeach
        </div>

        <ol class="carousel-indicators carousel-indicators--custom">
            @foreach($slides as $index => $slide)
                <li data-target="#slideCarousel"
                    data-slide-to="{{ $index }}"
                    @class(['active' => $index === 0])>
                </li>
            @endforeach
        </ol>

        <button class="carousel-control-prev" type="button" data-target="#slideCarousel" data-slide="prev" aria-label="Previous slide">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#slideCarousel" data-slide="next" aria-label="Next slide">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <div class="carousel-spacing carousel-spacing--bottom"></div>
</div>
@endif

@push('styles')
<style>
    .carousel-wrapper {
        width: 100%;
    }

    .carousel-spacing {
        background: linear-gradient(rgba(11, 28, 44, 0.6), rgba(11, 28, 44, 0.6)),
                    url('/assets/img/gallery/background_danmask_1.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .carousel-spacing--top { height: 40px; }
    .carousel-spacing--bottom { height: 60px; }

    /* Responsive spacing */
    @media (max-width: 768px) {
        .carousel-spacing--top { height: 20px; }
        .carousel-spacing--bottom { height: 40px; }
    }

    .slide-carousel {
        width: 100vw;
        margin-bottom: 0;
    }

    .slide-carousel .carousel-item {
    /* Carousel container - đơn giản và clean */
    /* Image styling - tối ưu và đơn giản */
    .slide-carousel .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Hiển thị tốt nhất cho carousel */
        object-position: center;
        border-radius: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .slide-carousel .carousel-item {
            height: 60vh; /* Nhỏ hơn cho tablet/mobile */
        }

        .carousel-spacing--top { height: 20px; }
        .carousel-spacing--bottom { height: 30px; }
    }

    @media (max-width: 480px) {
        .slide-carousel .carousel-item {
            height: 50vh; /* Compact cho mobile nhỏ */
        }

        .carousel-spacing--top { height: 15px; }
        .carousel-spacing--bottom { height: 20px; }
    }

    .carousel-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Cover trên tất cả màn hình - không letterbox */
        object-position: center;
        border: 1px solid var(--color-secondary);
        display: block;
        flex-shrink: 0;
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }

    .carousel-indicators--custom {
        position: absolute;
        bottom: -40px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        justify-content: center;
        padding: 0;
        margin: 0;
        list-style: none;
        z-index: 10;
    }

    .carousel-indicators--custom li {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        margin: 0 6px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .carousel-indicators--custom li.active,
    .carousel-indicators--custom li:hover {
        background-color: var(--color-secondary);
        transform: scale(1.2);
    }
</style>
@endpush
