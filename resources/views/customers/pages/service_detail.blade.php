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

    .section-bg-service-detail {
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

    .service-wrapper {
        display: flex;
        gap: 1rem;
        max-width: 1200px;
        margin: 0 auto;
        align-items: flex-start;
    }

    .service-content {
        flex: 1;
        padding: 2rem;
        background-color: var(--lux-dark-2);
        border: 1px solid var(--lux-gold);
        border-radius: 8px;
        color: var(--lux-text-light);
        box-shadow: 0 4px 15px rgba(0,0,0,0.6);
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
        color: var(--lux-gold-light);
        font-weight: 600;
    }

    .service-content img {
        max-width: 100% !important;
        height: auto !important;
        display: block;
        margin: 0 auto;
        border-radius: 6px;
        border: 1px solid var(--lux-gold);
    }

    .service-right {
        width: 300px;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        position: sticky;
        top: 100px;
        align-self: flex-start;
    }

    .service-toc {
        background: var(--lux-dark-2);
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid var(--lux-gold);
        box-shadow: 0 4px 10px rgba(0,0,0,0.5);
        color: var(--lux-text-light);
    }

    .service-toc h5 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--lux-gold);
    }

    .service-toc ul {
        list-style: none;
        padding-left: 0;
        margin: 0;
    }

    .service-toc li {
        margin-bottom: 0.4rem;
        line-height: 1.4;
    }

    .service-toc a {
        text-decoration: none;
        color: var(--lux-text-light);
        font-size: 0.9rem;
        display: block;
        padding: 6px 8px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .service-toc a:hover {
        background-color: rgba(201,176,55,0.15);
        color: var(--lux-gold-light);
    }

    .service-toc a.active {
        background-color: var(--lux-gold);
        color: var(--lux-dark);
        font-weight: 500;
    }

    .service-extra {
        background: var(--lux-dark-2);
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid var(--lux-gold);
        box-shadow: 0 4px 10px rgba(0,0,0,0.5);
        color: var(--lux-text-light);
    }

    .service-extra h5 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--lux-gold);
    }

    .service-extra p {
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .heading-service-detail {
        text-align: center;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        background: linear-gradient(90deg, #eac976, #d4a537);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
        text-shadow: 0 0 10px rgba(201,176,55,0.6);
    }

    /* Card dịch vụ */
    .card-service {
        background-color: var(--lux-dark-2);
        border: 2px solid var(--lux-gold);
        color: var(--lux-text-light);
        transition: all 0.3s ease;
    }
    .card-service:hover {
        background: linear-gradient(135deg, #0c2b3a, #134e60);
        color: var(--lux-text-light);
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(201,176,55,0.4);
    }
    .card-service h5 {
        color: var(--lux-gold-light);
        text-shadow: 0 1px 2px rgba(201,176,55,0.3);
    }
    .card-service:hover h5 {
        color: var(--lux-gold);
        text-shadow: none;
    }


    /* Nút báo giá */
    .custom-price-btn {
        display: inline-block;
        padding: 12px 24px;
        border: 2px solid var(--gold);
        border-radius: 6px;
        background: transparent;
        color: var(--gold);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    .custom-price-btn:hover {
        background: var(--gold);
        color: var(--navy-dark);
        box-shadow: 0 4px 15px rgba(201,176,55,0.4);
        transform: translateY(-2px);
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 1024px) {
        .service-wrapper {
            flex-direction: column;
        }
        .service-right {
            width: 100%;
            position: static;
        }
        .service-extra {
            margin-top: 1rem;
        }
    }
</style>
@endpush

@section('content')
<section class="py-5 section-bg-service-detail">
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

        <section class="py-4 section-bg-service-detail">
            <div class="container my-4">
                <div class="service-wrapper">
                    <!-- Nội dung chính -->
                    <div class="service-content" id="service-content">
                        {!! $service->content_service !!}
                    </div>

                    <!-- Bên phải: TOC + special contents -->
                    <div class="service-right">
                        <aside class="service-toc">
                            <h5>Mục lục</h5>
                            <ul id="service-toc-list"></ul>
                        </aside>

                        <div class="service-extra">
                            <h5>Nội dung khác</h5>
                            <p>...</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Nút báo giá -->
        <div class="text-center mt-4">
            <a href="{{ route('customers.service.price', $service->slug) }}" class="custom-price-btn">
                📄 Báo giá dịch vụ
            </a>
        </div>
    </div>
</section>

@include('customers.partials.anphu.demo_projects')
@include('customers.partials.sign_up_1')
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