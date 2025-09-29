# TinyMCE Migration Guide

## Đã hoàn thành

✅ **Tạo TinyMCE Editor Manager** (`public/js/tinymce-editor.js`)
- Chỉ tính năng miễn phí, không có premium features
- Upload ảnh với progress bar
- Auto-embed YouTube/Facebook/TikTok
- Tables cơ bản
- Search & Replace, Fullscreen mode

✅ **Cập nhật Component Editor** (`resources/views/components/editor.blade.php`)
- Thay thế Quill bằng TinyMCE
- Giữ nguyên API để không phá vỡ code hiện tại

## 🚀 **Tính năng TinyMCE (Miễn phí):**

- **Rich Text Editor** cơ bản: Bold, Italic, Lists, Tables, Headers (H1-H3)
- **Upload ảnh** với progress bar và validation
- **Auto-embed video** YouTube/Facebook/TikTok  
- **Tables** cơ bản
- **Search & Replace**
- **Fullscreen mode**
- **Responsive design**
- **Character map** (ký tự đặc biệt)
- **Visual blocks** (hiển thị HTML blocks)

### ❌ **Tính năng Premium (đã tắt):**
- Templates
- Auto-save
- Advanced image tools
- Text patterns (Markdown shortcuts)
- Advanced fonts và sizes

## Tính năng TinyMCE mới

{{ ... }}
- Toolbar đầy đủ với 4 dòng công cụ
- Menu bar với File, Edit, View, Insert, Format, Tools, Table, Help
- Status bar hiển thị thông tin
- Responsive và có thể resize

### 📝 **Định dạng văn bản**
- Font families: Arial, Times New Roman, Helvetica, Georgia, v.v.
- Font sizes: 8pt đến 48pt
- Colors: Text color và background color
- Styles: Bold, Italic, Underline, Strikethrough
- Headers: H1-H6
- Lists: Ordered và Unordered
- Alignment: Left, Center, Right, Justify
- Indentation

### 🖼️ **Media**
- **Upload ảnh**: Drag & drop hoặc click để chọn
- **Progress bar** khi upload
- **Auto-resize** ảnh về max-width: 100%
- **Video embed**: YouTube, Facebook, TikTok tự động
- **Image tools**: Crop, resize, rotate (cần cấu hình server)

### 📊 **Tables**
- Tạo bảng với header
- Merge/split cells
- Add/remove rows/columns
- Table styles

### ⚡ **Shortcuts**
- `**text**` → **Bold**
- `*text*` → *Italic*
- `#` → H1, `##` → H2, v.v.
- `1. ` → Ordered list
- `* ` hoặc `- ` → Unordered list

### 🔧 **Advanced**
- **Templates**: Bài viết cơ bản, bài viết có hình
- **Code blocks**: Syntax highlighting
- **Special characters**: Emoticons, symbols
- **Search & Replace**
- **Word count**
- **Fullscreen mode**
- **Auto-save** mỗi 30 giây

## Cách sử dụng

### 1. **Sử dụng component hiện tại** (Đã cập nhật)
```blade
<x-editor 
    :uploadRoute="route('admin.media.upload-image')"
    uploadTable="articles"
    :height="500"
    placeholder="Nhập nội dung bài viết..."
    :content="$article->content ?? ''"
    :readonly="false"
/>
```

### 2. **Sử dụng component TinyMCE riêng**
```blade
<x-tinymce-editor 
    :uploadRoute="route('admin.media.upload-image')"
    uploadTable="articles"
    :height="500"
    placeholder="Nhập nội dung bài viết..."
    :content="$article->content ?? ''"
    :readonly="false"
    language="vi"
/>
```

### 3. **Khởi tạo trực tiếp**
```javascript
const editor = new TinyMCEEditorManager({
    selector: '#my-editor',
    uploadUrl: '/admin/media/upload-image',
    uploadTable: 'articles',
    height: 400,
    placeholder: 'Nhập nội dung...',
    readonly: false,
    language: 'vi'
});

// Lấy nội dung
const content = editor.getContent();

// Set nội dung
editor.setContent('<p>Hello world</p>');

// Insert nội dung tại cursor
editor.insertContent('<img src="image.jpg" alt="Image">');

// Check có nội dung không
if (editor.hasContent()) {
    // Có nội dung
}
```

## API Methods

```javascript
// Content
editor.getContent()           // HTML content
editor.getTextContent()       // Plain text
editor.setContent(html)       // Set HTML content
editor.insertContent(html)    // Insert at cursor
editor.hasContent()           // Check if has content

// Control
editor.focus()               // Focus editor
editor.destroy()             // Cleanup và destroy
```

## Cấu hình Server

### Upload Image Route
Đảm bảo route upload trả về format:
```json
{
    "success": true,
    "url": "https://domain.com/path/to/image.jpg",
    "message": "Upload successful"
}
```

### CSRF Token
Đảm bảo có meta tag:
```html
<meta name="csrf-token" content="{{ csrf_token() }}">
```

## So sánh với Quill

| Tính năng | Quill | TinyMCE |
|-----------|-------|---------|
| Dung lượng | ~43KB | ~150KB |
| Tính năng | Cơ bản | Đầy đủ |
| Tables | Plugin | Built-in |
| Templates | Không | Có |
| Auto-save | Tự code | Built-in |
| Whitespace bugs | Có | Không |
| Mobile | Tốt | Rất tốt |
| Customization | Khó | Dễ |

## Lưu ý

1. **File cũ**: `quill-editor.js` vẫn giữ nguyên, chưa xóa
2. **Backward compatibility**: Component `<x-editor>` vẫn hoạt động
3. **CDN**: Sử dụng TinyMCE CDN miễn phí (có watermark nhỏ)
4. **License**: Để production, nên mua license hoặc self-host

## Troubleshooting

### Lỗi không load TinyMCE
- Check internet connection
- Thử thay CDN khác: `https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.2/tinymce.min.js`

### Upload ảnh không hoạt động
- Check CSRF token
- Check route upload
- Check file permissions

### Editor không hiển thị
- Check console errors
- Đảm bảo element ID unique
- Check TinyMCE script đã load

## Next Steps

1. Test trên tất cả trang sử dụng editor
2. Backup database trước khi deploy
3. Monitor performance sau khi thay đổi
4. Cân nhắc mua license TinyMCE cho production
