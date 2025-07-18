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
    
    @include('customers.partials.top_bar')
    @include('customers.partials.nar_bar')


    @yield('index')

    @yield('about_anphu')
    @yield('about_open_letter')
    @yield('about_cultural_values')

    @yield('services_permit')
    @yield('services_design')
    @yield('services_construction_full')
    @yield('services_construction_raw')

    @yield('projects')
    @yield('blogs')

    @yield('price_full')
    @yield('price_raw')
    @yield('price_design')
    @yield('price_permit')

    @yield('consultant')
    @yield('blog')
    @yield('contact')
    

    @include('customers.partials.footer')
    @include('customers.scripts_customers')
</body>
</html>
