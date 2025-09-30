@php
use Illuminate\Support\Str;
@endphp
@props(['portfolios'])

<div class="project-grid-wrapper">
    <!-- PROJECT GRID -->
    <div class="row project-grid">
        @foreach ($portfolios as $item)
            <a href="{{ route('customers.project.detail', $item->slug) }}" class="text-decoration-none">
                <div class="col-md-4 mb-4 project-item">
                    <div class="card card-project"
                         style="background-image: url('{{ $item->thumbnail }}');">
                        <div class="project-overlay text-white">
                            @if($item->client)
                            <p class="mb-1">
                                <i class="fa fa-user mr-2 text-warning"></i> Chủ đầu tư:
                                {{ $item->client }}
                            </p>
                            @endif

                            @if($item->location)
                            <p class="mb-1">
                                <i class="fa fa-map-marker-alt mr-2 text-warning"></i> Địa điểm:
                                {{ $item->location }}
                            </p>
                            @endif

                            @if($item->area)
                            <p class="mb-1">
                                <i class="fa fa-ruler-combined mr-2 text-warning"></i> Diện tích:
                                {{ $item->area }}
                            </p>
                            @endif

                            @if($item->story)
                            <p class="mb-1">
                                <i class="fa fa-ruler-combined mr-2 text-warning"></i> Số tầng:
                                {{ $item->story }}
                            </p>
                            @endif

                            @if($item->category)
                            <p class="mb-0">
                                <i class="fa fa-paint-brush mr-2 text-warning"></i> Phong cách:
                                {{ $item->category->name }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <h5 class="font-weight-bold text-warning text-center">
                        {{ Str::limit($item->name, 70) }}
                    </h5>
                </div>
            </a>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const grids = document.querySelectorAll('.project-grid');
        if (!grids.length) return;

        grids.forEach(function(grid) {
            const iso = new Isotope(grid, {
                itemSelector: '.project-item',
                layoutMode: 'fitRows'
            });
        });
    });
</script>
@endpush
