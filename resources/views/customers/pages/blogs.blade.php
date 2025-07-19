@extends('customers.layouts.master')
@section('content')
    <section id="blog" class="bg-white py-5 text-primary">
        <div class="container-fluid px-5">

            <div class="text-center mb-4">
                <h4 class="text-uppercase font-weight-bold" id="blog-title">{{ $articleTitle }}</h4>
                <hr class="border-warning">
            </div>

            <!-- FILTER -->
            <div class="text-center mb-4">
                <button class="btn btn-outline-warning mx-2 filter-button" data-filter="*">Xem tất cả</button>

                @foreach ($types as $key => $label)
                    <button class="btn btn-outline-warning mx-2 filter-button" data-filter=".type-{{ $key }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <!-- blog GRID -->
            <div class="row blog-grid">
                @foreach ($articles as $item)
                    <div class="col-md-4 mb-4 blog-item type-{{ $item->type }}">
                        <div class="card card-blog"
                            style="background-image: url('{{ asset('storage/' . $item->image) }}');">
                            <div class="blog-overlay text-white">
                                <h5 class="font-weight-bold text-warning">{{ $item->name }}</h5>
                                <p class="mb-1"><i class="fa fa-map-marker-alt mr-1"></i>{{ $item->description }}</p>
                                <p class="mb-1">
                                    Đường dẫn: 
                                    {{ $item->link }}
                                </p>
                                <p class="mb-0">Vào ngày: {{ $item->created_at->format('d/m/Y') }}</p>
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
    $(document).ready(function () {
        var $grid = $('.blog-grid').isotope({
            itemSelector: '.blog-item',
            layoutMode: 'fitRows'
        });

        $('.filter-button').on('click', function () {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });

            $('.filter-button').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
@endpush

