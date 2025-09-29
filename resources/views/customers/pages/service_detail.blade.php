@extends('customers.layouts.master')

@section('content')
<section class="py-5 section-bg">
    <div class="container">
        <div class="text-center mb-5">
            <h5 class="heading-service-detail">
                Dịch vụ <span style="color: var(--gold)">{{ $service->name }}</span>
            </h5>
            <h3 class="font-weight-bold text-white">{{ $service->slogan }}</h3>
            <p class="text-white">{{ $service->description }}</p>
        </div>

        {{-- Cards dịch vụ --}}
        <div class="row justify-content-center">
            @foreach (range(1, 4) as $i)
                @php
                    $icon = "icon_{$i}";
                    $title = "title_{$i}";
                    $content = "content_{$i}";
                @endphp
                @if (!empty($service->$title) && !empty($service->$content))
                    <div class="col-lg-5 col-md-6 mb-5 d-flex">
                        <div class="card card-service shadow rounded p-4 position-relative d-flex flex-column w-100">
                            <div class="icon-circle-2 position-absolute d-flex align-items-center justify-content-center">
                                <img src="{{ $service->$icon }}" alt="Icon">
                            </div>
                            <h5 class="font-weight-bold mt-4">{{ $service->$title }}</h5>
                            <p>{{ $service->$content }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <section class="py-4 section-bg">
            <div class="container my-4">
                <div class="page-wrapper">
                    <!-- Nội dung chính -->
                    <div class="main-content" id="service-content">
                        {!! $service->content_service !!}
                    </div>

                    <!-- Bên phải: TOC + special contents -->
                    <div class="sidebar">
                        <aside class="sidebar-box">
                            <h5>Mục lục</h5>
                            <ul class="toc-list" id="service-toc-list"></ul>
                        </aside>

                        <x-sidebar-articles 
                            :cong-trinh-articles="$congTrinhArticles"
                            :cam-nhan-articles="$camNhanArticles"
                            :show-category="true"
                            :show-date="true" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Nút báo giá -->
        <div class="text-center mt-4">
            <a href="{{ route('customers.service.price', $service->slug) }}" class="btn btn-detail">
                <i class="fas fa-file-invoice-dollar me-2"></i>
                Báo giá dịch vụ
            </a>
        </div>
    </div>
</section>

@include('customers.partials.form_signup_with_info')
@include('customers.partials.anphu.partner')
@endsection

@push('styles')
<style>
.btn-detail {
    background: transparent;
    color: var(--color-secondary);
    border: 2px solid var(--color-secondary);
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-detail:hover {
    background: var(--color-secondary);
    color: #070f47;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(201, 176, 55, 0.4);
    text-decoration: none;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const content = document.getElementById("service-content");
    const tocList = document.getElementById("service-toc-list");
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