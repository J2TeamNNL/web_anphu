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


</body>
</html>
