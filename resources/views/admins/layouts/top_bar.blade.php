<!-- Top bar -->
<div class="top-bar py-2 border-bottom bg-dark text-white">
  <div class="container">
    <div class="row align-items-center text-center text-md-left">

      <!-- Logo -->
      <div class="col-12 col-md-6 mb-2 mb-md-0 d-flex justify-content-center justify-content-md-start">
        <a href="{{ route('admin.portfolios.index') }}" class="logo-link d-inline-block">
          <img class="anphu-logo" 
            src="{{ asset(config('company.assets.logo.main')) }}" 
            alt="{{ config('company.name.brand') }} Logo"
            height="40px"
          >
        </a>
      </div>

      <!-- Logout Button -->
      <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end">
        <a href="{{ route('admin.auths.logout') }}" class="btn btn-danger px-4">
          <i class="fas fa-sign-out-alt me-1"></i>Đăng xuất
        </a>
      </div>

    </div>
  </div>
</div>