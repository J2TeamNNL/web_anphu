@extends('customers.layouts.master')

@section('content')
<section class="py-4 section-bg">
    <div class="container my-4">
        <h2 class="mb-3 portfolio-title">{{ $portfolio->name }}</h2>
        <p class="text-muted small">
            Đăng ngày {{ $portfolio->created_at->format('d/m/Y') }}
        </p>

        <div class="page-wrapper">
            <!-- Nội dung chính -->
            <div class="main-content" id="portfolio-content">
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
            <div class="sidebar">
                <aside class="sidebar-box">
                    <h5>Mục lục</h5>
                    <ul class="toc-list" id="portfolio-toc-list"></ul>
                </aside>

                <x-sidebar-articles 
                    :cong-trinh-articles="$congTrinhArticles"
                    :cam-nhan-articles="$camNhanArticles"
                    :show-category="true"
                    :show-date="true" 
                    class="sidebar-box" />
            </div>
        </div>
    </div>

</section>

@include('customers.partials.form_signup_with_info')
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