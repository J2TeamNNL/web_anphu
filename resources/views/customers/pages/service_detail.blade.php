@extends('customers.layouts.master')

@push('styles')
<style>
    /* ==== Luxury Gold on Dark theme ==== */
    :root {
        --gold: #C9B037;
        --navy-dark: #0b1c2c;
        --navy-medium: #142d4c;
        --text-light: #fff;
    }

    /* Background chính */
    .service-section-bg {
        background-color: #0b1c2c; /* fallback */
        background-image:
            linear-gradient(rgba(11, 28, 44, 0.6), rgba(11, 28, 44, 0.6)),
            url('/assets/img/gallery/background_danmask_1.jpg');
        background-position: center;
        background-repeat: repeat;
        background-size: auto;
        background-attachment: fixed; /* parallax */
        position: relative;
        border-bottom: 3px solid var(--anphu-gold);
    }
        

    /* Heading gradient vàng */
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
        background-color: var(--navy-dark);
        border: 2px solid var(--gold);
        color: var(--text-light);
        transition: all 0.3s ease;
    }
    .card-service:hover {
        background: linear-gradient(135deg, #0c2b3a, #134e60);
        color: var(--color-white);
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(201,176,55,0.4);
    }
    .card-service h5 {
        color: var(--anphu-light);
        text-shadow: 0 1px 2px rgba(201,176,55,0.3);
    }
    .card-service:hover h5 {
        color: var(--color-secondary);
        text-shadow: none;
    }


    /* Mục lục */
    .service-toc {
        background: var(--navy-dark);
        border: 1px solid var(--gold);
        border-radius: 6px;
        padding: 0.75rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    .service-toc h4 {
        color: var(--gold);
    }
    .service-toc a {
        color: var(--text-light);
        transition: 0.2s;
    }
    .service-toc a:hover {
        background-color: rgba(201,176,55,0.15);
        color: var(--gold);
    }
    .service-toc a.active {
        background-color: var(--gold);
        color: var(--navy-dark) !important;
        font-weight: 600;
    }

    /* Nội dung dịch vụ */
    .content-service-section {
        background-color: var(--navy-dark);
        color: var(--text-light);
        border: 2px solid var(--gold);
        border-radius: 6px;
        padding: 2rem;
    }
    .content-service-section img {
        max-width: 100%;
        height: auto;
        display: block;
        border: 2px solid var(--gold);
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
</style>
@endpush

@section('content')
<section class="py-5 service-section-bg">
    <div class="container">
        <div class="text-center mb-5">
            <h5 class="heading-service-detail">
                Dịch vụ <span style="color: var(--gold)">{{ $service->name }}</span>
            </h5>
            <h3 class="font-weight-bold" style="color: var(--gold)">{{ $service->slogan }}</h3>
            <p style="color: var(--text-light)">{{ $service->description }}</p>
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

        {{-- Phần content_service với mục lục sticky --}}
        @if (!empty($service->content_service))
        <div class="service-wrapper mt-5">
            <!-- Sidebar mục lục -->
            <aside class="service-toc">
                <h4>Mục lục</h4>
                <ul id="service-toc-list"></ul>
            </aside>

            <!-- Nội dung dịch vụ -->
            <div class="content-service-section" id="service-content">
                {!! $service->content_service !!}
            </div>
        </div>

        <!-- Nút báo giá -->
        <div class="text-center mt-4">
            <a href="{{ route('customers.service.price', $service->slug) }}" class="custom-price-btn">
                📄 Báo giá dịch vụ
            </a>
        </div>
        @endif
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

    // Cuộn mượt
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

    // Highlight mục lục
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
