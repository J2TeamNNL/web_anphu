@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#editor'), {
        ckfinder: {
            uploadUrl: '{{ route('admin.media.uploadImage') }}?type=portfolios&_token={{ csrf_token() }}'
        },
        mediaEmbed: {
            previewsInData: true
        }
    })
</script>
@endpush