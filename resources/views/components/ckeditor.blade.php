{{-- CKEditor Component --}}
{{-- Professional, reusable CKEditor integration with file upload support --}}
@props([
    'selector' => '#editor',
    'uploadRoute' => null,
    'uploadTable' => 'articles',
    'height' => '400px',
    'placeholder' => 'Nhập nội dung...',
    'toolbar' => 'default' // default, simple, full
])

@once
    @push('scripts')
    {{-- CKEditor npm version --}}
    @vite('resources/js/ckeditor.js')
    @endpush
@endonce

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // CKEditor initialization for {{ $selector }}
        initializeCKEditor({
            selector: '{{ $selector }}',
            uploadRoute: '{{ $uploadRoute ?? route('admin.media.uploadImage', ['table' => $uploadTable]) }}',
            config: {
                placeholder: '{{ $placeholder }}',
                @if($height)
                minHeight: '{{ $height }}',
                @endif
                @if($toolbar === 'simple')
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'link', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo'
                ],
                @elseif($toolbar === 'full')
                toolbar: {
                    items: [
                        'heading', '|',
                        'fontfamily', 'fontsize', '|',
                        'alignment', '|',
                        'fontColor', 'fontBackgroundColor', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
                        'link', '|',
                        'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'code', 'codeBlock', '|',
                        'insertTable', '|',
                        'uploadImage', 'blockQuote', '|',
                        'undo', 'redo'
                    ],
                    shouldNotGroupWhenFull: true
                },
                @endif
            }
        });
    });

    /**
     * Initialize CKEditor with custom configuration
     * @param {Object} options - Configuration options
     */
    function initializeCKEditor(options) {
        const { selector, uploadRoute, config } = options;
        
        if (typeof window.createCKEditor !== 'function') {
            console.error('CKEditor createCKEditor function not found. Make sure ckeditor.js is loaded.');
            return;
        }

        // Check if element exists
        const element = document.querySelector(selector);
        if (!element) {
            console.warn(`CKEditor target element "${selector}" not found.`);
            return;
        }

        // Initialize CKEditor
        window.createCKEditor(selector, uploadRoute, config)
            .then(editor => {
                console.log(`✅ CKEditor initialized successfully on "${selector}"`);
                
                // Optional: Add custom event listeners
                editor.model.document.on('change:data', () => {
                    // Auto-save or other functionality can be added here
                });
                
                // Store editor instance for potential later use
                window[`ckeditor_${selector.replace('#', '').replace('.', '_')}`] = editor;
            })
            .catch(error => {
                console.error(`❌ CKEditor initialization failed for "${selector}":`, error);
            });
    }
</script>
@endpush
