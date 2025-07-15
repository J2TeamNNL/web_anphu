@php
    $homeRoutes = ['admins.index'];

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

    $selectedType = request()->route('type');
    // $currentType = request()->route('type');

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
<nav class="navbar navbar-expand-lg main-nav">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">

                <li class="nav-item mx-2 {{ isActive($homeRoutes) }}">
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

            </ul>
        </div>
    </div>
</nav>
