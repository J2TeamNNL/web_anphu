<!-- Top bar -->
<div class="top-bar py-2 border-bottom bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">

      <!-- Logo -->
      <div class="mb-2 mb-md-0 text-center text-md-left">
        <a href="{{ route('admin.portfolios.index') }}" class="logo-link d-inline-block">
          <img class="anphu-logo" 
               src="{{ asset(config('company.assets.logo.main')) }}" 
               alt="{{ config('company.name.brand') }} Logo"
               style="height: 50px;">
        </a>
      </div>

      <!-- Company Info -->
      <div class="text-center text-md-center mb-2 mb-md-0">
        <div class="company-details">
          <h6 class="mb-0">Quản Trị Viên - {{ config('company.name.full') }}</h6>
          <p class="mb-0 text-warning small">
            <i class="fas fa-phone me-1"></i>{{ config('company.contact.phone') }} |
            <i class="fas fa-envelope me-1"></i>{{ config('company.contact.email') }}
          </p>
        </div>
      </div>

      <!-- Logout Button -->
      <div class="text-center text-md-right">
        <a href="{{ route('admin.auths.logout') }}" class="btn btn-danger px-4">
          <i class="fas fa-sign-out-alt me-1"></i>Đăng xuất
        </a>
      </div>

    </div>
  </div>
</div>
