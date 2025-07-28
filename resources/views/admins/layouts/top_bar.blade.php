<!-- Top bar -->
<div class="top-bar py-2 border-bottom">
    <div class="container">
        <div class="row align-items-center text-center text-md-center">

            <div class="col-12 col-md-3 mb-3 mb-md-0 text-center text-md-left">
                <a href="{{ route('admin.portfolios.index') }}" class="logo-link d-inline-block">
                    <img class="anphu-logo img-fluid" src="{{ asset('assets/img/logo/banner.jpg') }}" alt="ANPHU Logo" style="max-height: 60px;">
                </a>
            </div>

            <div class="col-12 col-md-4 text-center text-md-center">
                <h5 class="text-uppercase text-warning font-weight-bold mb-0">Giao diện quản lý</h5>
            </div>

            <div class="col-12 col-md-2 text-center text-md-center">
                <a href="https://www.tiktok.com/@anphudesign" class="btn btn-sm btn-primary">
                    <img src="{{ asset('assets/img/logo/logo_tiktok.png') }}" style="height: 20px;" alt="Tiktok">
                </a>
                <a href="#" class="btn btn-sm btn-warning">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="btn btn-sm btn-danger">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#">
                    <img src="{{ asset('assets/img/logo/logo_zalo.png') }}" style="height: 20px;" alt="Zalo">
                </a>
            </div>

            <div class="col-12 col-md-3 text-center text-md-center">
                <a href="{{ route('admin.auths.logout') }}" class="btn btn-sm btn-primary">
                    Đăng xuất
                </a>
            </div>

        </div>
    </div>
</div>
