@php
use App\Models\Slide;

// Phát hiện thiết bị từ User Agent
$userAgent = request()->header('User-Agent');
$isMobile = preg_match('/(Mobile|Android|iPhone|iPad)/', $userAgent);

// Lấy slides phù hợp với thiết bị
if ($isMobile) {
    $slides = Slide::mobile()->with('media')->get();
    // Nếu không có slide mobile, fallback về desktop
    if ($slides->isEmpty()) {
        $slides = Slide::desktop()->with('media')->get();
    }
} else {
    $slides = Slide::desktop()->with('media')->get();
}
@endphp

@if($slides->isNotEmpty())
<div class="carousel-wrapper">
    <div class="carousel-spacing carousel-spacing--top"></div>

    <div id="slideCarousel" class="carousel slide slide-carousel {{ $isMobile && $slides->first()?->is_mobile ? 'mobile-slides' : '' }}" data-ride="carousel">
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

    .slide-carousel {
        width: 100vw;
        margin-bottom: 0;
    }

    .slide-carousel .carousel-item {
        width: 100%;
        aspect-ratio: 21/9; /* Tỉ lệ rộng cho banner desktop */
        overflow: hidden;
        transition: transform 0.8s ease, opacity 0.8s ease;
    }

    .carousel-image {
        width: 100%;
        height: 100%;
        object-fit: contain; /* Hiển thị toàn bộ ảnh không bị cắt */
        object-position: center;
        border: 1px solid var(--color-secondary);
        display: block;
        background-color: #000; /* Nền đen cho phần trống nếu có */
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }

    /* Mobile - chỉ áp dụng cho màn hình dọc nhỏ */
    @media (max-width: 768px) and (orientation: portrait) {
        .slide-carousel .carousel-item {
            aspect-ratio: 4/3; /* Tỉ lệ cho mobile dọc */
        }
        
        .carousel-spacing--top { height: 20px; }
        .carousel-spacing--bottom { height: 30px; }
    }

    @media (max-width: 480px) and (orientation: portrait) {
        .slide-carousel .carousel-item {
            aspect-ratio: 4/3; /* Tỉ lệ cho mobile nhỏ dọc */
        }
        
        .carousel-spacing--top { height: 10px; }
        .carousel-spacing--bottom { height: 15px; }
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
