@extends('customers.layouts.master')
@push('styles')
<style>
    .btn-outline-shadow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: white;
        color: #007bff;
        font-size: 1.05rem;
        font-weight: 600;
        border: 2px solid #007bff;
        border-radius: 50px;
        padding: 12px 28px;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.25);
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .btn-outline-shadow:hover {
        background-color: #007bff;
        color: white;
        box-shadow: 0 6px 16px rgba(0, 123, 255, 0.4);
        transform: translateY(-2px);
    }
    .btn-outline-shadow:active {
        transform: translateY(0);
        box-shadow: 0 3px 8px rgba(0, 123, 255, 0.3);
    }

    .service-section-bg {
        background-image: url("{{ asset('assets/img/gallery/background_construction_1.webp') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-color: #181f2f;
        width: 100%;
        padding: 1px 0;
    }

    .service-wrapper {
        display: grid;
        grid-template-columns: 240px 1fr;
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .service-toc {
        position: sticky;
        top: 100px; /* khoảng cách từ top khi sticky */
        align-self: start;
        background: #fff;
        padding: 0.75rem;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        word-wrap: break-word;
        overflow-wrap: break-word;
        max-height: calc(100vh - 120px);
        overflow-y: auto;
    }

    .service-toc h4 {
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #0d6efd;
    }

    .service-toc ul {
        list-style: none;
        padding-left: 0;
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
        display: block;
        transition: all 0.2s ease;
        border-radius: 4px;
        padding: 4px 6px;
    }

    .service-toc a:hover {
        background-color: rgba(201, 176, 55, 0.15);
        color: #C9B037;
        font-weight: 500;
    }

    .service-toc a.active {
        background-color: #C9B037;
        color: #fff !important;
        font-weight: 600;
    }

    .content-service-section {
        padding: 2rem;
        background-color: #fff;
        border: 2px solid #C9B037;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border-radius: 6px;
    }

    @media (max-width: 1024px) {
        .service-wrapper {
            grid-template-columns: 1fr;
        }
        .service-toc {
            position: static;
            max-height: none;
            overflow-y: visible;
            margin-bottom: 1rem;
        }
    }
</style>
@endpush

@section('content')
<section class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h5 class="font-weight-bold" style="color: #030a36">
                Dịch vụ
                <span style="color: #C9B037">{{ $service->name }}</span>
                của {{ $companySettings->company_brand }}
            </h5>
            <h3 class="font-weight-bold">{{ $service->slogan }}</h3>
            <p class="text-dark">{{ $service->description }}</p>
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
                                <img src="{{ $service->$icon }}" alt="Icon" style="height: 50px;">
                            </div>
                            <h5 class="font-weight-bold mt-4 text-primary">{{ $service->$title }}</h5>
                            <p>{{ $service->$content }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

{{-- Phần content_service với mục lục sticky --}}
@if (!empty($service->content_service))
<div class="service-section-bg">
<h3
    style="
        text-align: center;
        font-weight: 700;
        margin: 2rem 0;
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        background: linear-gradient(45deg, #FFD700, #C9B037);
        -webkit-background-clip: text;
        color: transparent;
        text-shadow: 0 0 10px rgba(201,176,55,0.6);
    "
>
    Chi tiết dịch vụ {{ $service->name }}
</h3>
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
</div>
@endif

{{-- Nút báo giá --}}
<div class="row">
    <div class="col-12 text-center mt-4">
        <a href="{{ route('customers.service.price', $service->slug) }}" class="btn-outline-shadow">
            📄 Báo giá dịch vụ
        </a>
        <hr>
    </div>
</div>

@include('customers.partials.sign_up_1')
@include('customers.partials.anphu.demo_projects')
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

    // Cuộn mượt khi click
    document.querySelectorAll(".toc-link").forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const targetId = this.getAttribute("href").substring(1);
            const targetEl = document.getElementById(targetId);
            if (targetEl) {
                window.scrollTo({
                    top: targetEl.offsetTop - 80, // chừa khoảng trống header
                    behavior: "smooth"
                });
            }
        });
    });

    // Highlight mục lục khi scroll
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
