@php
    $homeRoutes = ['customers.index'];

    $aboutRoutes = [
        'about.anphu',
        'about.open_letter',
        'about.cultural_values'
    ];

    $serviceRoutes = [
        'services.permit',
        'services.design',
        'services.construction_full',
        'services.construction_raw'
    ];


    $priceRoutes = [
        'price.full',
        'price.raw',
        'price.design',
        'price.permit'
    ];

    $consultantRoutes = ['customers.consultant'];
    $blogRoutes = ['customers.blog'];
    $contactRoutes = ['customers.contact'];
@endphp

<!-- Navigation bar -->
<nav class="navbar main-nav navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto flex-column flex-lg-row">

                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 small {{ isActive($homeRoutes) }}">
                    <a class="nav-link text-center" href="{{ route('customers.index') }}">
                        <i class="fa fa-home mr-1"></i>Trang Chủ
                    </a>
                </li>

                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 dropdown small {{ isActive($aboutRoutes) }}">
                    <a class="nav-link dropdown-toggle text-center" href="#" id="aboutDropdown" data-toggle="dropdown">
                        <i class="fa fa-users mr-1"></i>Về An Phú
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item small {{ isActive('about.anphu') }}" href="{{ route('about.anphu') }}">
                            <i class="fa fa-users icon-highlight"></i>
                            Giới thiệu
                        </a>
                        <a class="dropdown-item small {{ isActive('about.open_letter') }}" href="{{ route('about.open_letter') }}">
                            <i class="fa fa-users icon-highlight"></i>
                            Thư ngỏ
                        </a>
                        <a class="dropdown-item small {{ isActive('about.cultural_values') }}" href="{{ route('about.cultural_values') }}">
                            <i class="fa fa-users icon-highlight"></i>
                            Giá trị văn hóa
                        </a>
                    </div>
                </li>

                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 dropdown small {{ isActive($serviceRoutes) }}">
                    <a class="nav-link dropdown-toggle text-center" id="aboutDropdown" data-toggle="dropdown">
                        <i class="fa fa-cogs mr-1"></i>Dịch Vụ
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item small {{ isActive('services.construction_full') }}" href="{{ route('services.construction_full') }}">
                            <i class="fa fa-cog mr-1 icon-highlight"></i>
                            Xây nhà trọn gói
                        </a>
                        <a class="dropdown-item small {{ isActive('services.design_architect') }}" href="{{ route('services.design_architect') }}">
                            <i class="fa fa-cog mr-1 icon-highlight"></i>
                            Thiết kế kiến trúc
                        </a>
                        <a class="dropdown-item small {{ isActive('services.design_interior') }}" href="{{ route('services.design_interior') }}">
                            <i class="fa fa-cog mr-1 icon-highlight"></i>
                            Thiết kế nội thất
                        </a>
                        <a class="dropdown-item small {{ isActive('services.construction_renovate') }}" href="{{ route('services.construction_renovate') }}">
                            <i class="fa fa-cog mr-1 icon-highlight"></i>
                            Cải tạo nhà cũ
                        </a>
                    </div>
                </li>

                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 dropdown small {{ isset($selectedCategory) ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle text-center" href="#" id="projectDropdown" data-toggle="dropdown">
                        <i class="fa fa-cubes mr-1"></i>Dự án
                    </a>
                    <div class="dropdown-menu" aria-labelledby="projectDropdown">
                        @foreach($portfoliosCategories as $category)
                            <a
                                class="dropdown-item small {{ isset($selectedCategory) && $selectedCategory->id === $category->id ? 'active' : '' }}"
                                href="{{ route('projects.byCategory', ['slug' => $category->slug]) }}"
                            >
                                <i class="fa fa-cube mr-1 icon-highlight"></i>{{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </li>

                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 dropdown small {{ isActive($priceRoutes) }}">
                    <a class="nav-link dropdown-toggle text-center" href="#" id="aboutDropdown" data-toggle="dropdown">
                        <i class="fa fa-dollar-sign mr-1"></i>Bảng Giá
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item small {{ isActive('price.full') }}" href="{{ route('price.full') }}"><i class="fa fa-dollar-sign mr-1 icon-highlight"></i> Báo giá Xây nhà trọn gói</a>
                        <a class="dropdown-item small {{ isActive('price.raw') }}" href="{{ route('price.raw') }}"><i class="fa fa-dollar-sign mr-1 icon-highlight"></i> Báo giá Xây thô</a>
                        <a class="dropdown-item small {{ isActive('price.design') }}" href="{{ route('price.design') }}"><i class="fa fa-dollar-sign mr-1 icon-highlight"></i> Báo giá Thiết kế</a>
                        <a class="dropdown-item small {{ isActive('price.permit') }}" href="{{ route('price.permit') }}"><i class="fa fa-dollar-sign mr-1 icon-highlight"></i> Báo giá Xin cấp phép xây dựng</a>
                    </div>
                </li>

                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 small {{ isActive($consultantRoutes) }}">
                    <a class="nav-link text-center" href="{{ route('customers.consultant') }}">
                        <i class="fa fa-comments mr-1"></i>Tư vấn
                    </a>
                </li>

                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 small {{ isActive($blogRoutes) }}">
                    <a class="nav-link text-center" href="{{ route('blogs.index') }}">
                        <i class="fa fa-newspaper mr-1"></i>Hoạt động
                    </a>
                </li>

                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 small {{ isActive($contactRoutes) }}">
                    <a class="nav-link text-center" href="{{ route('customers.contact') }}">
                        <i class="fa fa-phone-alt mr-1"></i>Liên hệ
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
