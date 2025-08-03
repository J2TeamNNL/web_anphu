<!-- Top bar -->
<div class="top-bar py-2">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-12 col-md-3 text-center text-md-left mb-2 mb-md-0">
                <a href="{{ route('customers.index')}}" class="logo-link">
                    <img class="anphu-logo" src="{{ asset(config('company.assets.logo.main')) }}" alt="{{ config('company.name.brand') }} Logo">
                </a>
            </div>

            <!-- Company Contact -->
            <div class="col-12 col-md-6 text-center mb-2 mb-md-0">
                <div class="company-info">
                    <div class="info-item">
                        <i class="fas fa-phone me-1"></i>
                        <small>{{ config('company.contact.phone') }}</small>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope me-1"></i>
                        <small>{{ config('company.contact.email') }}</small>
                    </div>
                </div>
            </div>

            <!-- Social Links & Contact Button -->
            <div class="col-12 col-md-3 text-center text-md-right">
                <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                    <div class="me-3">
                        <x-social-media 
                            size="small" 
                            style="minimal" 
                            class="d-flex" 
                        />
                    </div>
                    <a href="#" class="btn btn-warning btn-sm">
                        <i class="fas fa-phone me-1"></i>Liên Hệ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>