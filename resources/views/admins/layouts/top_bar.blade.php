<!-- Top bar -->
<div class="top-bar py-2 border-bottom">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-12 col-md-6 text-center text-md-left mb-2 mb-md-0">
                <a href="{{ route('admin.portfolios.index') }}" class="logo-link">
                    <img class="anphu-logo" src="{{ asset(config('company.assets.logo.main')) }}" alt="{{ config('company.name.brand') }} Logo">
                </a>
            </div>

            <!-- Company Info -->
            <div class="col-md-6 text-center text-md-right">
                <div class="company-info d-flex align-items-center justify-content-end">
                    <div class="company-details">
                        <h6 class="mb-0 text-white">Quản Trị Viên - {{ config('company.name.full') }}</h6>
                        <p class="mb-0 text-warning small">
                            <i class="fas fa-phone me-1"></i>{{ config('company.contact.phone') }} | 
                            <i class="fas fa-envelope me-1"></i>{{ config('company.contact.email') }}
                        </p>
                    </div>
                    <a href="{{ route('admin.auths.logout') }}" class="btn btn-danger px-4 ms-3">
                        <i class="fas fa-sign-out-alt me-1"></i>Đăng xuất
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
