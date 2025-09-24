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
                            <h5 class="font-weight-bold text-warning">{{ $item->name }}</h5>

                            <p class="mb-1">
                                <i class="fa fa-user mr-2 text-warning"></i> Chủ đầu tư:
                                {{ $item->client }}
                            </p>

                            <p class="mb-1">
                                <i class="fa fa-map-marker-alt mr-2 text-warning"></i> Địa điểm:
                                {{ $item->location }}
                            </p>

                            <p class="mb-1">
                                <i class="fa fa-ruler-combined mr-2 text-warning"></i> Diện tích:
                                {{ $item->area }}
                            </p>

                            <p class="mb-1">
                                <i class="fa fa-ruler-combined mr-2 text-warning"></i> Số tầng:
                                {{ $item->story }}
                            </p>

                            @if($item->category)
                            <p class="mb-0">
                                <i class="fa fa-paint-brush mr-2 text-warning"></i> Phong cách:
                                {{ $item->category->name }}
                            </p>
                            @endif
                        </div>
                    </div>
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
