@props([
    'selector' => 'quill-editor', // ID hoặc class (VD: 'editor_vi')
    'uploadRoute' => null,
    'uploadTable' => 'articles',
    'height' => '400px',
    'placeholder' => 'Nhập nội dung...',
    'toolbar' => 'default', // default | full
    'content' => '',
    'readonly' => false,
    'textareaName' => 'content'
])

@php
    $elementId = str($selector)->startsWith('#') ? substr($selector, 1) : $selector;

    $toolbarPresets = [
        'default' => [
            ['bold', 'italic', 'underline'],
            [ ['header' => 1], ['header' => 2] ],
            [ ['list' => 'ordered'], ['list' => 'bullet'] ],
            ['image']
        ],
        'full' => [
            [ ['font' => []], ['size' => []] ],
            ['bold', 'italic', 'underline', 'strike'],
            [ ['color' => []], ['background' => []] ],
            [ ['script' => 'sub'], ['script' => 'super'] ],
            [ ['header' => 1], ['header' => 2], ['header' => [3, 4, 5, 6, false]] ],
            [ ['list' => 'ordered'], ['list' => 'bullet'], ['indent' => '-1'], ['indent' => '+1'] ],
            ['direction', ['align' => []] ],
            ['link', 'image', 'video'],
            ['clean']
        ]
    ];
@endphp

@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

<div id="{{ $elementId }}" class="quill-editor">{!! $content !!}</div>

<textarea name="{{ $textareaName }}" class="d-none">{!! $content !!}</textarea>

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const editorElem = document.getElementById("{{ $elementId }}");
    if (!editorElem) return;

    const isReadonly = {{ $readonly ? 'true' : 'false' }};
    const toolbarOptions = {!! json_encode($toolbarPresets[$toolbar] ?? $toolbarPresets['default']) !!};

    const quill = new Quill("#{{ $elementId }}", {
        theme: 'snow',
        placeholder: "{{ $placeholder }}",
        readOnly: isReadonly,
        modules: {
            toolbar: isReadonly ? false : toolbarOptions
        }
    });

    editorElem.style.height = "{{ $height }}";

    if (!isReadonly) {
        const form = editorElem.closest('form');
        if (form) {
            form.addEventListener("submit", function () {
                const textarea = form.querySelector("textarea[name='{{ $textareaName }}']");
                if (textarea) textarea.value = quill.root.innerHTML;
            });

            setInterval(() => {
                const textarea = form.querySelector("textarea[name='{{ $textareaName }}']");
                if (textarea) textarea.value = quill.root.innerHTML;
            }, 60000);
        }

        const toolbar = quill.getModule('toolbar');
        if (toolbar) {
            toolbar.addHandler('image', function () {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.click();

                input.onchange = async function () {
                    const file = input.files[0];
                    if (!file) return;

                    const formData = new FormData();
                    formData.append('upload', file);

                    const uploadUrl = `{{ $uploadRoute }}?table={{ $uploadTable }}`;

                    try {
                        const response = await fetch(uploadUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: formData
                        });

                        const data = await response.json();
                        if (data.uploaded && data.url) {
                            const range = quill.getSelection();
                            quill.insertEmbed(range.index, 'image', data.url);
                        } else {
                            alert('Upload failed.');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Error uploading image.');
                    }
                };
            });
        }
    }
});
</script>
@endpush