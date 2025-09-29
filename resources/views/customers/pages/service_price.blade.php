@extends('customers.layouts.master')


@section('content')
<section class="py-4 section-bg">
    <div class="container my-4">
        <div class="page-wrapper">
            <!-- Nội dung chính -->
            <div class="main-content" id="service-content">
                {!! $service->content_price !!}
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
    <x-consulting-form
        title="ĐĂNG KÝ NHẬN BÁO GIÁ MIỄN PHÍ"
        style="default"
        class="w-50 mx-auto"
    />
</section>
@include('customers.partials.anphu.partner')
@endsection

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