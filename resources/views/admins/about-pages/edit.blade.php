@extends('admins.layouts.master')

@section('content')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">Chỉnh sửa trang giới thiệu</h4>
        <a href="{{ route('admin.about-pages.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.about-pages.update', $aboutPage) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $aboutPage->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="font-weight-bold">Mô tả ngắn</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="3">{{ old('description', $aboutPage->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content" class="font-weight-bold">Nội dung</label>
                    <x-editor 
                        selector="#quill-editor"
                        uploadTable="about_pages"
                        toolbar="full"
                        height="400px"
                        placeholder="Nhập nội dung trang giới thiệu..."
                        :uploadRoute="route('admin.media.uploadImage')"
                        :content="old('content', $aboutPage->content)"
                        textareaName="content"
                    />
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập nhật trang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

