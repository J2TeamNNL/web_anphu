@extends('auths.layouts.master')

@section('content')
<form method="POST" action="{{ route('auths.process_login') }}">
    @csrf
    
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
            autofocus
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
            placeholder="Nhập mật khẩu của bạn"
            required
         >
    </div>

    <button type="submit" class="btn-auth">
        <i class="fas fa-sign-in-alt me-2"></i>
        Đăng nhập vào hệ thống
    </button>
    
    <div class="text-center mt-3">
        <p class="mb-0">Chưa có tài khoản? 
            <a href="{{ route('auths.register') }}" class="auth-link">Đăng ký ngay</a>
        </p>
    </div>
</form>
@endsection
