@props([
    'uploadRoute' => null,
    'uploadTable' => 'articles',
    'height' => '400px',
    'placeholder' => 'Nhập nội dung...',
    'content' => '',
    'readonly' => false
])

@php
    $elementId = 'quill-editor';
    $textareaName = 'content';
    
    $toolbar = [
        [['font' => []], ['size' => []]],
        ['bold', 'italic', 'underline', 'strike'],
        [['color' => []], ['background' => []]],
        [['script' => 'sub'], ['script' => 'super']],
        [['header' => 1], ['header' => 2], ['header' => [3, 4, 5, 6, false]]],
        [['list' => 'ordered'], ['list' => 'bullet'], ['indent' => '-1'], ['indent' => '+1']],
        ['direction', ['align' => []]],
        ['link', 'image', 'video'],
        ['clean']
    ];
@endphp

@push('styles')
    @once
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @endonce
    <style>
        #{{ $elementId }} img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px 0;
        }
    </style>
@endpush

<div id="{{ $elementId }}" class="quill-editor"></div>
<textarea
    name="{{ $textareaName }}"
    id="{{ $elementId }}-textarea"
    class="d-none"
>{{ old($textareaName, $content) }}</textarea>



@push('scripts')
    @once
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/quill-image-uploader@1.2.3/dist/quill.imageUploader.min.js"></script>
        <script src="{{ asset('js/quill-editor.js') }}"></script>
        <script>
            Quill.register("modules/imageUploader", window.ImageUploader);
        </script>
    @endonce

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const quillManager = new QuillEditorManager({
                selector: '#{{ $elementId }}',
                uploadUrl: @json($uploadRoute),
                uploadTable: @json($uploadTable),
                height: @json($height),
                placeholder: @json($placeholder),
                readonly: @json($readonly),
                toolbar: @json($toolbar)
            });

            // Load content sau khi Quill đã khởi tạo xong
            setTimeout(() => {
                const textarea = document.getElementById('{{ $elementId }}-textarea');
                const initialContent = textarea ? textarea.value.trim() : '';
                
                if (initialContent && quillManager.quill) {
                    quillManager.setContent(initialContent);
                }
            }, 200);

            window.quillManagers = window.quillManagers || {};
            window.quillManagers['{{ $elementId }}'] = quillManager;
        });
    </script>
@endpush