# TinyMCE Self-Host Guide

## Tại sao Self-Host?

✅ **Không phụ thuộc CDN** - Hoạt động offline  
✅ **Tốc độ nhanh hơn** - Serve từ server riêng  
✅ **Không có giới hạn** - Không bị rate limit  
✅ **Bảo mật cao hơn** - Không gửi data ra ngoài  
✅ **Tùy chỉnh tự do** - Có thể modify source  

## Cách 1: Download và Host Local

### Bước 1: Download TinyMCE
```bash
# Vào thư mục public
cd d:\laragon\www\anphu\public

# Tạo thư mục tinymce
mkdir tinymce
cd tinymce

# Download TinyMCE Community (miễn phí)
# Vào https://www.tiny.cloud/get-tiny/self-hosted/
# Download file zip và giải nén vào thư mục này
```

### Bước 2: Cấu trúc thư mục
```
public/
├── tinymce/
│   ├── tinymce.min.js
│   ├── themes/
│   ├── plugins/
│   ├── skins/
│   └── langs/
└── js/
    └── tinymce-editor.js
```

### Bước 3: Cập nhật component
Sửa file `resources/views/components/editor.blade.php`:

```blade
@push('scripts')
    @once
        {{-- Thay CDN bằng local --}}
        <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('js/tinymce-editor.js') }}"></script>
    @endonce
```

## Cách 2: Sử dụng NPM/Composer

### Option A: NPM
```bash
cd d:\laragon\www\anphu
npm install tinymce
```

Sau đó copy files:
```bash
cp node_modules/tinymce/tinymce.min.js public/tinymce/
cp -r node_modules/tinymce/themes public/tinymce/
cp -r node_modules/tinymce/plugins public/tinymce/
cp -r node_modules/tinymce/skins public/tinymce/
```

### Option B: Composer
```bash
composer require tinymce/tinymce
```

## Cách 3: Webpack/Vite Integration

### Với Laravel Mix
File `webpack.mix.js`:
```javascript
const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .copy('node_modules/tinymce/tinymce.min.js', 'public/tinymce/')
   .copyDirectory('node_modules/tinymce/themes', 'public/tinymce/themes')
   .copyDirectory('node_modules/tinymce/plugins', 'public/tinymce/plugins')
   .copyDirectory('node_modules/tinymce/skins', 'public/tinymce/skins');
```

### Với Vite
File `vite.config.js`:
```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            external: ['tinymce/tinymce'],
        }
    }
});
```

## Cấu hình TinyMCE cho Self-Host

Cập nhật `tinymce-editor.js`:

```javascript
async setupTinyMCEEditor() {
    const config = {
        // Chỉ định base URL cho self-host
        base_url: '/tinymce',
        suffix: '.min',
        
        // Cấu hình skin và theme
        skin_url: '/tinymce/skins/ui/oxide',
        theme_url: '/tinymce/themes/silver/theme.min.js',
        
        // Plugins path
        plugins_url: '/tinymce/plugins',
        
        // Language (nếu có)
        language_url: '/tinymce/langs/vi.js',
        
        // Các config khác giữ nguyên...
        selector: this.options.selector,
        height: this.options.height,
        // ...
    };
    
    await tinymce.init(config);
}
```

## Download Links

### TinyMCE Community (Miễn phí)
- **Official**: https://www.tiny.cloud/get-tiny/self-hosted/
- **GitHub**: https://github.com/tinymce/tinymce
- **CDN Files**: https://cdnjs.com/libraries/tinymce

### Cấu trúc Download
```
tinymce-6.x.x/
├── tinymce.min.js          # Core file
├── themes/
│   └── silver/             # Default theme
├── plugins/
│   ├── lists/              # Lists plugin
│   ├── link/               # Link plugin
│   ├── image/              # Image plugin
│   ├── table/              # Table plugin
│   └── ...                 # Other plugins
├── skins/
│   └── ui/
│       └── oxide/          # Default skin
└── langs/
    ├── vi.js               # Vietnamese
    └── ...                 # Other languages
```

## Script Download Tự Động

Tạo file `download-tinymce.php`:

```php
<?php
$version = '6.7.2';
$baseUrl = "https://cdnjs.cloudflare.com/ajax/libs/tinymce/{$version}";
$publicPath = public_path('tinymce');

// Tạo thư mục
if (!is_dir($publicPath)) {
    mkdir($publicPath, 0755, true);
}

// Download core file
$coreFile = file_get_contents("{$baseUrl}/tinymce.min.js");
file_put_contents("{$publicPath}/tinymce.min.js", $coreFile);

// Download themes, plugins, skins...
// (Code download chi tiết)

echo "TinyMCE downloaded successfully!";
?>
```

Chạy: `php download-tinymce.php`

## Kiểm tra Self-Host

### 1. Kiểm tra files
```bash
ls -la public/tinymce/
# Phải có: tinymce.min.js, themes/, plugins/, skins/
```

### 2. Test trong browser
```javascript
// Mở Console và check
console.log(tinymce.version); // Phải hiển thị version
```

### 3. Network tab
- Không có request tới `cdn.tiny.cloud`
- Tất cả files load từ domain riêng

## Troubleshooting

### Lỗi "Failed to load theme"
```javascript
// Thêm vào config
theme_url: '/tinymce/themes/silver/theme.min.js'
```

### Lỗi "Plugin not found"
```javascript
// Chỉ định plugins path
plugins_url: '/tinymce/plugins'
```

### Lỗi 404 cho skin files
```javascript
// Chỉ định skin URL
skin_url: '/tinymce/skins/ui/oxide'
```

### Performance Issues
- **Gzip**: Bật compression cho .js files
- **Cache**: Set cache headers cho static files
- **CDN**: Sử dụng CDN riêng nếu có

## Nginx Config (Optional)

```nginx
# Gzip compression
location ~* \.(js|css)$ {
    gzip on;
    gzip_types text/javascript application/javascript;
    expires 1y;
    add_header Cache-Control "public, immutable";
}

# TinyMCE files
location /tinymce/ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}
```

## Apache Config (Optional)

```apache
# .htaccess in public/tinymce/
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType application/javascript "access plus 1 year"
</IfModule>

<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE application/javascript
</IfModule>
```

## Kết luận

Self-host TinyMCE giúp:
- ✅ Tăng tốc độ load
- ✅ Giảm phụ thuộc external
- ✅ Tăng bảo mật
- ✅ Hoạt động offline
- ✅ Tùy chỉnh tự do

**Khuyến nghị**: Sử dụng **Cách 1** (Download manual) cho đơn giản nhất.
