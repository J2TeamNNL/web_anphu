<!-- Navigation bar -->
@php
    $serviceRoutes = [
        'services.permit',
        'services.design',
        'services.construction_full',
        'services.construction_raw'
    ];
@endphp    


    <li class="nav-item mx-2 dropdown {{ isActive($serviceRoutes) }}">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('customers.index') }}">
                            <i class="fa fa-home mr-1"></i>
                            Trang Chủ
                        </a>
                    </li>

                    <li class="nav-item mx-2 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" data-toggle="dropdown">
                            <i class="fa fa-users mr-1"></i>Về An Phú
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{ isActive('about.anphu') }}" href="{{ route('about.anphu') }}"><i class="fa fa-users icon-highlight"></i> Giới thiệu</a>
                            <a class="dropdown-item {{ isActive('about.open_letter') }}" href="{{ route('about.about') }}"><i class="fa fa-users icon-highlight"></i> Thư ngỏ</a>
                            <a class="dropdown-item {{ isActive('about.cultural_values') }}" href="{{ route('about.cultural_values') }}"><i class="fa fa-users icon-highlight"></i> Giá trị văn hóa</a>
                        </div>
                    </li>

                    <li class="nav-item mx-2 dropdown">
                        <a class="nav-link dropdown-toggle" id="aboutDropdown" data-toggle="dropdown">
                            <i class="fa fa-cogs mr-1"></i></i> Dịch Vụ
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{ isActive('services.permit') }}" href="{{ route('services.permit') }}"><i class="fa fa-cog mr-1 icon-highlight"></i> Hồ sơ cấp phép xây dựng</a>
                            <a class="dropdown-item {{ isActive('services.design') }}" href="{{ route('services.design') }}"><i class="fa fa-cog mr-1 icon-highlight"></i> Thiết kế hồ sơ kĩ thuật, nội thất</a>
                            <a class="dropdown-item {{ isActive('services.construction_full') }}" href="{{ route('services.construction_full') }}"><i class="fa fa-cog mr-1 icon-highlight"></i> Xây nhà trọn gói</a>
                            <a class="dropdown-item {{ isActive('services.construction_raw') }}" href="{{ route('services.construction_raw') }}"><i class="fa fa-cog mr-1 icon-highlight"></i> Xây dựng phần thô</a>
                        </div>
                    </li>

                    <li class="nav-item mx-2 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" data-toggle="dropdown">
                            <i class="fa fa-cube mr-1 icon-highlight"></i> Dự án
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{ isActive('portfolio.villa') }}" href="{{ route('portfolio.villa') }}"><i class="fa fa-cube mr-1 icon-highlight"></i> Công trình Biệt thự</a>
                            <a class="dropdown-item {{ isActive('portfolio.town_house') }}" href="{{ route('portfolio.villa') }}"><i class="fa fa-cube mr-1 icon-highlight"></i> Công trình Nhà phố</a>
                            <a class="dropdown-item {{ isActive('portfolio.trading_house') }}" href="{{ route('portfolio.villa') }}"><i class="fa fa-cube mr-1 icon-highlight"></i> Công trình Nhà ở kết hợp kinh doanh</a>
                        </div>
                    </li>

                    <li class="nav-item mx-2 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" data-toggle="dropdown">
                            <i class="fa fa-dollar-sign mr-1"></i>Bảng Giá
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{ isActive('price.full') }}" href="{{ route('price.full') }}"><i class="fa fa-dollar-sign mr-1 icon-highlight"></i> Báo giá Xây nhà trọn gói</a>
                            <a class="dropdown-item {{ isActive('price.raw') }}" href="{{ route('price.raw') }}"><i class="fa fa-dollar-sign mr-1 icon-highlight"></i> Báo giá Xây thô</a>
                            <a class="dropdown-item {{ isActive('price.design') }}" href="{{ route('price.design') }}"><i class="fa fa-dollar-sign mr-1 icon-highlight"></i> Báo giá Thiết kế</a>
                            <a class="dropdown-item {{ isActive('price.permit') }}" href="{{ route('price.permit') }}"><i class="fa fa-dollar-sign mr-1 icon-highlight"></i> Báo giá Xin cấp phép xây dựng</a>
                        </div>
                    </li>

                    <li class="nav-item mx-2 {{ isActive('customers.about') }}">
                        <a class="nav-link" href="{{ route('customers.index') }}"><i class="fa fa-comments mr-1"></i>Tư vấn</a>
                    </li>

                    <li class="nav-item mx-2 {{ isActive('customers.about') }}">
                        <a class="nav-link" href="{{ route('customers.index') }}"><i class="fa fa-newspaper mr-1"></i>Hoạt động</a>
                    </li>

                    <li class="nav-item mx-2 {{ isActive('customers.about') }}">
                        <a class="nav-link" href="{{ route('customers.index') }}"><i class="fa fa-phone-alt mr-1"></i>Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>