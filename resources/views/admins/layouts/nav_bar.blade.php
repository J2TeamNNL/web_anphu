<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg main-nav">
    <div class="container">
        <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">

                {{-- Dự án --}}
                <li class="nav-item mx-2 {{ request()->routeIs('admin.portfolios.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.portfolios.index') }}">
                        <i class="fa fa-home mr-1"></i> Dự án
                    </a>
                </li>

                {{-- Bài đăng --}}
                <li class="nav-item mx-2 {{ request()->routeIs('admin.articles.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.articles.index') }}">
                        <i class="fa fa-newspaper me-1"></i> Bài đăng
                    </a>
                </li>

                {{-- Lịch tư vấn --}}
                <li class="nav-item mx-2 {{ request()->routeIs('admin.consulting_requests.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.consulting_requests.index') }}">
                        <i class="fa fa-calendar-check mr-1"></i> Lịch tư vấn
                    </a>
                </li>

                {{-- Người quản lý (chỉ hiển thị nếu là admin cấp cao) --}}
                @if(session()->get('level') == 1)
                    <li class="nav-item mx-2 {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            <i class="fa fa-users-cog mr-1"></i> Người quản lý
                        </a>
                    </li>
                @endif

                {{-- Dropdown: Cài đặt --}}
                <li
                    class="nav-item dropdown mx-2 mx-lg-3 my-1 my-lg-0 small
                    {{
                        request()->routeIs(
                            'admin.settings.*',
                            'admin.partners.index',
                            'admin.categories.index'
                        ) ? 'active' : '' 
                    }}"
                >
                    <a class="nav-link dropdown-toggle text-center" href="#" id="settingsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cogs mr-1"></i> Cài đặt
                    </a>
                    <div class="dropdown-menu" aria-labelledby="settingsDropdown">
                        <a
                            class="dropdown-item small {{ request()->routeIs('admin.settings.company.edit') ? 'active' : '' }}"
                            href="{{ route('admin.settings.company.edit') }}"
                        >
                            <i class="fa fa-cog mr-1 icon-highlight"></i> Cài đặt thông tin công ty
                        </a>
                        <a
                            class="dropdown-item small {{ request()->routeIs('admin.settings.company.editPolicy') ? 'active' : '' }}"
                            href="{{ route('admin.settings.company.editPolicy') }}"
                        >
                            <i class="fa fa-cog mr-1 icon-highlight"></i> Cài đặt chính sách công ty
                        </a>
                        <a
                            class="dropdown-item small" href="#"
                        >
                            <i class="fa fa-cog mr-1 icon-highlight"></i> Cài đặt giá
                        </a>
                        <a
                            class="dropdown-item small {{ request()->routeIs('admin.partners.index') ? 'active' : '' }}"
                            href="{{ route('admin.partners.index') }}"
                        >
                            <i class="fa fa-cog mr-1 icon-highlight"></i> Cài đặt đối tác công ty
                        </a>
                        <a
                            class="dropdown-item small {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}"

                            href="{{ route('admin.categories.index') }}"
                        >
                            <i class="fa fa-cog mr-1 icon-highlight"></i> Cài đặt danh mục
                        </a>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>
