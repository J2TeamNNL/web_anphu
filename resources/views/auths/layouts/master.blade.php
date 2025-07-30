<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Web Admin') }}</title>

    <!-- Bootstrap 4 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    
    @vite([
        'resources/css/style_all.css',
    ])
    
    <style>
        /* --------------------------
        AUTH
        --------------------------- */
        .bg-auth {
            background-image: url("../img/gallery/form_background.webp");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: calc(100vh - 100px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            background-color: #f8f9fa;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            padding: 5px;
            width: 350px;
            max-width: 100%;
            border: solid 1px var(--color-dark);
        }

        .auth-card .card-body {
            padding: 0;
        }

        .auth-card .form-group {
            margin-bottom: 1rem;
        }

        .auth-card .form-control {
            width: 100%;
            font-size: 14px;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
        }

        .auth-card .btn-block {
            width: 100%;
            border-radius: 6px;
        }

        .auth-header {
            background-color: var(--color-primary);
            color: #fff;
            padding: 1rem 1.5rem;
            border-top-left-radius: .5rem;
            border-top-right-radius: .5rem;
            text-align: center;
        }

        .auth-footer {
            text-align: center;
            padding: 0.75rem;
            font-size: 0.9rem;
            color: #666;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    @include('auths.layouts.top_bar')

    <div class="bg-auth">
        <div class="auth-card">
            <!-- header -->
            <div class="auth-header text-center mb-3">
                <h4 class="mb-0">Đăng nhập quản lý</h4>
            </div>

            <!-- body -->
            <div class="card-body">
                <form method="POST" action="http://web_anphu.test/auth/login">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                </form>
            </div>

            <!-- footer -->
            <div class="auth-footer text-center mt-3">
                ©2025 AnPhuBuilding
            </div>
        </div>
    </div>
</body>

<!-- Bootstrap 4 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Isotope Layout -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
</html>
