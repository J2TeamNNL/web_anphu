@extends('customers.layouts.master')

@section('content')

    @push('styles')
    <style>
        :root {
            --lux-dark: #0b1c2c;
            --lux-dark-2: #081420;
            --lux-gold: var(--color-secondary);
            --lux-gold-light: #e4c465;
            --lux-text-light: #f5f2e7;
        }

        .section-bg-culture-detail {
            background-color: var(--lux-dark);
            background-image:
                linear-gradient(rgba(11, 28, 44, 0.85), rgba(11, 28, 44, 0.85)),
                url('/assets/img/gallery/background_danmask_1.jpg');
            background-position: center;
            background-repeat: repeat;
            background-size: auto;
            background-attachment: fixed;
            border-bottom: 2px solid var(--lux-gold);
        }

        .culture-wrapper {
            display: flex;
            gap: 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .culture-wrapper img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 1rem auto;
            border-radius: 6px;
        }

        /* Nội dung */
        .culture-content {
            flex: 1;
            padding: 2rem;
            background-color: var(--lux-dark-2);
            border: 1px solid var(--lux-gold);
            border-radius: 8px;
            color: var(--lux-text-light);
            box-shadow: 0 4px 15px rgba(0,0,0,0.6);
            animation: fadeInUp 0.6s ease;
        }

        .culture-content h1, .culture-content h2, .culture-content h3, .culture-content h4, .culture-content h5 {
            color: var(--lux-gold-light);
            font-weight: 600;
        }

        .culture-content p, .culture-content li {
            font-size: 1.05rem;
            line-height: 1.75;
        }

        /* Sidebar TOC */
        .culture-toc {
            width: 300px;
            background: var(--lux-dark-2);
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid var(--lux-gold);
            box-shadow: 0 4px 10px rgba(0,0,0,0.5);
            color: var(--lux-text-light);
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .culture-toc h5 {
            color: var(--lux-gold);
            font-size: 1rem;
            margin-bottom: 0.75rem;
        }

        .culture-toc ul {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .culture-toc a {
            text-decoration: none;
            color: var(--lux-text-light);
            display: block;
            padding: 6px 8px;
            border-radius: 4px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .culture-toc a:hover {
            background-color: rgba(201,176,55,0.15);
            color: var(--lux-gold-light);
        }

        .culture-toc a.active {
            background-color: var(--lux-gold);
            color: var(--lux-dark);
        }

        @media (max-width: 1024px) {
            .culture-wrapper {
                flex-direction: column;
            }
            .culture-toc {
                width: 100%;
                position: static;
            }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @endpush

    @section('content')
    <section class="py-4 section-bg-culture-detail">
        <div class="container my-4">
            <div class="culture-wrapper">
                <!-- Nội dung chính -->
                <div class="culture-content" id="culture-content">
                    <!-- Định hướng -->
                    <h2 class="fw-bold text-uppercase mb-4" style="color:white;">{{ $page->title_1 }}</h2>

                    {!! $page->custom_content_1 !!}
                </div>

                <!-- Sidebar -->
                <aside class="culture-toc">
                    <h5>Mục lục</h5>
                    <ul id="culture-toc-list"></ul>
                </aside>
            </div>
        </div>
    </section>
    @endsection

    @push('scripts')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const content = document.getElementById("culture-content");
        const tocList = document.getElementById("culture-toc-list");

        const targetTitles = [
            "Tầm Nhìn Dài Hạn",
            "Giá Trị Cốt Lõi",
            "Năng Lực Lõi",
            "Chuẩn Mực Phục Vụ Khách Hàng"
        ];

        const headings = Array.from(content.querySelectorAll("h4"))
            .filter(h => targetTitles.includes(h.textContent.trim()));

        headings.forEach((heading, index) => {
            const id = "section-" + index;
            heading.id = id;
            const li = document.createElement("li");
            const a = document.createElement("a");
            a.href = "#" + id;
            a.textContent = heading.textContent.trim();
            a.classList.add("toc-link");
            li.appendChild(a);
            tocList.appendChild(li);
        });

        window.addEventListener("scroll", () => {
            let fromTop = window.scrollY + 120;
            document.querySelectorAll(".toc-link").forEach(link => {
                const section = document.querySelector(link.hash);
                if (section.offsetTop <= fromTop && section.offsetTop + section.offsetHeight > fromTop) {
                    link.classList.add("active");
                } else {
                    link.classList.remove("active");
                }
            });
        });
    });
    </script>
    @endpush


    @include('customers.partials.anphu.solution')
    
    @include('customers.partials.form_signup_with_info')

    @include('customers.partials.anphu.partner')
@endsection

