<!-- Top bar -->
<div class="top-bar py-2">
    <div class="container">
        <div class="row align-items-center text-white justify-content-between">
            <!-- Logo -->
            <div class="col-md-3 col-12 mb-2 mb-md-0 text-center text-md-left border-divider">
                <a href="{{ route('auths.login') }}" class="logo-link d-inline-block">
                    <img class="anphu-logo img-fluid" src="{{ asset('assets/img/logo/banner.jpg') }}" alt="ANPHU Logo" style="max-height: 50px;">
                </a>
            </div>

            <!-- Contact Info -->
            <div class="col-md-3 col-6 mb-2 mb-md-0 text-md-left border-md-right border-divider">
                <div><i class="fa fa-phone-alt mr-1"></i> 0969.317.331</div>
                <div><i class="fa fa-envelope mr-1"></i> kientrucnoithat.anphu@gmail.com</div>
            </div>

            <!-- Address -->
            <div class="col-md-3 col-6 mb-2 mb-md-0 text-md-left border-md-right border-divider">
                <div><i class="fa fa-home mr-1"></i> Số 35, Ngõ Huyện, Hoàn Kiếm, Hà Nội</div>
            </div>

            <!-- Login / Register -->
            <div class="col-md-3 d-flex justify-content-md-end justify-content-center">
                <a href="{{ route('auths.login') }}" class="btn btn-sm btn-outline-light mr-2">Đăng nhập</a>
                <a href="{{ route('auths.register') }}" class="btn btn-sm btn-warning">Đăng ký</a>
            </div>
        </div>
    </div>
</div>