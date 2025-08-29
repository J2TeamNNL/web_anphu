@php
    $custom_pages = $custom_pages ?? collect();
    $services = $services ?? collect();
    $portfoliosCategories = $portfoliosCategories ?? collect();
    $blogsCategories = $blogsCategories ?? collect();

    $menuSlugs = ['about-anphu', 'gia-tri-van-hoa', 'thu-ngo'];
@endphp

<nav class="navbar main-nav navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <button
            class="navbar-toggler bg-white"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto flex-column flex-lg-row">

                {{-- Trang chủ --}}
                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 small {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link text-center" href="{{ route('customers.index') }}">
                        <i class="fa fa-home mr-1"></i> Trang Chủ
                    </a>
                </li>

                {{-- Về An Phú --}}
                <!-- <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 dropdown small 
                    {{ request()->is('ve-an-phu*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle text-center" href="#" id="aboutDropdown" data-toggle="dropdown">
                        <i class="fa fa-building me-1"></i> Về An Phú
                    </a>
                    <div class="dropdown-menu">
                        @foreach($custom_pages as $page)
                            @if($page->slug !== 'index' && $page->slug !== 'uu-dai' && $page->slug !== 'lien-he')
                                <a class="dropdown-item small {{ request()->is('about/' . $page->slug) ? 'active' : '' }}"
                                href="{{ route('customers.custom_page', $page->slug) }}">
                                    <i class="fa fa-building me-2 icon-highlight"></i>
                                    {{ $page->name }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </li> -->

                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 dropdown small 
    {{ request()->is('ve-an-phu*') ? 'active' : '' }}">
    <a class="nav-link dropdown-toggle text-center" href="#" id="aboutDropdown" data-toggle="dropdown">
        <i class="fa fa-building me-1"></i> Về An Phú
    </a>
    <div class="dropdown-menu">
        @foreach($menuSlugs as $slug)
            @php
                $page = $custom_pages->firstWhere('slug', $slug);
            @endphp
            @if($page)
                <a class="dropdown-item small {{ request()->is('about/' . $page->slug) ? 'active' : '' }}"
                   href="{{ route('customers.custom_page', $page->slug) }}">
                    <i class="fa fa-building me-2 icon-highlight"></i>
                    {{ $page->name }}
                </a>
            @endif
        @endforeach
    </div>
</li>

                {{-- Dịch vụ --}}
                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 dropdown small {{ request()->is('dich-vu*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle text-center" href="#" id="serviceDropdown" data-toggle="dropdown">
                        <i class="fa fa-tools me-1"></i> Dịch Vụ
                    </a>
                    <div class="dropdown-menu">
                        @foreach($services as $service)
                            <a class="dropdown-item small {{ request()->is('dich-vu/' . $service->slug) ? 'active' : '' }}"
                               href="{{ route('customers.service.detail', $service->slug) }}">
                                <i class="fa fa-tools me-2 icon-highlight"></i> {{ $service->name }}
                            </a>
                        @endforeach
                    </div>
                </li>

                {{-- Dự án --}}
                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 dropdown small {{ request()->is('du-an*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle text-center" href="#" id="projectDropdown" data-toggle="dropdown">
                        <i class="fa fa-project-diagram me-1"></i> Dự án
                    </a>
                    <div class="dropdown-menu" aria-labelledby="projectDropdown">
                        @foreach($portfoliosCategories as $category)
                            <a class="dropdown-item small {{ request()->is('du-an/danh-muc/' . $category->slug) ? 'active' : '' }}"
                               href="{{ route('projects.byCategory', ['slug' => $category->slug]) }}">
                                <i class="fa fa-project-diagram icon-highlight"></i> {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </li>

                {{-- Báo giá --}}
                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 dropdown small {{ request()->is('bao-gia*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle text-center" href="#" id="priceDropdown" data-toggle="dropdown">
                        <i class="fa fa-tags me-1"></i> Báo Giá
                    </a>
                    <div class="dropdown-menu">
                        @foreach($services as $service)
                            <a class="dropdown-item small {{ request()->is('bao-gia/' . $service->slug) ? 'active' : '' }}"
                               href="{{ route('customers.service.price', $service->slug) }}">
                                <i class="fa fa-tags me-2 icon-highlight"></i> Báo giá {{ $service->name }}
                            </a>
                        @endforeach
                    </div>
                </li>

                {{-- Hoạt động / Blog --}}
                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 dropdown small {{ request()->is('bai-dang*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle text-center" href="#" id="blogDropdown" data-toggle="dropdown">
                        <i class="fa fa-newspaper me-1"></i> Hoạt động
                    </a>
                    <div class="dropdown-menu" aria-labelledby="blogDropdown">
                        @foreach($blogsCategories as $category)
                            <a class="dropdown-item small {{ request()->is('bai-dang/danh-muc/' . $category->slug) ? 'active' : '' }}"
                               href="{{ route('customers.blog.index', ['slug' => $category->slug]) }}">
                                <i class="fa fa-newspaper me-2 icon-highlight"></i> {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </li>

                {{-- Liên hệ --}}
                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 small {{ request()->is('lien-he') ? 'active' : '' }}">
                    <a class="nav-link text-center" href="{{ route('customers.contact') }}">
                        <i class="fa fa-phone me-1"></i> Liên hệ
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>