<!-- Top bar -->
<div class="top-bar py-2">
    <div class="container">
        <div class="row align-items-center text-white">
            <!-- Logo -->
            <div class="col-md-3 col-6 text-center text-md-left">
                <a href="{{ route('portfolios.index')}}" class="logo-link d-inline-block">
                    <img class="anphu-logo" src="{{ asset('assets/img/logo/banner.jpg') }}" alt="ANPHU Logo">
                </a>
            </div>

            <!-- Điện thoại & Email -->
            <div class="col-md-3 col-6 text-center text-md-left mb-2 mb-md-0 border-md-right border-divider">
                <div><i class="fa fa-phone-alt mr-1"></i> 0969.317.331</div>
                <div><i class="fa fa-envelope mr-1"></i> kientrucnoithat.anphu@gmail.com</div>
            </div>

            <!-- Địa chỉ -->
            <div class="col-md-3 text-center mb-2 mb-md-0 border-md-right border-divider">
                <div><i class="fa fa-home mr-1"></i> Địa chỉ: Số 35, Ngõ Huyện, Hoàn Kiếm, Hà Nội.</div>
            </div>

            <div class="col-md-2 text-center mb-2 mb-md-0 border-md-right border-divider">
                <a href="{{ route('auths.logout')}}" class="btn btn-sm btn-primary">
                    Đăng xuất
                </a>
            </div>
        </div>
    </div>
</div>