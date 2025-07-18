<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg main-nav">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">

                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('portfolios.index') }}">
                        <i class="fa fa-home mr-1"></i>Trang Chủ
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('portfolios.index') }}" id="" data-toggle="">
                        <i class="fa fa-cogs mr-1"></i> Dự án
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('articles.index') }}" id="" data-toggle="">
                        <i class="fa fa-cogs mr-1"></i> Bài đăng
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('consulting_requests.index') }}" id="" data-toggle="">
                        <i class="fa fa-cogs mr-1"></i> Lịch tư vấn
                    </a>
                </li>
            
                @if(session()->get('level') == 1)
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('users.index') }}" id="" data-toggle="">
                            <i class="fa fa-cogs mr-1"></i> Người quản lý
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
