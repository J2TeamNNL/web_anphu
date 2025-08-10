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

    /* Container bao ngoài giữ nội dung quill giữa */
    .service-wrapper {
        position: relative;
        max-width: 900px; /* bề rộng nội dung chính */
        margin: 0 auto;   /* căn giữa */
    }

    /* Sidebar mục lục tách hẳn sang trái */
    .service-toc {
        position: absolute;
        left: -260px; /* đẩy hẳn sang trái */
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
        display: inline-block; /* Cho phép wrap text */
        white-space: normal;   /* Cho phép xuống dòng */
    }

    .service-toc a:hover,
    .service-toc a.active {
        color: #C9B037;
        font-weight: 500;
    }

    /* Nội dung chi tiết */
    .content-service-section {
        padding: 2rem;
        background-color: #fff;
        border: 1px solid rgba(0,0,0,0.3); /* viền mờ cho cả 4 cạnh */
        box-shadow: 0 2px 8px rgba(0,0,0,0.05); /* hiệu ứng nổi nhẹ */
        border-radius: 6px; /* bo nhẹ cho mềm mại hơn */
        animation: fadeInUp 0.6s ease;
    }
    .content-service-section p {
        font-size: 1.05rem;
        line-height: 1.75;
        margin-bottom: 1rem;
    }
    .content-service-section h1,
    .content-service-section h2,
    .content-service-section h3 {
        margin-top: 1.5rem;
        color: #030a36;
        font-weight: 600;
    }

    .content-service-section img {
        max-width: 100% !important;;
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

        {{-- Nội dung chi tiết dịch vụ kèm mục lục --}}
        @if (!empty($service->content_service))
            <div class="service-wrapper mt-5">
                <!-- Sidebar mục lục -->
                <aside class="service-toc">
                    <h4>Mục lục</h4>
                    <ul id="service-toc-list"></ul>
                </aside>

                <!-- Nội dung -->
                <div class="content-service-section" id="service-content">
                    {!! $service->content_service !!}
                </div>
            </div>
        @endif
            
        {{-- Nút báo giá --}}
        <div class="row">
            <div class="col-12 text-center mt-4">
                <a href="{{ route('customers.service.price', $service->slug) }}" class="btn-outline-shadow">
                    📄 Báo giá dịch vụ
                </a>
            </div>
        </div>
    </div>
</section>

@include('customers.partials.sign_up_1')
@include('customers.partials.anphu.demo_projects')
@include('customers.partials.anphu.partner')

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const content = document.getElementById("service-content");
    const tocList = document.getElementById("service-toc-list");
    const headings = content.querySelectorAll("h1, h2, h3, h4, h5, h6");

    headings.forEach((heading, index) => {
        // Tạo id cho heading nếu chưa có
        if (!heading.id) {
            heading.id = "section-" + index;
        }

        // Tạo mục trong TOC
        const li = document.createElement("li");
        const a = document.createElement("a");
        a.href = "#" + heading.id;
        a.textContent = heading.textContent;
        a.classList.add("toc-link");

        // Căn lề & font theo cấp độ heading
        const level = parseInt(heading.tagName.substring(1)); // 1-6
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
