@props([
    'selector' => 'quill-editor',
    'uploadRoute' => null,
    'uploadTable' => 'articles',
    'height' => '400px',
    'placeholder' => 'Nhập nội dung...',
    'toolbar' => 'default',
    'content' => '',
    'readonly' => false,
    'textareaName' => 'content'
])

@php
    $elementId = ltrim($selector, '#');

    $toolbars = [
        'default' => [
            ['bold', 'italic', 'underline'],
            [['header' => 1], ['header' => 2]],
            [['list' => 'ordered'], ['list' => 'bullet']],
            ['image']
        ],
        'full' => [
            [['font' => []], ['size' => []]],
            ['bold', 'italic', 'underline', 'strike'],
            [['color' => []], ['background' => []]],
            [['script' => 'sub'], ['script' => 'super']],
            [['header' => 1], ['header' => 2], ['header' => [3, 4, 5, 6, false]]],
            [['list' => 'ordered'], ['list' => 'bullet'], ['indent' => '-1'], ['indent' => '+1']],
            ['direction', ['align' => []]],
            ['link', 'image', 'video'],
            ['clean']
        ]
    ];

    $toolbarOptions = $toolbars[$toolbar] ?? $toolbars['default'];
@endphp

@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        #{{ $elementId }} img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px 0;
        }
    </style>
@endpush

<div id="{{ $elementId }}" class="quill-editor">{!! $content !!}</div>
<textarea
    name="{{ $textareaName }}"
    id="{{ $elementId }}-textarea"
    class="d-none"
>
    {{ old($textareaName) }}
</textarea>


@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill-image-uploader@1.2.3/dist/quill.imageUploader.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const elementId = @json($elementId);
            const editorElem = document.getElementById(elementId);
            if (!editorElem) return;

            const isReadonly = @json($readonly);
            const placeholder = @json($placeholder);
            const toolbarOptions = @json($toolbarOptions);
            const uploadUrl = @json($uploadRoute . '?table=' . $uploadTable);

            // Đăng ký imageUploader module
            Quill.register("modules/imageUploader", window.ImageUploader);

            const quill = new Quill(editorElem, {
                theme: 'snow',
                placeholder: placeholder,
                readOnly: isReadonly,
                modules: {
                    toolbar: isReadonly ? false : toolbarOptions,
                    imageUploader: isReadonly ? undefined : {
                        upload: file => {
                            const formData = new FormData();
                            formData.append("image", file);

                            return fetch(uploadUrl, {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: formData
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.url) return data.url;
                                throw new Error("Upload failed");
                            });
                        }
                    }
                }
            });

            editorElem.style.height = @json($height);

            if (!isReadonly) {
                const textarea = document.getElementById(elementId + '-textarea');
                const form = editorElem.closest('form');

                const syncTextarea = () => {
                    if (textarea) {
                        textarea.value = quill.root.innerHTML;
                    }
                };

                if (form) {
                    form.addEventListener('submit', (e) => {
                        syncTextarea();
                    });
                }

                setInterval(syncTextarea, 60000);
            }
        });
    </script>
@endpush