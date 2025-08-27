/**
 * Quill Editor Module with Image Upload
 * Handles Quill editor initialization and image upload functionality
 * Auto Video Embedding
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

        // ✅ auto embed video link
        if (!this.options.readonly) {
            this.setupAutoEmbedHandler();
        }

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
     * Auto convert YouTube / Facebook / TikTok links to embed video
     * Also handle external images through proxy
     */
    setupAutoEmbedHandler() {
        // Handle text nodes for video embedding
        this.quill.clipboard.addMatcher(Node.TEXT_NODE, (node, delta) => {
            const urlRegex = /(https?:\/\/[^\s]+)/g;
            let ops = [];
            delta.ops.forEach(op => {
                if (typeof op.insert === 'string') {
                    let str = op.insert;
                    let match;
                    let lastIndex = 0;

                    while ((match = urlRegex.exec(str)) !== null) {
                        if (match.index > lastIndex) {
                            ops.push({ insert: str.slice(lastIndex, match.index) });
                        }

                        const embedUrl = this.convertToEmbedUrl(match[0]);
                        if (embedUrl) {
                            ops.push({ insert: { video: embedUrl } });
                        } else {
                            ops.push({ insert: match[0] });
                        }

                        lastIndex = urlRegex.lastIndex;
                    }

                    if (lastIndex < str.length) {
                        ops.push({ insert: str.slice(lastIndex) });
                    }
                } else {
                    ops.push(op);
                }
            });

            delta.ops = ops;
            return delta;
        });
    }

    /**
     * Detect and convert link to embed url
     */
    convertToEmbedUrl(url) {
        // YouTube
        const ytMatch = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\s&]+)/);
        if (ytMatch) {
            return `https://www.youtube.com/embed/${ytMatch[1]}`;
        }

        // Facebook
        const fbMatch = url.match(/facebook\.com\/.*\/videos\/(\d+)/);
        if (fbMatch) {
            return `https://www.facebook.com/plugins/video.php?href=${encodeURIComponent(url)}&show_text=0&width=560`;
        }

        // TikTok
        const tiktokMatch = url.match(/tiktok\.com\/@[A-Za-z0-9._]+\/video\/(\d+)/);
        if (tiktokMatch) {
            return `https://www.tiktok.com/embed/v2/${tiktokMatch[1]}`;
        }

        return null;
    }

    /**
     * Check if image URL is external (not from current domain)
     */
    isExternalImage(url) {
        try {
            const imageUrl = new URL(url);
            const currentHost = window.location.host;
            
            // Check if it's from a different domain
            return imageUrl.host !== currentHost && 
                   !url.startsWith('/') && 
                   !url.startsWith('./') &&
                   !url.startsWith('../');
        } catch (e) {
            return false;
        }
    }

    /**
     * Create placeholder image
     */
    createPlaceholder() {
        const svg = `
            <svg width="300" height="150" xmlns="http://www.w3.org/2000/svg">
                <rect width="300" height="150" fill="#f8f9fa" stroke="#dee2e6" stroke-width="2"/>
                <text x="150" y="75" text-anchor="middle" fill="#6c757d" font-family="Arial" font-size="14">
                    Đang tải hình ảnh...
                </text>
            </svg>
        `;
        // Use UTF-8 data URL to avoid btoa Latin1 limitations
        return 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(svg);
    }

    /**
     * Replace image in editor content
     */
    replaceImageInEditor(oldSrc, newSrc) {
        const delta = this.quill.getContents();
        let changed = false;

        delta.ops.forEach(op => {
            if (op.insert && op.insert.image === oldSrc) {
                op.insert.image = newSrc;
                changed = true;
            }
        });

        if (changed) {
            this.quill.setContents(delta);
        }
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

            // Upload file
            const imageUrl = await this.uploadToServer(file);
            
            // Replace loading with actual image

            // this.replaceLoadingWithImage(range.index, imageUrl);

            this.quill.insertEmbed(range.index, 'image', imageUrl);
            
            return imageUrl;

        } catch (error) {
            // console.error('Image upload failed:', error);
            // this.handleUploadError(error.message);
            // throw error;
            return null;
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
     * Server-side fallback: fetch remote image and return stable proxy URL
     */
    async fetchAndUploadToServer(imageUrl) {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) throw new Error('CSRF token not found');

            const response = await fetch('/admin/media/fetch-remote', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    url: imageUrl,
                    table: this.options.uploadTable || 'articles'
                })
            });

            if (!response.ok) {
                const errorData = await response.json().catch(() => ({}));
                throw new Error(errorData.message || `HTTP ${response.status}: ${response.statusText}`);
            }

            const result = await response.json();
            if (result.success && result.url) {
                return result.url;
            }
            throw new Error(result.message || 'Fetch remote failed');

        } catch (error) {
            console.warn('fetchAndUploadToServer error:', error);
            return null;
        }
    }

    /**
     * Handle upload errors
     */
    handleUploadError(message) {
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