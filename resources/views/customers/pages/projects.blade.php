@extends('customers.layouts.master')
@section('content')
    <section id="project" class="bg-white py-5 text-primary">
        <div class="container-fluid px-5">

            <div class="text-center mb-4">
                <h4 class="text-uppercase font-weight-bold" id="project-title">{{ $projectTitle }}</h4>
                <hr class="border-warning">
            </div>

            <!-- FILTER -->
            <div class="text-center mb-4">
                <button class="btn btn-outline-warning mx-2 filter-button" data-filter="*">Xem tất cả</button>

                @foreach ($categories as $cat)
                    @if ($cat['type'] === $selectedType)
                        <button class="btn btn-outline-warning mx-2 filter-button" data-filter=".{{ $cat['type'] }}.{{ $cat['key'] }}">
                            {{ $cat['name'] }}
                        </button>
                    @endif
                @endforeach 
            </div>

            <!-- PROJECT GRID -->
            <div class="row project-grid">
                @foreach ($portfolios as $item)
                    <div class="col-md-4 mb-4 project-item {{ $item->getStyleClass() }}">
                        <div class="card card-project"
                            style="background-image: url('{{ asset('storage/' . $item->image) }}');">
                            <div class="project-overlay text-white">
                                <h5 class="font-weight-bold text-warning">{{ $item->name }}</h5>
                                <p class="mb-1"><i class="fa fa-map-marker-alt mr-1"></i>{{ $item->location }}</p>
                                <p class="mb-1">Chủ đầu tư: {{ $item->client }}</p>
                                <p class="mb-0">Phong cách: {{ $item->getCategoryName() }}</p>
                            </div>
                        </div>
                    </div>
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

            const selectedType = @json($selectedType ?? '');

            if (selectedType !== '') {

                iso.arrange({ filter: `.${selectedType}` });

                const defaultButton = document.querySelector('.filter-button[data-filter="*"]');
                if (defaultButton) defaultButton.classList.add('active');
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

