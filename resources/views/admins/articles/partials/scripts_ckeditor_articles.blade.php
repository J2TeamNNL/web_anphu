@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#editor'), {
        ckfinder: {
            uploadUrl: '{{ route('admin.media.uploadImage') }}?table=articles&_token={{ csrf_token() }}'
        },
        mediaEmbed: {
            previewsInData: true
        }
    })
    .catch(error => {
        console.error(error);
    });
</script>
@endpush