// CKEditor 5 Classic Build - npm version
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

// Make ClassicEditor globally available
window.ClassicEditor = ClassicEditor;

// Custom Upload Adapter for CKEditor
class MyUploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return this.loader.file
            .then(file => new Promise((resolve, reject) => {
                const data = new FormData();
                data.append('upload', file);
                data.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                fetch(window.ckeditorUploadUrl, {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(result => {
                    if (result.uploaded) {
                        resolve({
                            default: result.url
                        });
                    } else {
                        reject(result.error.message);
                    }
                })
                .catch(error => {
                    reject('Upload failed');
                });
            }));
    }

    abort() {
        // Reject the promise returned from the upload() method
    }
}

// Function to create CKEditor instance with custom configuration
window.createCKEditor = function(selector, uploadUrl, customConfig = {}) {
    window.ckeditorUploadUrl = uploadUrl;
    
    // Default configuration
    const defaultConfig = {
        mediaEmbed: {
            previewsInData: true
        },
        image: {
            toolbar: [
                'imageTextAlternative',
                'imageStyle:inline',
                'imageStyle:block',
                'imageStyle:side'
            ]
        },
        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells'
            ]
        }
    };
    
    // Merge custom config with default config
    const finalConfig = Object.assign({}, defaultConfig, customConfig);
    
    return ClassicEditor
        .create(document.querySelector(selector), finalConfig)
        .then(editor => {
            // Set up the custom upload adapter
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
            return editor;
        });
};

console.log('CKEditor loaded from npm');
