@extends('customers.layouts.master')

@section('content')

@php
use Illuminate\Support\Str;
@endphp
<section class="py-5 section-bg">
<div class="container my-4">
    <div class="page-wrapper">
        <!-- Cột trái: nội dung bài viết -->
        <div class="main-content" id="blog-content">
            <h2>{{ $article->name }}</h2>
            <p class="text-muted small">Đăng ngày {{ $article->created_at->format('d/m/Y') }}</p>
            <div class="ql-editor">
                {!! $article->content !!}
            </div>

            @if ($article->media->count())
            <div class="media-gallery mt-4">
                <div class="row">
                    @foreach ($article->media as $media)
                        <div class="col-md-4 mb-4 d-flex align-items-stretch">
                            <div class="card shadow-sm w-100" style="background: var(--lux-dark-2); border:1px solid var(--lux-gold);">
                                @if(Str::contains($media->type, 'image'))
                                    <div class="text-center p-2">
                                        <div class="img-wrapper">
                                            <img src="{{ asset('storage/' . $media->file_path) }}" alt="media">
                                        </div>
                                    </div>
                                @elseif(Str::contains($media->type, 'youtube'))
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{ $media->file_path }}" allowfullscreen style="border:1px solid var(--lux-gold); border-radius:6px;"></iframe>
                                    </div>
                                @endif

                                @if ($media->caption)
                                    <div class="card-body p-2">
                                        <p class="card-text small">{{ $media->caption }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Cột phải: TOC + extra -->
        <div class="sidebar">
            <aside class="sidebar-box">
                <h5>Mục lục</h5>
                <ul class="toc-list" id="blog-toc-list"></ul>
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

@include('customers.partials.anphu.partner')
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const content = document.getElementById("blog-content");
    const tocList = document.getElementById("blog-toc-list");

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