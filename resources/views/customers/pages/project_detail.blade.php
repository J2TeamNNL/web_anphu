@extends('customers.layouts.master')

@push('styles')
<style>
    :root {
        --lux-dark: #0b1c2c;
        --lux-dark-2: #081420;
        --lux-gold: #C9B037;
        --lux-gold-light: #e4c465;
        --lux-text-light: #f5f2e7;
    }

    .section-bg-project-detail {
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
    
    .portfolio-wrapper {
        display: flex;
        gap: 1rem;
        max-width: 1200px;
        margin: 0 auto;
        align-items: flex-start;
    }

    /* Nội dung chính */
    .portfolio-content-wrapper {
        flex: 1;
        padding: 2rem;
        background-color: var(--lux-dark-2);
        border: 1px solid var(--lux-gold);
        border-radius: 8px;
        color: var(--lux-text-light);
        box-shadow: 0 4px 15px rgba(0,0,0,0.6);
    }

    .portfolio-content-wrapper img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 1rem auto;
        border-radius: 6px;
    }

    .portfolio-content-wrapper p,
    .portfolio-content-wrapper h1,
    .portfolio-content-wrapper h2,
    .portfolio-content-wrapper h3 {
        word-break: break-word;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    /* Bên phải: TOC + special contents */
    .portfolio-right {
        width: 300px;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        position: sticky;
        top: 100px;
        align-self: flex-start;
    }

    .portfolio-toc {
        background: var(--lux-dark-2);
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid var(--lux-gold);
        box-shadow: 0 4px 10px rgba(0,0,0,0.5);
        color: var(--lux-text-light);
    }

    .portfolio-toc h5 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--lux-gold);
    }

    .portfolio-toc ul {
        list-style: none;
        padding-left: 0;
        margin: 0;
    }

    .portfolio-toc li {
        margin-bottom: 0.4rem;
        line-height: 1.4;
    }

    .portfolio-toc a {
        text-decoration: none;
        color: var(--lux-text-light);
        font-size: 0.9rem;
        display: block;
        padding: 6px 8px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .portfolio-toc a:hover {
        background-color: rgba(201,176,55,0.15);
        color: var(--lux-gold-light);
    }

    .portfolio-toc a.active {
        background-color: var(--lux-gold);
        color: var(--lux-dark);
        font-weight: 500;
    }

    .portfolio-extra {
        background: var(--lux-dark-2);
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid var(--lux-gold);
        box-shadow: 0 4px 10px rgba(0,0,0,0.5);
        color: var(--lux-text-light);
    }

    .portfolio-title {
        color: var(--lux-gold);
        text-shadow: 0 1px 1px rgba(201, 176, 55, 0.7);
        font-weight: bold;
        min-height: 48px;
    }

    .portfolio-extra h5 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--lux-gold);
    }

    .portfolio-extra p {
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .blog-overlay {
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.685).404), rgba(0, 0, 0, 0.822);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        border: 1px solid var(--lux-text-light);
    }
    .blog-overlay h5 {
        color: var(--lux-gold-light);
        font-weight: 600;
    }
    .blog-overlay p {
        color: var(--lux-text-light);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .portfolio-wrapper {
            flex-direction: column;
        }
        .portfolio-right {
            width: 100%;
            position: static;
        }
    }
</style>
@endpush

@section('content')
<section class="py-4 section-bg-project-detail">
    <div class="container my-4">
        <h2 class="mb-3 portfolio-title">{{ $portfolio->name }}</h2>
        <p class="text-muted small">
            Đăng ngày {{ $portfolio->created_at->format('d/m/Y') }}
        </p>

        <div class="portfolio-wrapper">
            <!-- Nội dung chính -->
            <div class="portfolio-content-wrapper" id="portfolio-content">
                {!! $portfolio->content !!}
                
                @if ($portfolio->media->count())
                    <div class="media-gallery mt-4">
                        <div class="row">
                            @foreach ($portfolio->media as $media)
                                <div class="col-md-4 mb-4 d-flex align-items-stretch">
                                    <div class="card shadow-sm w-100">
                                        @if(Str::contains($media->type, 'image'))
                                            <div class="text-center p-2">
                                                <div class="img-wrapper bg-light border rounded overflow-hidden">
                                                    <img src="{{ asset('storage/' . $media->file_path) }}" alt="media">
                                                </div>
                                            </div>
                                        @elseif(Str::contains($media->type, 'youtube'))
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item" src="{{ $media->file_path }}" allowfullscreen></iframe>
                                            </div>
                                        @endif

                                        @if ($media->caption)
                                            <div class="card-body p-2">
                                                <p class="card-text small text-muted">{{ $media->caption }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Bên phải: TOC + special contents -->
            <div class="portfolio-right">
                <aside class="portfolio-toc">
                    <h5>Mục lục</h5>
                    <ul id="portfolio-toc-list"></ul>
                </aside>

                <div class="portfolio-extra">
                    <h5 class="mb-3">Xem thêm</h5>
                    <h6 class="mb-3">Dự án thi công</h6>
                    <hr class="border-warning">
                    @foreach ($congTrinhArticles as $article)
                        <div class="col-md-12 mb-4 blog-item">
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

                    <h6 class="mb-3">Cảm nhận khách hàng</h6>
                    <hr class="border-warning">
                    @foreach ($camNhanArticles as $article)
                        <div class="col-md-12 mb-4 blog-item">
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
            </div>
        </div>
    </div>

</section>

@include('customers.partials.sign_up_1')
@include('customers.partials.anphu.partner')
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const content = document.getElementById("portfolio-content");
    const tocList = document.getElementById("portfolio-toc-list");

    if (!content || !tocList) return;

    const headings = content.querySelectorAll("h1, h2, h3, h4, h5, h6");

    headings.forEach((heading, index) => {
        if (!heading.id) heading.id = "section-" + index;

        const li = document.createElement("li");
        const a = document.createElement("a");
        a.href = "#" + heading.id;
        a.textContent = heading.textContent;
        a.classList.add("toc-link");

        const level = parseInt(heading.tagName.substring(1));
        a.style.paddingLeft = `${(level - 1) * 15}px`;
        a.style.fontSize = `${1 - (level - 1) * 0.05}rem`;

        li.appendChild(a);
        tocList.appendChild(li);
    });

    // Smooth scroll
    document.querySelectorAll(".toc-link").forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const targetId = this.getAttribute("href").substring(1);
            const targetEl = document.getElementById(targetId);
            if (targetEl) {
                window.scrollTo({
                    top: targetEl.offsetTop - 80,
                    behavior: "smooth"
                });
            }
        });
    });

    // Highlight on scroll
    const tocLinks = document.querySelectorAll(".toc-link");
    window.addEventListener("scroll", () => {
        let fromTop = window.scrollY + 120;
        tocLinks.forEach(link => {
            const section = document.querySelector(link.hash);
            if (
                section.offsetTop <= fromTop &&
                section.offsetTop + section.offsetHeight > fromTop
            ) {
                tocLinks.forEach(l => l.classList.remove("active"));
                link.classList.add("active");
            }
        });
    });
});
</script>
@endpush
