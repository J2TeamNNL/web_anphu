/**
 * TinyMCE Editor Module with Image Upload
 * Handles TinyMCE editor initialization and image upload functionality
 * Auto Video Embedding
 */
class TinyMCEEditorManager {
    constructor(options = {}) {
        this.options = {
            selector: '#tinymce-editor',
            uploadUrl: '/admin/media/upload-image',
            uploadTable: 'articles',
            height: 400,
            placeholder: 'Nhập nội dung...',
            readonly: false,
            language: 'vi',
            ...options
        };
        
        this.editor = null;
        this.textarea = null;
        this.form = null;
        this.syncInterval = null;
        
        this.init();
    }

    /**
     * Initialize TinyMCE editor
     */
    async init() {
        const editorElem = document.querySelector(this.options.selector);
        if (!editorElem) {
            console.error(`TinyMCE editor element not found: ${this.options.selector}`);
            return;
        }

        await this.setupTinyMCEEditor();
        this.setupTextareaSync();
        this.setupFormSubmission();
    }

    /**
     * Setup TinyMCE editor with full configuration
     */
    async setupTinyMCEEditor() {
        const config = {
            // Self-hosted configuration
            base_url: '/tinymce',
            suffix: '.min',
            
            selector: this.options.selector,
            height: this.options.height,
            language: this.options.language,
            readonly: this.options.readonly,
            placeholder: this.options.placeholder,
            
            // Plugins - chỉ miễn phí
            plugins: [
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 
                'visualblocks', 'code', 'fullscreen', 'media', 'table', 'help', 'wordcount'
            ],

            // Toolbar - chỉ tính năng miễn phí
            toolbar: this.options.readonly ? false : [
                'undo redo | blocks | bold italic underline strikethrough',
                'forecolor backcolor | alignleft aligncenter alignright alignjustify',
                'numlist bullist outdent indent | link image media table',
                'charmap | visualblocks code fullscreen preview | searchreplace help'
            ].join(' | '),

            // Menu bar - đơn giản hóa
            menubar: this.options.readonly ? false : 'edit view insert format table help',

            // Block formats - đơn giản
            block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3',

            // Content style
            content_style: `
                body { 
                    font-family: Arial, sans-serif; 
                    font-size: 14px; 
                    line-height: 1.6;
                    margin: 10px;
                }
                img { 
                    max-width: 100%; 
                    height: auto; 
                    display: block;
                    margin: 10px auto;
                }
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                table td, table th {
                    border: 1px solid #ddd;
                    padding: 8px;
                }
                table th {
                    background-color: #f2f2f2;
                    font-weight: bold;
                }
                blockquote {
                    border-left: 4px solid #ccc;
                    margin: 1.5em 10px;
                    padding: 0.5em 10px;
                    background-color: #f9f9f9;
                }
                code {
                    background-color: #f4f4f4;
                    padding: 2px 4px;
                    border-radius: 3px;
                    font-family: monospace;
                }
                pre {
                    background-color: #f4f4f4;
                    padding: 10px;
                    border-radius: 5px;
                    overflow-x: auto;
                }
            `,

            // Image handling
            images_upload_handler: (blobInfo, progress) => this.uploadImage(blobInfo, progress),
            images_upload_url: this.options.uploadUrl,
            images_upload_base_path: '',
            images_reuse_filename: true,
            automatic_uploads: true,
            
            // Tắt image tools (premium feature)
            // imagetools_cors_hosts: ['picsum.photos'],
            // imagetools_proxy: '/admin/media/imageproxy',

            // Media embed
            media_live_embeds: true,
            media_url_resolver: (data, resolve) => {
                const embedUrl = this.convertToEmbedUrl(data.url);
                if (embedUrl) {
                    resolve({
                        html: `<iframe src="${embedUrl}" width="560" height="315" frameborder="0" allowfullscreen></iframe>`
                    });
                } else {
                    resolve({html: ''});
                }
            },

            // Table options
            table_responsive_width: true,
            table_default_attributes: {
                border: '1'
            },
            table_default_styles: {
                'border-collapse': 'collapse',
                'width': '100%'
            },

            // Advanced options
            branding: false,
            promotion: false,
            resize: 'both',
            statusbar: true,
            elementpath: true,
            
            // Tắt auto-save (premium feature)
            // autosave_ask_before_unload: true,
            // autosave_interval: '30s',
            // autosave_prefix: 'tinymce-autosave-{path}{query}-{id}-',
            // autosave_restore_when_empty: false,
            // autosave_retention: '2m',

            // Paste options
            paste_data_images: true,
            paste_as_text: false,
            paste_webkit_styles: 'color font-size font-family background-color',
            paste_retain_style_properties: 'color font-size font-family background-color',

            // Link options
            link_assume_external_targets: true,
            link_context_toolbar: true,
            default_link_target: '_blank',

            // Tắt templates (premium feature)
            // templates: [...],

            // Tắt text patterns (premium feature)  
            // textpattern_patterns: [...],

            // Setup callback
            setup: (editor) => {
                this.editor = editor;
                
                // Custom button for video embed
                editor.ui.registry.addButton('customvideo', {
                    text: 'Video',
                    tooltip: 'Chèn video YouTube/Facebook/TikTok',
                    onAction: () => {
                        this.insertVideoDialog();
                    }
                });

                // Event handlers
                editor.on('change', () => {
                    this.syncTextarea();
                });

                editor.on('init', () => {
                    console.log('TinyMCE Editor initialized');
                });

                editor.on('paste', (e) => {
                    // Handle paste events if needed
                    setTimeout(() => this.processAutoEmbed(), 100);
                });
            }
        };

        try {
            await tinymce.init(config);
            console.log('TinyMCE initialized successfully');
        } catch (error) {
            console.error('TinyMCE initialization failed:', error);
        }
    }

