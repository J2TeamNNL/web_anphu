<!-- Top bar -->
    <div class="top-bar py-2">
        <div class="container">
            <div class="row align-items-center text-center text-md-left">
                <!-- Logo -->
                <div class="col-12 col-md-3 mb-3 mb-md-0">
                    <a href="{{ route('auths.login')}}" class="logo-link d-inline-block">
                        <img class="anphu-logo" src="{{ asset('assets/img/logo/banner.jpg') }}" alt="ANPHU Logo">
                    </a>
                </div>

                <!-- MXH -->
                <div class="col-12 col-md-2 text-center text-md-right">
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

                <div class="col-12 col-md-3 mb-3 mb-md-0">
                    <a href="{{ route('auths.register')}}" class="logo-link d-inline-block">
                        <button class="btn btn-success btn-block">Đăng ký</button>
                    </a>
                </div>
            </div>
        </div>
    </div>