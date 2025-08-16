@extends('admins.layouts.master')
@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Thêm Dự Án</h4>
        <a href="{{ route('admin.portfolios.index') }}" class="btn btn-sm btn-primary">← Quản lý Dự án</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Tên Dự Án <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="location">Địa điểm</label>
                    <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}">
                </div>

                <div class="form-group">
                    <label for="location">Diện tích m2 (nếu có)</label>
                    <input type="text" name="area" id="area" class="form-control" value="{{ old('area') }}">
                </div>

                <div class="form-group">
                    <label for="location">Số tầng (nếu có)</label>
                    <input type="text" name="story" id="location" class="form-control" value="{{ old('story') }}">
                </div>

                <div class="form-group">
                    <label for="client">Khách hàng</label>
                    <input type="text" name="client" id="client" class="form-control" value="{{ old('client') }}">
                </div>

                <div class="form-group">
                    <label for="thumbnail">Ảnh mô tả <span class="text-danger">*</span></label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="description" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Mô tả</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="4" 
                        style="
                            width: 100%;
                            padding: 0.5rem;
                            border: 1px solid #ced4da;
                            border-radius: 0.25rem;
                            font-size: 1rem;
                            resize: vertical;
                        "
                    >{{ old('description') }}</textarea>
                </div>

                {{-- Component Quill --}}
                <div class="form-group">
                    <h5 for="content">Nội dung chi tiết</h5>
                    <p claas="text-muted">(Video hợp lệ để nhúng: Youtube, Facebook, Tiktok)</p>
                    <x-editor 
                        selector="#quill-editor"
                        uploadTable="portfolios"
                        toolbar="full"
                        height="500px"
                        placeholder="Nhập nội dung mô tả chi tiết..."
                        :uploadRoute="route('admin.media.uploadImage')"
                        :content="old('content', $portfolio->content ?? '')"
                        textareaName="content"
                    />
                </div>

                <div class="form-group">
                    <h5 for="year">Năm thực hiện</h5>
                    <input type="number" name="year" id="year" class="form-control" value="{{ old('year') }}">
                </div>

                <input type="hidden" name="type" value="portfolio">
                {{-- Danh mục --}}
                <x-category-select 
                    label="Danh mục công trình"
                    :categories="$categories"
                    :useOptgroup="true"
                    class="form-control select2"
                />
                <div class="text-right">
                    <button type="submit" class="btn btn-warning font-weight-bold">
                        <i class="fas fa-plus-circle mr-1"></i> Thêm Dự Án
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection