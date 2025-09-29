@extends('customers.layouts.master')

@section('content')
<section id="blog" class="py-5 section-bg">
    <div class="container-fluid px-5">

        <div class="text-center mb-4">
            <h4 class="text-uppercase font-weight-bold" id="blog-title">{{ $articleTitle }}</h4>
            <hr>
        </div>

        {{-- Child category filter --}}
        @if ($childCategories->count())
            <div class="text-center mb-4">
                {{-- Nút Tất cả --}}
                <a href="{{ route('customers.blog.index', ['slug' => $activeCategory->slug]) }}"
                class="btn btn-sm btn-luxury {{ request('child_id') ? '' : 'active' }}">
                    Tất cả
                </a>

                {{-- Các danh mục con --}}
                @foreach ($childCategories as $child)
                    <a href="{{ route('customers.blog.index', ['slug' => $activeCategory->slug, 'child_id' => $child->id]) }}"
                    class="btn btn-sm btn-luxury {{ request('child_id') == $child->id ? 'active' : '' }}">
                        {{ $child->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <!-- BLOG GRID -->
        <div class="row blog-grid">
            @foreach ($articles as $article)
                <div class="col-md-4 mb-4 blog-item">
                    <a href="{{ route('customers.blog.detail', $article->slug) }}" class="text-decoration-none">
                        <div class="card card-blog"
                             style="background-image: url('{{ $article->thumbnail }}'); background-size: cover; background-position: center;">
                            <div class="blog-overlay p-3">
                                <h5 class="font-weight-bold">{{ $article->name }}</h5>

                                @if (!empty($article->category))
                                    <p class="mb-0 font-weight-bold small">
                                        Đăng ngày {{ $article->created_at->format('d/m/Y') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $articles->withQueryString()->links() }}
        </div>

    </div>
</section>

@include('customers.partials.form_signup_with_info')
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