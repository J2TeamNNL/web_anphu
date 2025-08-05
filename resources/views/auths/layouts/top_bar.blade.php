<!-- Top bar -->
<div class="top-bar py-2">
    <div class="container">
        <div class="row align-items-center text-center text-md-left">
            <!-- Logo -->
            <div class="col-12 col-md-3 mb-3 mb-md-0">
                <a href="{{ route('auths.login')}}" class="logo-link d-inline-block">
                    <img class="anphu-logo" src="{{ asset(config('company.assets.logo.main')) }}" alt="{{ config('company.name.brand') }} Logo">
                </a>
            </div>

            <div class="col-12 col-md-3 mb-3 mb-md-0">
                <h6 class="mb-0 text-white">{{ config('company.name.full') }}</h6>
                <p class="mb-0 text-warning small">
                    <i class="fas fa-phone me-1"></i>{{ config('company.contact.phone') }} | 
                    <i class="fas fa-envelope me-1"></i>{{ config('company.contact.email') }}
                </p>
            </div>

            <!-- MXH -->
            <div class="col-12 col-md-2 text-center text-md-right">
                <div class="me-3">
                    <x-social-media 
                        size="medium" 
                        style="default" 
                        class="d-flex" 
                    />
                </div>
            </div>

            <div class="col-12 col-md-3 mb-3 mb-md-0">
                <a href="{{ route('auths.login') }}" class="btn btn-outline-warning btn-sm me-2">
                    <i class="fas fa-sign-in-alt me-1"></i>Đăng Nhập
                </a>
                <a href="{{ route('auths.register') }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-user-plus me-1"></i>Đăng Ký
                </a>
            </div>
        </div>
    </div>
</div>