<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnPhuDesign</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('assets/css/style_all.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>
    
    @include('admins.layouts.topBar')
    @include('admins.layouts.narBar')
    
    @yield('portfolios_index')
    @yield('portfolios_create')
    @yield('portfolios_edit')

    @yield('articles_index')
    @yield('articles_create')
    @yield('articles_edit')

    @yield('consulting_requests_index')

    @yield('users_index')
    @yield('users_create')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts_portfolios_edit_types_categories')
    @stack('scripts_portfolios_create_types_categories')
    @stack('scripts_consulting_requests_status')
    @stack('scripts_users_edit_show_password')
    

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
</body>
</html>
