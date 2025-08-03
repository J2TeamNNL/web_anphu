@extends('auths.layouts.master')

@section('content')
<form method="POST" action="{{ route('auths.process_register') }}">
    @csrf

    <div class="form-group">
        <label for="name">
            <i class="fas fa-user me-2"></i> Họ và tên
        </label>
        <input 
            type="text" 
            class="form-control" 
            name="name" 
            id="name"
            placeholder="Nhập họ và tên của bạn"
            value="{{ old('name') }}"
            required 
            autofocus
         >
    </div>

    <div class="form-group">
        <label for="email">
            <i class="fas fa-envelope me-2"></i> Địa chỉ email
        </label>
        <input 
            type="email" 
            class="form-control" 
            name="email" 
            id="email"
            placeholder="Nhập địa chỉ email của bạn"
            value="{{ old('email') }}"
            required
         >
    </div>

    <div class="form-group">
        <label for="password">
            <i class="fas fa-lock me-2"></i> Mật khẩu
        </label>
        <input 
            type="password" 
            class="form-control" 
            name="password" 
            id="password"
            placeholder="Nhập mật khẩu (tối thiểu 8 ký tự)"
            required
         >
    </div>

    <div class="form-group">
        <label for="password_confirmation">
            <i class="fas fa-lock me-2"></i> Xác nhận mật khẩu
        </label>
        <input 
            type="password" 
            class="form-control" 
            name="password_confirmation" 
            id="password_confirmation"
            placeholder="Nhập lại mật khẩu để xác nhận"
            required
         >
    </div>

    <button type="submit" class="btn-auth">
        <i class="fas fa-user-plus me-2"></i>
        Tạo tài khoản mới
    </button>
    
    <div class="text-center mt-3">
        <p class="mb-0">Đã có tài khoản? 
            <a href="{{ route('auths.login') }}" class="auth-link">Đăng nhập ngay</a>
        </p>
    </div>
</form>
@endsection
