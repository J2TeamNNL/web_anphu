/**
 * Quill Editor Module with Image Upload
 * Handles Quill editor initialization and image upload functionality
 */
class QuillEditorManager {
    constructor(options = {}) {
        this.options = {
            selector: '#quill-editor',
            uploadUrl: '/admin/media/upload-image',
            uploadTable: 'articles',
            height: '400px',
            placeholder: 'Nhập nội dung...',
            readonly: false,
            toolbar: 'default',
            ...options
        };
        
        this.quill = null;
        this.textarea = null;
        this.form = null;
        this.syncInterval = null;
        
        this.init();
    }

    /**
     * Initialize Quill editor
     */
    init() {
        const editorElem = document.querySelector(this.options.selector);
        if (!editorElem) {
            console.error(`Quill editor element not found: ${this.options.selector}`);
            return;
        }

        this.setupQuillEditor(editorElem);
        this.setupTextareaSync(editorElem);
        this.setupFormSubmission();
    }

    /**
     * Setup Quill editor with configuration
     */
    setupQuillEditor(editorElem) {
        const toolbarOptions = this.getToolbarOptions();
        
        this.quill = new Quill(editorElem, {
            theme: 'snow',
            placeholder: this.options.placeholder,
            readOnly: this.options.readonly,
            modules: {
                toolbar: this.options.readonly ? false : toolbarOptions,
                imageUploader: this.options.readonly ? undefined : {
                    upload: (file) => this.uploadImage(file)
                }
            }
        });

        // Set editor height
        editorElem.style.height = this.options.height;
        
        // Add error handling for editor
        this.quill.on('text-change', () => {
            this.syncTextarea();
        });
    }

    /**
     * Get toolbar configuration based on type
     */
    getToolbarOptions() {
        const toolbars = {
            default: [
                ['bold', 'italic', 'underline'],
                [{ 'header': 1 }, { 'header': 2 }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['image']
            ],
            full: [
                [{ 'font': [] }, { 'size': [] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'header': 1 }, { 'header': 2 }, { 'header': [3, 4, 5, 6, false] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                ['direction', { 'align': [] }],
                ['link', 'image', 'video'],
                ['clean']
            ]
        };

        return toolbars[this.options.toolbar] || toolbars.default;
    }

    /**
     * Setup textarea synchronization
     */
    setupTextareaSync(editorElem) {
        if (this.options.readonly) return;

        const textareaId = this.options.selector.replace('#', '') + '-textarea';
        this.textarea = document.getElementById(textareaId);
        this.form = editorElem.closest('form');

        if (this.textarea) {
            // Sync every minute
            this.syncInterval = setInterval(() => {
                this.syncTextarea();
            }, 60000);
        }
    }

    /**
     * Setup form submission handling
     */
    setupFormSubmission() {
        if (this.form && !this.options.readonly) {
            this.form.addEventListener('submit', (e) => {
                this.syncTextarea();
            });
        }
    }

    /**
     * Sync editor content to textarea
     */
    syncTextarea() {
        if (this.textarea && this.quill) {
            this.textarea.value = this.quill.root.innerHTML;
        }
    }

    /**
     * Upload image with proper error handling and loading states
     */
    async uploadImage(file) {
        try {
            // Validate file size (5MB limit)
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                throw new Error('Ảnh quá lớn. Vui lòng chọn ảnh nhỏ hơn 5MB.');
            }

            // Show loading state
            const range = this.quill.getSelection(true);
            this.insertLoadingImage(range.index);

            // Upload file
            const imageUrl = await this.uploadToServer(file);
            
            // Replace loading with actual image
            this.replaceLoadingWithImage(range.index, imageUrl);
            
            return imageUrl;

        } catch (error) {
            console.error('Image upload failed:', error);
            this.handleUploadError(error.message);
            throw error;
        }
    }

    /**
     * Insert loading placeholder
     */
    insertLoadingImage(index) {
        const loadingGif = '/images/loading.gif';
        this.quill.insertEmbed(index, 'image', loadingGif);
        this.loadingPosition = index;
    }

    /**
     * Replace loading image with uploaded image
     */
    replaceLoadingWithImage(index, imageUrl) {
        if (this.loadingPosition !== undefined) {
            this.quill.deleteText(this.loadingPosition, 1);
            this.quill.insertEmbed(this.loadingPosition, 'image', imageUrl);
            this.loadingPosition = undefined;
        }
    }

    /**
     * Upload file to server
     */
    async uploadToServer(file) {
        const formData = new FormData();
        formData.append('image', file);
        formData.append('table', this.options.uploadTable);

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            throw new Error('CSRF token not found');
        }

        const response = await fetch(this.options.uploadUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        });

        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(errorData.message || `HTTP ${response.status}: ${response.statusText}`);
        }

        const result = await response.json();
        
        if (!result.success || !result.url) {
            throw new Error(result.message || 'Upload failed - no URL returned');
        }

        return result.url;
    }

    /**
     * Handle upload errors
     */
    handleUploadError(message) {
        // Remove loading image if exists
        if (this.loadingPosition !== undefined) {
            this.quill.deleteText(this.loadingPosition, 1);
            this.loadingPosition = undefined;
        }

        // Show user-friendly error message
        this.showErrorMessage(message);
    }

    /**
     * Show error message to user
     */
    showErrorMessage(message) {
        // You can customize this based on your notification system
        if (typeof toastr !== 'undefined') {
            toastr.error(message);
        } else if (typeof Swal !== 'undefined') {
            Swal.fire('Lỗi', message, 'error');
        } else {
            alert(message);
        }
    }

    /**
     * Get editor content
     */
    getContent() {
        return this.quill ? this.quill.root.innerHTML : '';
    }

    /**
     * Set editor content
     */
    setContent(content) {
        if (this.quill) {
            this.quill.root.innerHTML = content;
        }
    }

    /**
     * Destroy editor and cleanup
     */
    destroy() {
        if (this.syncInterval) {
            clearInterval(this.syncInterval);
        }
        
        if (this.form) {
            this.form.removeEventListener('submit', this.syncTextarea);
        }
        
        this.quill = null;
        this.textarea = null;
        this.form = null;
    }
}

// Export for use in modules or global scope
if (typeof module !== 'undefined' && module.exports) {
    module.exports = QuillEditorManager;
} else {
    window.QuillEditorManager = QuillEditorManager;
}