    /**
     * Insert video dialog
     */
    insertVideoDialog() {
        if (!this.editor) return;

        this.editor.windowManager.open({
            title: 'Chèn Video',
            body: {
                type: 'panel',
                items: [
                    {
                        type: 'input',
                        name: 'videourl',
                        label: 'URL Video (YouTube, Facebook, TikTok)',
                        placeholder: 'https://www.youtube.com/watch?v=...'
                    }
                ]
            },
            buttons: [
                {
                    type: 'cancel',
                    text: 'Hủy'
                },
                {
                    type: 'submit',
                    text: 'Chèn',
                    primary: true
                }
            ],
            onSubmit: (api) => {
                const data = api.getData();
                const embedUrl = this.convertToEmbedUrl(data.videourl);
                
                if (embedUrl) {
                    this.editor.insertContent(
                        `<iframe src="${embedUrl}" width="560" height="315" frameborder="0" allowfullscreen></iframe>`
                    );
                } else {
                    this.editor.windowManager.alert('URL video không hợp lệ');
                }
                
                api.close();
            }
        });
    }

    /**
     * Process auto embed for pasted content
     */
    processAutoEmbed() {
        if (!this.editor) return;

        const content = this.editor.getContent();
        const urlRegex = /(https?:\/\/[^\s<>"]+)/g;
        let newContent = content;
        let hasChanges = false;

        newContent = newContent.replace(urlRegex, (url) => {
            const embedUrl = this.convertToEmbedUrl(url);
            if (embedUrl && !content.includes(`src="${embedUrl}"`)) {
                hasChanges = true;
                return `<iframe src="${embedUrl}" width="560" height="315" frameborder="0" allowfullscreen></iframe>`;
            }
            return url;
        });

        if (hasChanges) {
            this.editor.setContent(newContent);
        }
    }

    /**
     * Convert URL to embed URL
     */
    convertToEmbedUrl(url) {
        if (!url) return null;

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
     * Upload image handler
     */
    async uploadImage(blobInfo, progress) {
        try {
            const file = blobInfo.blob();
            
            // Validate file size (5MB limit)
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                throw new Error('Ảnh quá lớn. Vui lòng chọn ảnh nhỏ hơn 5MB.');
            }

            // Show progress
            progress(0);

            const imageUrl = await this.uploadToServer(file, progress);
            
            progress(100);
            return imageUrl;

        } catch (error) {
            console.error('Image upload failed:', error);
            this.handleUploadError(error.message);
            throw error;
        }
    }

    /**
     * Upload file to server
     */
    async uploadToServer(file, progress) {
        const formData = new FormData();
        formData.append('image', file);
        formData.append('table', this.options.uploadTable);

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            throw new Error('CSRF token not found');
        }

        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();

            // Track upload progress
            xhr.upload.addEventListener('progress', (e) => {
                if (e.lengthComputable && progress) {
                    const percentComplete = (e.loaded / e.total) * 100;
                    progress(percentComplete);
                }
            });

            xhr.addEventListener('load', () => {
                if (xhr.status === 200) {
                    try {
                        const result = JSON.parse(xhr.responseText);
                        if (result.success && result.url) {
                            resolve(result.url);
                        } else {
                            reject(new Error(result.message || 'Upload failed - no URL returned'));
                        }
                    } catch (e) {
                        reject(new Error('Invalid response format'));
                    }
                } else {
                    reject(new Error(`HTTP ${xhr.status}: ${xhr.statusText}`));
                }
            });

            xhr.addEventListener('error', () => {
                reject(new Error('Network error occurred'));
            });

            xhr.open('POST', this.options.uploadUrl);
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.send(formData);
        });
    }

    /**
     * Setup textarea synchronization
     */
    setupTextareaSync() {
        if (this.options.readonly) return;

        const textareaId = this.options.selector.replace('#', '') + '-textarea';
        this.textarea = document.getElementById(textareaId);
        
        const editorElem = document.querySelector(this.options.selector);
        this.form = editorElem?.closest('form');

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
        if (this.textarea && this.editor) {
            const content = this.editor.getContent();
            this.textarea.value = content;
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
        if (!this.editor) return '';
        return this.editor.getContent();
    }

    /**
     * Set editor content
     */
    setContent(content) {
        if (this.editor && content) {
            this.editor.setContent(content);
            setTimeout(() => {
                this.syncTextarea();
            }, 50);
        }
    }

    /**
     * Get plain text content
     */
    getTextContent() {
        if (!this.editor) return '';
        return this.editor.getContent({format: 'text'});
    }

    /**
     * Insert content at cursor
     */
    insertContent(content) {
        if (this.editor) {
            this.editor.insertContent(content);
        }
    }

    /**
     * Focus editor
     */
    focus() {
        if (this.editor) {
            this.editor.focus();
        }
    }

    /**
     * Check if editor has content
     */
    hasContent() {
        if (!this.editor) return false;
        const content = this.editor.getContent({format: 'text'}).trim();
        return content.length > 0;
    }

    /**
     * Destroy editor and cleanup
     */
    async destroy() {
        if (this.syncInterval) {
            clearInterval(this.syncInterval);
        }
        
        if (this.form) {
            this.form.removeEventListener('submit', this.syncTextarea);
        }
        
        if (this.editor) {
            await tinymce.remove(this.options.selector);
        }
        
        this.editor = null;
        this.textarea = null;
        this.form = null;
    }
}

// Export for use in modules or global scope
if (typeof module !== 'undefined' && module.exports) {
    module.exports = TinyMCEEditorManager;
} else {
    window.TinyMCEEditorManager = TinyMCEEditorManager;
}
