<!-- Top bar -->
<div class="top-bar py-2 border-bottom bg-dark text-white">
  <div class="container">
    <div class="row align-items-center text-center text-md-left">

      <!-- Logo -->
      <div class="col-12 col-md-4 mb-2 mb-md-0 d-flex justify-content-center justify-content-md-start">
        <a href="{{ route('admin.portfolios.index') }}" class="logo-link d-inline-block">
          <img class="anphu-logo" 
            src="{{ asset(config('company.assets.logo.main')) }}" 
            alt="{{ config('company.name.brand') }} Logo"
            height="40px"
          >
        </a>
      </div>

      <!-- Company Info -->
      <div class="col-12 col-md-4 mb-2 mb-md-0 text-center">
        <h6 class="mb-0">Quản Trị Viên - {{ config('company.name.full') }}</h6>
        <p class="mb-0 text-warning small">
          <i class="fas fa-phone me-1"></i>Zalo: {{ config('company.contact.phone_1') }} |
          <i class="fas fa-phone me-1"></i>Hotline: {{ config('company.contact.phone_2') }}<br>
          <i class="fas fa-envelope me-1"></i>{{ config('company.contact.email') }}
        </p>
      </div>

      <!-- Logout Button -->
      <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-end">
        <a href="{{ route('admin.auths.logout') }}" class="btn btn-danger px-4">
          <i class="fas fa-sign-out-alt me-1"></i>Đăng xuất
        </a>
      </div>

    </div>
  </div>
</div>