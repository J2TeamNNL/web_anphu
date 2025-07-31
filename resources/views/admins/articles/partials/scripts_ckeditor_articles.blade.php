{{-- CKEditor for Articles --}}
<x-ckeditor 
    selector="#editor" 
    uploadTable="articles"
    toolbar="default"
    placeholder="Nhập nội dung bài viết..."
    height="400px" 
/>

@push('scripts')
    <script src="{{ asset('js/ckeditor.js') }}"></script>
@endpush