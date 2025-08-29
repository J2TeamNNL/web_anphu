@extends('customers.layouts.master')

@push('styles')
<style>
    :root {
        --lux-dark: #0b1c2c;
        --lux-gold: #C9B037;
        --lux-gold-light: #e4c465;
    }

    /* Filter Buttons (giống blog) */
    .btn-luxury {
        color: var(--lux-gold);
        border: 1px solid var(--lux-gold);
        background-color: transparent;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 6px 14px;
        margin: 0 4px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .btn-luxury:hover,
    .btn-luxury.active {
        background-color: var(--lux-gold);
        color: var(--lux-dark);
    }

    /* Project Card */
    .card-project {
        border: 1px solid var(--lux-gold);
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        min-height: 250px;
        background-size: cover;
        background-position: center;
        transition: transform 0.3s ease;
    }
    .card-project:hover {
        transform: translateY(-4px);
    }
    .project-overlay {
        background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.7));
        height: 100%;
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }
</style>
@endpush

@section('content')
    <section id="project" class="bg-white py-5 section-bg-project">
        <div class="container-fluid px-5">

            <div class="text-center mb-4 project-luxury-gold">
                <h4 class="text-uppercase font-weight-bold" id="project-title">{{ $projectTitle }}</h4>
                <hr class="border-warning">
            </div>

            <!-- FILTER DANH MỤC -->
            @if($parentCategory)
                <div class="text-center mb-4">
                    <a href="{{ route('projects.byCategory', $parentCategory->slug) }}"
                       class="btn btn-sm btn-luxury {{ is_null($selectedChild) ? 'active' : '' }}">
                        Tất cả
                    </a>

                    @foreach($childCategories as $child)
                        <a 
                            href="{{ route('projects.byCategory', ['slug' => $parentCategory->slug, 'child' => $child->slug]) }}"
                            class="btn btn-sm btn-luxury {{ ($selectedChild && $selectedChild->id === $child->id) ? 'active' : '' }}">
                            {{ $child->name }}
                        </a>
                    @endforeach
                </div>
            @endif

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
                                        <i class="fa fa-building mr-2 text-warning"></i> Số tầng:
                                        {{ $item->floors ?? 'N/A' }}
                                    </p>
                                    
                                    <p class="mb-0">
                                        <i class="fa fa-paint-brush mr-2 text-warning"></i> Phong cách:
                                        {{ $item->category?->name ?? 'Không rõ' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
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
        const grid = document.querySelector('.project-grid');
        if (!grid) return;

        const iso = new Isotope(grid, {
            itemSelector: '.project-item',
            layoutMode: 'fitRows'
        });
    });
</script>
@endpush