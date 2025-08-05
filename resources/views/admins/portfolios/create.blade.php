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

                {{-- Các trường input thông thường --}}
                <div class="form-group">
                    <label for="name">Tên Dự Án <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="location">Địa điểm</label>
                    <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}">
                </div>

                <div class="form-group">
                    <label for="client">Khách hàng</label>
                    <input type="text" name="client" id="client" class="form-control" value="{{ old('client') }}">
                </div>

                <div class="form-group">
                    <label for="image">Ảnh mô tả <span class="text-danger">*</span></label>
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>

                {{-- Component Quill --}}
                <div class="form-group">
                    <label for="content">Nội dung chi tiết</label>
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
                    <label for="year">Năm thực hiện</label>
                    <input type="number" name="year" id="year" class="form-control" value="{{ old('year') }}">
                </div>

                <input type="hidden" name="type" value="portfolio">

                {{-- Danh mục --}}
                <div class="form-group">
                    <label for="category_id">Danh mục công trình</label>
                    <select name="category_id" id="category_id" class="form-control select2">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $cat)
                            <optgroup label="{{ $cat->name }}">
                                @foreach ($cat->children as $child)
                                    <option value="{{ $child->id }}" {{ old('category_id') == $child->id ? 'selected' : '' }}>
                                        — {{ $child->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>

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

{{-- @include('admins.portfolios.partials.scripts_quill_image_upload') --}}