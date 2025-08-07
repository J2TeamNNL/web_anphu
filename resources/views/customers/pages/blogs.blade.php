@extends('customers.layouts.master')

@section('content')
    <section id="blog" class="bg-white py-5 text-primary">
        <div class="container-fluid px-5">

            <div class="text-center mb-4">
                <h4 class="text-uppercase font-weight-bold" id="blog-title">{{ $articleTitle }}</h4>
                <hr class="border-warning">
            </div>

            <!-- FILTER DANH MỤC -->
            @if($parentCategory)
                <div class="text-center mb-4">
                    <a href="{{ route('blogs.index', $parentCategory->slug) }}"
                    class="btn btn-sm btn-outline-primary active">
                        Tất cả
                    </a>
                    @foreach($childCategories as $child)
                        <a href="{{ route('blogs.index', ['slug' => $parentCategory->slug, 'child' => $child->slug]) }}"
                        class="btn btn-sm btn-outline-primary">
                            {{ $child->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- BLOG GRID -->
            <div class="row blog-grid">
                @foreach ($articles as $item)
                    <a href="{{ route('customers.blog.detail', $item->slug) }}" class="text-decoration-none">
                        <div class="col-md-4 mb-4 blog-item">
                            <div class="card card-blog"
                                 style="background-image: url('{{ $item->thumbnail }}'); background-size: cover; background-position: center;">
                                <div class="blog-overlay text-white p-3" style="background: rgba(0,0,0,0.6);">
                                    <h5 class="font-weight-bold text-warning">{{ $item->name }}</h5>

                                    @if (!empty($item->category))
                                        <p class="mb-0 font-weight-bold">Chủ đề: {{ $item->category->name }}</p>
                                    @endif

                                    @if (!empty($item->category))
                                        <p class="mb-0 font-weight-bold small">
                                            Đăng ngày {{ $item->created_at->format('d/m/Y') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $articles->withQueryString()->links() }}
            </div>

        </div>
    </section>

    @include('customers.partials.sign_up_1')
    @include('customers.partials.anphu.partner')
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const grid = document.querySelector('.blog-grid');
            if (!grid) return;

            const iso = new Isotope(grid, {
                itemSelector: '.blog-item',
                layoutMode: 'fitRows'
            });

            const selectedType = @json($selectedType ?? '');

            if (selectedType !== '') {
                iso.arrange({ filter: `.${selectedType}` });

                const defaultButton = document.querySelector('.filter-button[data-filter="*"]');
                if (defaultButton) defaultButton.classList.add('active');
            }

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
