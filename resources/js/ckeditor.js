import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

window.ClassicEditor = ClassicEditor;

console.log(' CKEditor loaded from npm');

// CKEditor upload adapter tùy biến
class MyUploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return this.loader.file.then(file => {
            return new Promise((resolve, reject) => {
                const data = new FormData();
                data.append('upload', file);
                data.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                fetch(window.ckeditorUploadUrl, {
                    method: 'POST',
                    body: data
                })
                    .then(response => response.json())
                    .then(result => {
                        if (result.uploaded && result.url) {
                            resolve({
                                default: result.url
                            });
                        } else {
                            reject(result.error?.message || 'Upload failed');
                        }
                    })
                    .catch(() => {
                        reject('Upload failed due to network error');
                    });
            });
        });
    }

    abort() {
        // Không cần xử lý cụ thể cho abort trong phiên bản này
    }
}

window.createCKEditor = async function (selector, uploadUrl = null, customConfig = {}) {
    const element = document.querySelector(selector);
    if (!element) {
        console.warn(`Không tìm thấy phần tử "${selector}"`);
        return;
    }

    window.ckeditorUploadUrl = uploadUrl;

    // ✅ Định nghĩa defaultConfig
    const defaultConfig = {
        mediaEmbed: { previewsInData: true },
        image: {
            toolbar: [
                'imageTextAlternative',
                'imageStyle:inline',
                'imageStyle:block',
                'imageStyle:side'
            ]
        },
        table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
        }
    };

    // ✅ Hợp nhất config
    const finalConfig = {
        ...defaultConfig,
        ...customConfig,
        licenseKey: 'GPL'
    };

    try {
        const editor = await ClassicEditor.create(element, finalConfig);
        if (uploadUrl) {
            editor.plugins.get('FileRepository').createUploadAdapter = loader => new MyUploadAdapter(loader);
        }
        return editor;
    } catch (error) {
        console.error(`Lỗi khi khởi tạo CKEditor tại "${selector}"`, error);
        throw error;
    }
};

