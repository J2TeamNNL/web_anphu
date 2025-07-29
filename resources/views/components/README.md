# Modular JavaScript Components Usage Guide

Mỗi component tự động include CDN CSS/JS của riêng mình. Bạn chỉ cần include component khi cần sử dụng.

## Available Components

### 1. AOS (Animate On Scroll)
```blade
<x-aos-init :duration="1000" :once="true" :offset="120" :delay="0" />
```
**Tự động include**: AOS CSS + AOS JS

### 2. Select2
```blade
<x-select2-init 
    selector=".my-select" 
    placeholder="Chọn tùy chọn..." 
    :multiple="true" 
    :allowClear="true" 
    width="100%" 
/>
```
**Tự động include**: jQuery + Select2 CSS + Select2 JS

### 3. Bootstrap Components
```blade
<x-bootstrap-init :tooltips="true" :popovers="true" :dropdowns="true" />
```
**Tự động include**: jQuery + Bootstrap CSS + Bootstrap JS

### 4. Isotope Layout
```blade
<x-isotope-init 
    selector=".portfolio-grid" 
    itemSelector=".portfolio-item" 
    layoutMode="masonry" 
    :enableFilters="true" 
/>
```
**Tự động include**: Isotope JS

### 5. FontAwesome
```blade
<x-fontawesome-init version="6.0.0" />
```
**Tự động include**: FontAwesome CSS

### 6. Smooth Scroll
```blade
<x-smooth-scroll :duration="800" :enableDropdownSubmenu="true" />
```
**Tự động include**: jQuery + Smooth scroll functionality

## Lợi ích của Modular Approach

✅ **Tự động quản lý dependencies**: Mỗi component tự include CDN cần thiết
✅ **Tránh duplicate**: Sử dụng `@once` để tránh load CDN nhiều lần
✅ **Linh hoạt**: Chỉ load những gì cần thiết
✅ **Dễ bảo trì**: Mỗi component độc lập
✅ **Clean master layout**: Không cần include hết CDN trong master

## Cách sử dụng

### Trong master layout (chỉ cần @stack)
```blade
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AnPhuBuild</title>
    
    @stack('styles')  {{-- Components sẽ push CSS vào đây --}}
</head>
<body>
    @yield('content')
    
    @stack('scripts') {{-- Components sẽ push JS vào đây --}}
</body>
</html>
```

### Trong các page cụ thể
```blade
@extends('layouts.master')

@section('content')
    <div class="portfolio-grid isotope">
        <div class="portfolio-item isotope-item">...</div>
    </div>
    
    <select class="form-control select2">
        <option>Option 1</option>
    </select>
@endsection

{{-- Chỉ include components cần thiết --}}
<x-isotope-init selector=".portfolio-grid" layoutMode="masonry" />
<x-select2-init />
<x-aos-init />
```

## Migration từ master layout cũ

**Trước** (trong master.blade.php):
```blade
<!-- Phải include tất cả CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<!-- ... nhiều CDN khác -->
```

**Sau** (trong master.blade.php):
```blade
{{-- Chỉ cần stack --}}
@stack('styles')
@stack('scripts')
```

**Trong từng page**:
```blade
{{-- Chỉ include component cần thiết --}}
<x-aos-init />
<x-select2-init />
```
