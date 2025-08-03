<!-- Top bar -->
<div class="top-bar py-2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="company-info d-flex align-items-center">
                    <img src="{{ asset(config('company.assets.logo.main')) }}" alt="{{ config('company.name.brand') }} Logo" class="anphu-logo me-3">
                    <div class="company-details">
                        <h6 class="mb-0 text-white">{{ config('company.name.full') }}</h6>
                        <p class="mb-0 text-warning small">
                            <i class="fas fa-phone me-1"></i>{{ config('company.contact.phone') }} | 
                            <i class="fas fa-envelope me-1"></i>{{ config('company.contact.email') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 text-end">
                <div class="social-links d-flex align-items-center justify-content-end">
                    <div class="me-3">
                        <x-social-media 
                            size="medium" 
                            style="default" 
                            class="d-flex" 
                        />
                    </div>
                    <div class="auth-buttons">
                        <a href="{{ route('login') }}" class="btn btn-outline-warning btn-sm me-2">
                            <i class="fas fa-sign-in-alt me-1"></i>Đăng Nhập
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-user-plus me-1"></i>Đăng Ký
                        </a>
                    </div>
                </div>
            </div>

            <!-- Auth Button -->
            <div class="col-12 col-md-4 text-center text-md-right">
                <a href="{{ route('auths.login')}}" class="btn btn-primary px-4">
                    <i class="fas fa-sign-in-alt me-1"></i>Đăng nhập
                </a>
            </div>
        </div>
    </div>
</div>