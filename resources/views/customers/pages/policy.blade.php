@extends('customers.layouts.master')

@push('styles')
<style>
    .policy-wrapper {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 2rem;
    }

    /* Sidebar mục lục */
    .policy-toc {
        position: sticky;
        top: 100px;
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        height: fit-content;
    }

    .policy-toc h5 {
        font-size: 1rem;
        margin-bottom: 0.75rem;
        font-weight: 600;
        color: #0d6efd;
    }

    .policy-toc ul {
        list-style: none;
        padding-left: 0;
        margin: 0;
    }

    .policy-toc li {
        margin-bottom: 0.5rem;
    }

    .policy-toc a {
        text-decoration: none;
        color: #333;
        font-size: 0.95rem;
        transition: color 0.2s;
    }

    .policy-toc a:hover,
    .policy-toc a.active {
        color: #0d6efd;
        font-weight: 500;
    }

    /* Nội dung chính sách */
    .policy-content {
        padding: 2rem;
        background-color: #fff;
        border-left: 4px solid #0d6efd;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border-radius: 6px;
        animation: fadeInUp 0.6s ease;
    }

    .policy-content p {
        font-size: 1.05rem;
        line-height: 1.75;
        margin-bottom: 1rem;
    }

    .policy-content h1, .policy-content h2, .policy-content h3 {
        margin-top: 1.5rem;
        color: #030a36;
        font-weight: 600;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .policy-wrapper {
            grid-template-columns: 1fr;
        }
        .policy-toc {
            position: static;
            margin-bottom: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container my-4 policy-wrapper">
    <!-- Sidebar mục lục -->
    <aside class="policy-toc">
        <h5>Mục lục</h5>
        <ul id="policy-toc-list"></ul>
    </aside>

    <!-- Nội dung chính sách -->
    <div class="policy-content mb-4" id="policy-content">
        {!! $policyContent !!}
    </div>
</div>

@include('customers.partials.anphu.partner')
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const content = document.getElementById("policy-content");
    const tocList = document.getElementById("policy-toc-list");
    const headings = content.querySelectorAll("h2, h3");

    headings.forEach((heading, index) => {
        const id = "section-" + index;
        heading.id = id;

        const li = document.createElement("li");
        const a = document.createElement("a");
        a.href = "#" + id;
        a.textContent = heading.textContent;
        a.classList.add("toc-link");

        if (heading.tagName.toLowerCase() === "h3") {
            a.style.paddingLeft = "15px";
            a.style.fontSize = "0.9rem";
        }

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