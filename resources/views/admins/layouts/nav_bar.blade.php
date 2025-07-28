<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg main-nav">
    <div class="container">
        <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">

                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('admin.portfolios.index') }}">
                        <i class="fa fa-home mr-1"></i>Trang Chủ
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('admin.portfolios.index') }}" id="" data-toggle="">
                        <i class="fa fa-cogs mr-1"></i> Dự án
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('admin.articles.index') }}" id="" data-toggle="">
                        <i class="fa fa-cogs mr-1"></i> Bài đăng
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('admin.consulting_requests.index') }}" id="" data-toggle="">
                        <i class="fa fa-cogs mr-1"></i> Lịch tư vấn
                    </a>
                </li>
                
                @if(session()->get('level') == 1)
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('admin.users.index') }}" id="" data-toggle="">
                            <i class="fa fa-cogs mr-1"></i> Người quản lý
                        </a>
                    </li>
                @endif

                <li class="nav-item mx-2 mx-lg-3 my-1 my-lg-0 dropdown small">
                    <a class="nav-link dropdown-toggle text-center" href="#"
                    id="aboutDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cogs mr-1"></i> Cài đặt
                    </a>
                    <div class="dropdown-menu" aria-labelledby="aboutDropdown">
                        <a class="dropdown-item small" href="#">
                            <i class="fa fa-cog mr-1 icon-highlight"></i>
                            Cài đặt thông tin công ty
                        </a>
                        <a class="dropdown-item small" href="#">
                            <i class="fa fa-cog mr-1 icon-highlight"></i>
                            Cài đặt chính sách công ty
                        </a>
                        <a class="dropdown-item small" href="#">
                            <i class="fa fa-cog mr-1 icon-highlight"></i>
                            Cài đặt giá
                        </a>
                        <a class="dropdown-item small" href="{{ route('admin.categories.index') }}">
                            <i class="fa fa-cog mr-1 icon-highlight"></i>
                            Cài đặt danh mục
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
