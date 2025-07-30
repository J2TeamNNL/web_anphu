{{-- CKEditor for Portfolios --}}
<x-ckeditor 
    selector="#editor" 
    uploadTable="portfolios"
    toolbar="full"
    placeholder="Nhập mô tả dự án..."
    height="500px" 
/>

@push('scripts')
    @vite(['resources/js/ckeditor.js'])
@endpush