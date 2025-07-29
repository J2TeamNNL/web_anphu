# CKEditor Component Usage Guide

## Professional CKEditor Integration

Component `<x-ckeditor>` cung cấp CKEditor integration hoàn chỉnh với file upload support.

## Basic Usage

```blade
{{-- Simple usage --}}
<x-ckeditor />

{{-- With custom selector --}}
<x-ckeditor selector="#my-editor" />
```

## Advanced Configuration

```blade
<x-ckeditor 
    selector="#editor" 
    uploadTable="portfolios"
    toolbar="full"
    placeholder="Nhập mô tả dự án..."
    height="500px"
    :uploadRoute="route('admin.media.uploadImage', ['table' => 'portfolios'])"
/>
```

## Available Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `selector` | string | `#editor` | CSS selector cho textarea |
| `uploadRoute` | string | auto-generated | Route để upload hình ảnh |
| `uploadTable` | string | `articles` | Table name cho upload route |
| `height` | string | `400px` | Chiều cao của editor |
| `placeholder` | string | `Nhập nội dung...` | Placeholder text |
| `toolbar` | string | `default` | Toolbar preset: `simple`, `default`, `full` |

## Toolbar Presets

### Simple Toolbar
```blade
<x-ckeditor toolbar="simple" />
```
- Heading, Bold, Italic, Link
- Lists (bulleted, numbered)
- Indent/Outdent
- Undo/Redo

### Default Toolbar
```blade
<x-ckeditor toolbar="default" />
```
- Standard CKEditor toolbar

### Full Toolbar
```blade
<x-ckeditor toolbar="full" />
```
- Font family, size, color
- Alignment options
- Advanced formatting
- Tables, code blocks
- Image upload

## Usage Examples

### For Articles
```blade
<x-ckeditor 
    selector="#article-content" 
    uploadTable="articles"
    placeholder="Nhập nội dung bài viết..."
    height="400px" 
/>
```

### For Portfolios
```blade
<x-ckeditor 
    selector="#portfolio-description" 
    uploadTable="portfolios"
    toolbar="full"
    placeholder="Nhập mô tả dự án..."
    height="500px" 
/>
```

### For Comments/Reviews
```blade
<x-ckeditor 
    selector="#comment" 
    toolbar="simple"
    placeholder="Nhập bình luận..."
    height="200px" 
/>
```

## Features

✅ **Auto file upload** - Drag & drop images
✅ **CSRF protection** - Tự động handle CSRF token
✅ **Error handling** - Professional error logging
✅ **Multiple instances** - Có thể dùng nhiều editor trên 1 page
✅ **Configurable** - Flexible configuration options
✅ **Professional code** - Clean, maintainable code structure

## Migration from Old Files

**Before** (old approach):
```blade
@include('admins.articles.partials.scripts_ckeditor_articles')
```

**After** (new component):
```blade
<x-ckeditor uploadTable="articles" />
```

## Technical Details

- Uses npm CKEditor5 Classic Build
- Custom upload adapter for file handling
- Stores editor instances globally for access
- Automatic DOM ready initialization
- Professional error handling and logging
