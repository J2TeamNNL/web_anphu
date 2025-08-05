<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloudinary Demo - Upload Images</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .upload-area {
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            margin: 20px 0;
            transition: border-color 0.3s ease;
        }
        .upload-area:hover {
            border-color: #007bff;
        }
        .upload-area.dragover {
            border-color: #007bff;
            background-color: #f8f9fa;
        }
        .image-preview {
            max-width: 200px;
            max-height: 200px;
            margin: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .file-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-4">
                    <i class="fas fa-cloud-upload-alt text-primary"></i>
                    Cloudinary Demo - Upload Images
                </h1>
                
                <!-- Upload Form -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5><i class="fas fa-upload"></i> Upload New Image</h5>
                    </div>
                    <div class="card-body">
                        <form id="uploadForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="upload-area" id="uploadArea">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                        <h5>Drag & Drop your image here</h5>
                                        <p class="text-muted">or click to select file</p>
                                        <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;">
                                        <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('imageInput').click()">
                                            <i class="fas fa-folder-open"></i> Choose File
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="folder" class="form-label">Folder (Optional)</label>
                                        <input type="text" class="form-control" id="folder" name="folder" placeholder="demo_uploads" value="demo_uploads">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100" id="uploadBtn">
                                        <i class="fas fa-upload"></i> Upload Image
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                        <!-- Upload Progress -->
                        <div id="uploadProgress" class="mt-3" style="display: none;">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>
                        
                        <!-- Upload Result -->
                        <div id="uploadResult" class="mt-3"></div>
                    </div>
                </div>
                
                <!-- Uploaded Images List -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5><i class="fas fa-images"></i> Uploaded Images</h5>
                        <button class="btn btn-outline-secondary btn-sm" onclick="loadImagesList()">
                            <i class="fas fa-refresh"></i> Refresh
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="imagesList">
                            <div class="text-center">
                                <i class="fas fa-spinner fa-spin fa-2x text-muted"></i>
                                <p class="mt-2 text-muted">Loading images...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // CSRF Token setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Upload area drag & drop functionality
        const uploadArea = document.getElementById('uploadArea');
        const imageInput = document.getElementById('imageInput');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            uploadArea.classList.add('dragover');
        }

        function unhighlight(e) {
            uploadArea.classList.remove('dragover');
        }

        uploadArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length > 0) {
                imageInput.files = files;
                showFilePreview(files[0]);
            }
        }

        // File input change event
        imageInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                showFilePreview(e.target.files[0]);
            }
        });

        // Show file preview
        function showFilePreview(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                uploadArea.innerHTML = `
                    <img src="${e.target.result}" class="image-preview" alt="Preview">
                    <div class="mt-2">
                        <strong>${file.name}</strong><br>
                        <small class="text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                    </div>
                    <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="resetUploadArea()">
                        <i class="fas fa-times"></i> Remove
                    </button>
                `;
            };
            reader.readAsDataURL(file);
        }

        // Reset upload area
        function resetUploadArea() {
            uploadArea.innerHTML = `
                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                <h5>Drag & Drop your image here</h5>
                <p class="text-muted">or click to select file</p>
                <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('imageInput').click()">
                    <i class="fas fa-folder-open"></i> Choose File
                </button>
            `;
            imageInput.value = '';
        }

        // Upload form submission
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const uploadBtn = $('#uploadBtn');
            const uploadProgress = $('#uploadProgress');
            const uploadResult = $('#uploadResult');
            
            if (!imageInput.files.length) {
                showAlert('Please select an image to upload.', 'warning');
                return;
            }
            
            uploadBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Uploading...');
            uploadProgress.show();
            uploadResult.empty();
            
            $.ajax({
                url: '{{ route("cloudinary-demo.store") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function() {
                    const xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            const percentComplete = (evt.loaded / evt.total) * 100;
                            $('.progress-bar').css('width', percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    if (response.success) {
                        showUploadResult(response.data);
                        resetUploadArea();
                        loadImagesList();
                        showAlert('Image uploaded successfully!', 'success');
                    } else {
                        showAlert(response.message, 'danger');
                    }
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    if (response && response.errors) {
                        let errorMsg = '';
                        Object.values(response.errors).forEach(errors => {
                            errors.forEach(error => errorMsg += error + '<br>');
                        });
                        showAlert(errorMsg, 'danger');
                    } else {
                        showAlert('Upload failed. Please try again.', 'danger');
                    }
                },
                complete: function() {
                    uploadBtn.prop('disabled', false).html('<i class="fas fa-upload"></i> Upload Image');
                    uploadProgress.hide();
                    $('.progress-bar').css('width', '0%');
                }
            });
        });

        // Show upload result
        function showUploadResult(data) {
            $('#uploadResult').html(`
                <div class="file-info">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="${data.url}" class="img-fluid rounded" alt="Uploaded image">
                        </div>
                        <div class="col-md-9">
                            <h6><i class="fas fa-check-circle text-success"></i> Upload Successful!</h6>
                            <p><strong>Path:</strong> ${data.path}</p>
                            <p><strong>URL:</strong> <a href="${data.url}" target="_blank">${data.url}</a></p>
                            <p><strong>Size:</strong> ${(data.size / 1024 / 1024).toFixed(2)} MB</p>
                            <p><strong>Type:</strong> ${data.mime_type}</p>
                        </div>
                    </div>
                </div>
            `);
        }

        // Load images list
        function loadImagesList() {
            $('#imagesList').html(`
                <div class="text-center">
                    <i class="fas fa-spinner fa-spin fa-2x text-muted"></i>
                    <p class="mt-2 text-muted">Loading images...</p>
                </div>
            `);
            
            $.get('{{ route("cloudinary-demo.list") }}')
                .done(function(response) {
                    if (response.success && response.files.length > 0) {
                        let html = '<div class="row">';
                        response.files.forEach(file => {
                            const thumbnailUrl = file.thumbnail || file.url;
                            html += `
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img src="${thumbnailUrl}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Image">
                                        <div class="card-body">
                                            <h6 class="card-title">${file.path.split('/').pop()}</h6>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    Size: ${(file.size / 1024 / 1024).toFixed(2)} MB<br>
                                                    Modified: ${new Date(file.last_modified * 1000).toLocaleDateString()}
                                                </small>
                                            </p>
                                            <div class="btn-group w-100">
                                                <a href="${file.url}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-external-link-alt"></i> View Full
                                                </a>
                                                <button class="btn btn-outline-info btn-sm" onclick="showTransformations('${file.path}')">
                                                    <i class="fas fa-magic"></i> Effects
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm" onclick="deleteImage('${file.path}')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                        html += '</div>';
                        $('#imagesList').html(html);
                    } else {
                        $('#imagesList').html(`
                            <div class="text-center text-muted">
                                <i class="fas fa-images fa-3x mb-3"></i>
                                <p>No images found. Upload some images to get started!</p>
                            </div>
                        `);
                    }
                })
                .fail(function() {
                    $('#imagesList').html(`
                        <div class="text-center text-danger">
                            <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                            <p>Failed to load images. Please try again.</p>
                        </div>
                    `);
                });
        }

        // Delete image
        function deleteImage(path) {
            if (confirm('Are you sure you want to delete this image?')) {
                $.ajax({
                    url: `{{ route("cloudinary-demo.destroy", "") }}/${encodeURIComponent(path)}`,
                    type: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            showAlert('Image deleted successfully!', 'success');
                            loadImagesList();
                        } else {
                            showAlert(response.message, 'danger');
                        }
                    },
                    error: function() {
                        showAlert('Failed to delete image. Please try again.', 'danger');
                    }
                });
            }
        }

        // Show alert
        function showAlert(message, type) {
            const alert = $(`
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `);
            
            $('#uploadResult').prepend(alert);
            
            setTimeout(() => {
                alert.alert('close');
            }, 5000);
        }

        // Load images on page load
        $(document).ready(function() {
            loadImagesList();
        });
    </script>
</body>
</html>
