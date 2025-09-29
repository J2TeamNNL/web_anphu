@props([
    'uploadRoute' => null,
    'uploadTable' => 'articles',
    'height' => 400,
    'placeholder' => 'Nhập nội dung...',
    'content' => '',
    'readonly' => false,
    'language' => 'vi'
])

@php
    $elementId = 'tinymce-editor';
    $textareaName = 'content';
@endphp

@push('styles')
    @once
        <style>
            .tox-tinymce {
                border-radius: 4px;
            }
            .tox .tox-edit-area__iframe {
                background-color: #fff;
            }
            .tox-statusbar {
                border-top: 1px solid #ccc;
            }
        </style>
    @endonce
@endpush

<div id="{{ $elementId }}" class="tinymce-editor"></div>
<textarea
    name="{{ $textareaName }}"
    id="{{ $elementId }}-textarea"
    class="d-none"
>{{ old($textareaName, $content) }}</textarea>

@push('scripts')
    @once
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="{{ asset('js/tinymce-editor.js') }}"></script>
    @endonce

    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            const tinymceManager = new TinyMCEEditorManager({
                selector: '#{{ $elementId }}',
                uploadUrl: @json($uploadRoute),
                uploadTable: @json($uploadTable),
                height: @json($height),
                placeholder: @json($placeholder),
                readonly: @json($readonly),
                language: @json($language),
            });

            // Load content sau khi TinyMCE đã khởi tạo xong
            setTimeout(() => {
                const textarea = document.getElementById('{{ $elementId }}-textarea');
                const initialContent = textarea ? textarea.value.trim() : '';
                
                if (initialContent && tinymceManager.editor) {
                    tinymceManager.setContent(initialContent);
                }
            }, 500);

            window.tinymceManagers = window.tinymceManagers || {};
            window.tinymceManagers['{{ $elementId }}'] = tinymceManager;
        });
    </script>
@endpush
