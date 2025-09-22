@props([
    'showTopSpacing' => true,
    'showBottomSpacing' => true,
    'carouselId' => 'slideCarousel'
])

@if(count($allImages) > 0)
    @if($showTopSpacing)
        <!-- Top Spacing Section -->
        <section style="
            background-image: linear-gradient(rgba(11, 28, 44, 0.6), rgba(11, 28, 44, 0.6)),
                url('/assets/img/gallery/background_danmask_1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 40px;
        "></section>
    @endif

    {{-- Carousel --}}
    <div id="{{ $carouselId }}" class="carousel slide contact-carousel" data-ride="carousel" style="margin-bottom: 0;">
        <div class="carousel-inner">
            @foreach($allImages as $index => $img)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ $img }}" alt="Slide {{ $index + 1 }}" class="d-block w-100">
                </div>
            @endforeach
        </div>

        {{-- Carousel Indicators --}}
        @if(count($allImages) > 1)
            <ol class="carousel-indicators custom-indicators">
                @foreach($allImages as $index => $img)
                    <li data-target="#{{ $carouselId }}" 
                        data-slide-to="{{ $index }}" 
                        class="{{ $index === 0 ? 'active' : '' }}">
                    </li>
                @endforeach
            </ol>

            {{-- Carousel Controls --}}
            <a class="carousel-control-prev" href="#{{ $carouselId }}" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#{{ $carouselId }}" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        @endif
    </div>

    @if($showBottomSpacing)
        <!-- Bottom Spacing Section -->
        <section style="
            background-image: linear-gradient(rgba(11, 28, 44, 0.6), rgba(11, 28, 44, 0.6)),
                url('/assets/img/gallery/background_danmask_1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 60px;
        "></section>
    @endif
@endif

@push('styles')
<style>
    /* Carousel */
    .contact-carousel {
        width: 100vw;
    }
    .contact-carousel .carousel-item {
        height: 60vh;
    }
    .contact-carousel .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 1px solid #C9B037;
    }

    /* Carousel indicators tụt hẳn xuống dưới */
    .carousel-indicators.custom-indicators {
        position: absolute;
        bottom: -40px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        justify-content: center;
        padding-left: 0;
        margin: 0;
        list-style: none;
        z-index: 10;
    }

    .carousel-indicators.custom-indicators li {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        margin: 0 6px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .carousel-indicators.custom-indicators li.active,
    .carousel-indicators.custom-indicators li:hover {
        background-color: #C9B037;
        transform: scale(1.2);
    }

    /* Hiệu ứng slide ảnh nhẹ */
    .carousel-inner .carousel-item {
        transition: transform 0.8s ease, opacity 0.8s ease;
    }
</style>
@endpush
