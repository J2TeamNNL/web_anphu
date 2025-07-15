<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Web Admin') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style_auth.css') }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    
    
</head>
<body>
    @include('auths.layouts.topBar')

    <div class="bg-auth">
        <div class="auth-card">
            <div class="auth-header">
                <h4 class="mb-0">
                    @if (request()->routeIs('auths.login'))
                        Đăng nhập CMS
                    @elseif (request()->routeIs('auths.register'))
                        Đăng ký tài khoản CMS
                    @else
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
                © {{ now()->year }} AnPhuBuilding
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
