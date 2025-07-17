<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Web Admin') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/style_auth.css') }}">
</head>
<body>
    @include('auths.layouts.topBar')

    <div class="bg-auth">
        <div class="auth-card">
            <div class="auth-header">
                <h4 class="mb-0">
                    @if (request()->routeIs('auths.login'))
                        Đăng nhập CMS
                        {{ $title ?? 'Đăng nhập quản lý' }}
                    @endif
                </h4>
            </div>

            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @yield('auths.login')
                @yield('auths.register')
            </div>

            <div class="auth-footer">
                ©{{ now()->year }} AnPhuBuilding
            </div>
        </div>
    </div>
</body>
</html>
