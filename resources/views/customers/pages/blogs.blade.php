@extends('customers.layouts.master')

@push('styles')
<style>
    :root {
        --lux-dark: #0b1c2c; /* xanh than đậm */
        --lux-dark-2: #081420;
        --lux-gold: #C9B037; /* vàng ánh kim */
        --lux-gold-light: #e4c465;
        --lux-text-light: #f5f2e7;
    }

    #blog {
        background-color: var(--lux-dark);
        color: var(--lux-text-light);
    }

    #blog-title {
        color: var(--lux-gold);
    }

    #blog hr {
        border-top: 2px solid var(--lux-gold);
        width: 60px;
        margin: 0 auto;
    }

    /* Filter Buttons */
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

    /* Blog Card */
    .card-blog {
        border: 1px solid var(--lux-gold);
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        min-height: 250px;
        transition: transform 0.3s ease;
    }
    .card-blog:hover {
        transform: translateY(-4px);
    }
    .blog-overlay {
        background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.7));
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }
    .blog-overlay h5 {
        color: var(--lux-gold-light);
    }
    .blog-overlay p {
        color: var(--lux-text-light);
    }

    /* Pagination */
    .pagination .page-link {
        background-color: transparent;
        border: 1px solid var(--lux-gold);
        color: var(--lux-gold);
    }
    .pagination .page-item.active .page-link {
        background-color: var(--lux-gold);
        color: var(--lux-dark);
        border-color: var(--lux-gold);
    }

    .section-bg-blog-detail {
        background-color: var(--lux-dark);
        background-image:
            linear-gradient(rgba(11, 28, 44, 0.85), rgba(11, 28, 44, 0.85)),
            url('/assets/img/gallery/background_danmask_1.jpg');
        background-position: center;
        background-repeat: repeat;
        background-size: auto;
        background-attachment: fixed;
        position: relative;
        border-bottom: 2px solid var(--lux-gold);
        width: 100%;
    }
</style>
@endpush

@section('content')
<section id="blog" class="py-5 section-bg-blog-detail">
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
                                    <p class="mb-0 font-weight-bold">Chủ đề: {{ $article->category->name }}</p>
                                @endif

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