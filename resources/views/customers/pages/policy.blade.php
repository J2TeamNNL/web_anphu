@extends('customers.layouts.master')

@push('styles')
<style>
:root {
    --lux-dark: #0b1c2c;
    --lux-dark-2: #081420;
    --lux-gold: var(--color-secondary);
    --lux-gold-light: #e4c465;
    --lux-text-light: #f5f2e7;
}

.section-bg-policy-detail {
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

/* Wrapper chính */
.policy-wrapper {
    display: flex;
    gap: 1rem;
    max-width: 1200px;
    margin: 0 auto;
    align-items: flex-start;
}

/* Nội dung chính */
.policy-content {
    flex: 1;
    padding: 2rem;
    background-color: var(--lux-dark-2);
    border: 1px solid var(--lux-gold);
    border-radius: 8px;
    color: var(--lux-text-light);
    box-shadow: 0 4px 15px rgba(0,0,0,0.6);
    animation: fadeInUp 0.6s ease;
}
.policy-content p {
    font-size: 1.05rem;
    line-height: 1.75;
    margin-bottom: 1rem;
}
.policy-content h1,
.policy-content h2,
.policy-content h3 {
    margin-top: 1.5rem;
    color: var(--lux-gold-light);
    font-weight: 600;
}
.policy-content img {
    max-width: 100% !important;
    height: auto !important;
    display: block;
    margin: 0 auto;
    border-radius: 6px;
    border: 1px solid var(--lux-gold);
}

/* Sidebar TOC */
.policy-toc {
    width: 300px;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    position: sticky;
    top: 100px;
    align-self: flex-start;
    background: var(--lux-dark-2);
    padding: 1rem;
    border-radius: 8px;
    border: 1px solid var(--lux-gold);
    box-shadow: 0 4px 10px rgba(0,0,0,0.5);
    color: var(--lux-text-light);
}
.policy-toc h5 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--lux-gold);
}
.policy-toc ul {
    list-style: none;
    padding-left: 0;
    margin: 0;
}
.policy-toc li {
    margin-bottom: 0.4rem;
    line-height: 1.4;
}
.policy-toc a {
    text-decoration: none;
    color: var(--lux-text-light);
    font-size: 0.9rem;
    display: block;
    padding: 6px 8px;
    border-radius: 4px;
    transition: all 0.3s ease;
}
.policy-toc a:hover {
    background-color: rgba(201,176,55,0.15);
    color: var(--lux-gold-light);
}
.policy-toc a.active {
    background-color: var(--lux-gold);
    color: var(--lux-dark);
    font-weight: 500;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media (max-width: 1024px) {
    .policy-wrapper {
        flex-direction: column;
    }
    .policy-toc {
        width: 100%;
        position: static;
    }
}
</style>
@endpush

@section('content')
<section class="py-4 section-bg-policy-detail">
    <div class="container my-4 policy-wrapper">
        <!-- Nội dung chính -->
        <div class="policy-content" id="policy-content">
            {!! $policyContent !!}
        </div>

        <!-- Sidebar TOC -->
        <aside class="policy-toc">
            <h5>Mục lục</h5>
            <ul id="policy-toc-list"></ul>
        </aside>
    </div>
</section>

@include('customers.partials.anphu.partner')
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const content = document.getElementById("policy-content");
    const tocList = document.getElementById("policy-toc-list");

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

    const tocLinks = document.querySelectorAll(".toc-link");
    window.addEventListener("scroll", () => {
        let fromTop = window.scrollY + 120;
        tocLinks.forEach(link => {
            const section = document.querySelector(link.hash);
            if (section.offsetTop <= fromTop && section.offsetTop + section.offsetHeight > fromTop) {
                tocLinks.forEach(l => l.classList.remove("active"));
                link.classList.add("active");
            }
        });
    });
});
</script>
@endpush
