export default function ImageUploader(quill, options) {
    const toolbar = quill.getModule('toolbar');
    toolbar.addHandler('image', () => selectLocalImage());

    function selectLocalImage() {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();

        input.onchange = () => {
            const file = input.files[0];

            // ⚠️ Kiểm tra kích thước file (giới hạn 5MB)
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('Ảnh quá lớn. Vui lòng chọn ảnh nhỏ hơn 5MB.');
                return;
            }

            // ✅ Thêm loading spinner
            const range = quill.getSelection(true);
            quill.insertEmbed(range.index, 'image', '/images/loading.gif'); // cần tạo ảnh này trong public/images
            const loadingPosition = range.index;

            // Tải ảnh lên server
            uploadToServer(file)
                .then(imageUrl => {
                    // Xoá ảnh loading
                    quill.deleteText(loadingPosition, 1);
                    // Chèn ảnh thật
                    quill.insertEmbed(loadingPosition, 'image', imageUrl);
                })
                .catch(error => {
                    quill.deleteText(loadingPosition, 1);
                    alert('Upload ảnh thất bại. Vui lòng thử lại.');
                    console.error(error);
                });
        };
    }

    function uploadToServer(file) {
        return new Promise((resolve, reject) => {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('table', options.uploadTable);

            fetch(options.uploadUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(result => {
                if (result.success && result.url) {
                    resolve(result.url);
                } else {
                    reject(result.message || 'Unknown error');
                }
            })
            .catch(err => {
                reject(err);
            });
        });
    }
}