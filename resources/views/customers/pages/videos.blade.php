@extends('customers.layouts.master')
@section('content')
<section id="video" class="bg-white py-5 section-bg-video">
    <div class="container-fluid px-5">

        <div class="text-center mb-4 video-luxury-gold">
            <h4 class="text-uppercase font-weight-bold" id="video-title">{{ $videoCategory->name }}</h4>
            <hr class="border-warning">
        </div>

        <!-- FILTER DANH MỤC -->
        @if($childCategories->isNotEmpty())
            <div class="text-center mb-4">
                <a href="{{ route('customers.video.index', $videoCategory->slug) }}"
                   class="btn btn-sm btn-outline btn-luxury {{ request()->has('child') ? '' : 'active' }}">
                    Tất cả
                </a>

                @foreach($childCategories as $child)
                    <a href="{{ route('customers.video.index', ['slug' => $videoCategory->slug, 'child' => $child->slug]) }}"
                       class="btn btn-sm btn-outline btn-luxury {{ (request('child') == $child->slug) ? 'active' : '' }}">
                        {{ $child->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <!-- VIDEO GRID -->
        <div class="row video-grid">
            @foreach ($articlesByCategory as $categoryArticles)
                @foreach($categoryArticles as $item)
                    <div class="col-md-4 mb-4 video-item">
                        <a href="{{ route('customers.video.show', $item->slug) }}" class="text-decoration-none">
                            <div class="card card-video" style="background-image: url('{{ $item->thumbnail }}');">
                                <div class="video-overlay text-white">
                                    <h5 class="font-weight-bold text-warning">{{ $item->name }}</h5>
                                    <p class="mb-1"><i class="fa fa-map-marker-alt mr-2 text-warning"></i> Chủ đầu tư: {{ $item->client }}</p>
                                    <p class="mb-1"><i class="fa fa-map-marker-alt mr-2 text-warning"></i> Địa điểm: {{ $item->location }}</p>
                                    <p class="mb-1"><i class="fa fa-ruler-combined mr-2 text-warning"></i> Diện tích: {{ $item->area }}</p>
                                    <p class="mb-1"><i class="fa fa-building mr-2 text-warning"></i> Số tầng: {{ $item->floors ?? 'Không rõ' }}</p>
                                    <p class="mb-0"><i class="fa fa-paint-brush mr-2 text-warning"></i> Phong cách: {{ $item->category?->name ?? 'Không rõ' }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</section>

@include('customers.partials.sign_up_1')
@include('customers.partials.anphu.partner')   
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const grid = document.querySelector('.video-grid');
    if (!grid) return;

    const iso = new Isotope(grid, {
        itemSelector: '.video-item',
        layoutMode: 'fitRows'
    });

    // Filter theo child category nếu có query param
    const selectedChild = "{{ request('child') ?? '' }}";
    if (selectedChild !== '') {
        iso.arrange({ filter: `.${selectedChild}` });
    }

    // Khi người dùng click filter
    document.querySelectorAll('.filter-button').forEach(button => {
        button.addEventListener('click', function () {
            const filterValue = this.dataset.filter;
            iso.arrange({ filter: filterValue });

            document.querySelectorAll('.filter-button').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>
@endpush