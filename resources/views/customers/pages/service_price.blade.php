@extends('customers.layouts.master')

@push('styles')
<style>
    /* Container bao ngoài giữ nội dung quill giữa */
    .service-wrapper {
        position: relative;
        max-width: 900px;
        margin: 0 auto;
    }

    /* Sidebar mục lục tách hẳn sang trái */
    .service-toc {
        position: absolute;
        left: -260px;
        top: 0;
        width: 220px;
        background: #fff;
        padding: 0.75rem;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .service-toc h5 {
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #0d6efd;
    }

    .service-toc ul {
        list-style: none;
        padding-left: 1rem;
        margin: 0;
    }

    .service-toc li {
        margin-bottom: 0.4rem;
        line-height: 1.3;
    }

    .service-toc a {
        text-decoration: none;
        color: #333;
        font-size: 0.9rem;
        display: inline-block;
        white-space: normal;
        transition: color 0.2s ease;
    }

    .service-toc a:hover,
    .service-toc a.active {
        color: #C9B037;
        font-weight: 500;
    }

    /* Nội dung dịch vụ */
    .service-content {
        padding: 2rem;
        background-color: #fff;
        border: 1px solid rgba(0,0,0,0.3);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border-radius: 6px;
        animation: fadeInUp 0.6s ease;
    }
    .service-content p {
        font-size: 1.05rem;
        line-height: 1.75;
        margin-bottom: 1rem;
    }
    .service-content h1,
    .service-content h2,
    .service-content h3 {
        margin-top: 1.5rem;
        color: #030a36;
        font-weight: 600;
    }
    .service-content img {
        max-width: 100% !important;
        height: auto !important;
        display: block;
        margin: 0 auto;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .service-toc {
            position: static;
            left: auto;
            width: 100%;
            margin-bottom: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container my-4">
    <div class="service-wrapper">
        <!-- Sidebar mục lục -->
        <aside class="service-toc">
            <h5>Mục lục</h5>
            <ul id="service-toc-list"></ul>
        </aside>

        <!-- Nội dung -->
        <div class="service-content" id="service-content">
            {!! $service->content_price !!}
        </div>
    </div>
</div>

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
        if (!heading.id) {
            heading.id = "section-" + index;
        }

        const li = document.createElement("li");
        const a = document.createElement("a");
        a.href = "#" + heading.id;
        a.textContent = heading.textContent;
        a.classList.add("toc-link");

        // Padding theo cấp heading
        const level = parseInt(heading.tagName.substring(1));
        a.style.paddingLeft = `${(level - 1) * 15}px`;
        a.style.fontSize = `${1 - (level - 1) * 0.05}rem`;

        li.appendChild(a);
        tocList.appendChild(li);
    });

    // Highlight mục lục khi cuộn
    const tocLinks = document.querySelectorAll(".toc-link");
    window.addEventListener("scroll", () => {
        let fromTop = window.scrollY + 120;
        tocLinks.forEach(link => {
            const section = document.querySelector(link.hash);
            if (
                section.offsetTop <= fromTop &&
                section.offsetTop + section.offsetHeight > fromTop
            ) {
                link.classList.add("active");
            } else {
                link.classList.remove("active");
            }
        });
    });
});
</script>
@endpush