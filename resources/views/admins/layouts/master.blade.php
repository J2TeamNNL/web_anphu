<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnPhuDesign</title>

    @vite(['resources/js/app.js', 'resources/css/app.css'])
    
    <link rel="stylesheet" href="{{ asset('assets/css/style_all.css') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    @stack('styles')
</head>
<body>
    @include('admins.layouts.top_bar')
    @include('admins.layouts.nav_bar')
    
    @yield('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- AOS JS: Animation for Fade in - Slide up - Zoom - Flip -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    
    @stack('scripts')
</body>
</html>
