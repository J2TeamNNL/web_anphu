@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '{{ route('admin.media.uploadImage', ['table' => 'articles']) }}',
            },
            mediaEmbed: {
                previewsInData: true
            }
        })
        .then(editor => {
            // Gắn token CSRF vào headers của request CKFinder
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        });

    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    const data = new FormData();
                    data.append('upload', file);
                    data.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route('admin.media.uploadImage', ['table' => 'portfolios']) }}', {
                        method: 'POST',
                        body: data,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.uploaded) {
                            resolve({
                                default: result.url
                            });
                        } else {
                            reject(result.error?.message || 'Upload failed.');
                        }
                    })
                    .catch(error => {
                        reject(error.message || 'Upload failed.');
                    });
                }));
        }

        abort() {
            // Không cần xử lý gì đặc biệt ở đây
        }
    }
</script>
@endpush