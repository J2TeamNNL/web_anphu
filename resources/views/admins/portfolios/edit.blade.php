{{-- portfolios/edit.blade.php --}}
@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Cập nhật Dự án</h4>
        <a href="{{ route('admin.portfolios.index') }}" class="btn btn-sm btn-primary">← Quản lý dự án</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Tên dự án</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $portfolio->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="location">Địa điểm</label>
                    <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $portfolio->location) }}">
                </div>

                <div class="form-group">
                    <label for="location">Diện tích m2 (nếu có)</label>
                    <input type="text" name="area" id="area" class="form-control" value="{{ old('area', $portfolio->area) }}">
                </div>

                <div class="form-group">
                    <label for="location">Số tầng (nếu có)</label>
                    <input type="text" name="story" id="story" class="form-control" value="{{ old('story', $portfolio->story) }}">
                </div>

                <div class="form-group">
                    <label for="client">Khách hàng</label>
                    <input type="text" name="client" id="client" class="form-control" value="{{ old('client', $portfolio->client) }}">
                </div>

                <div class="form-group">
                    <label>Ảnh đại diện hiện tại</label><br>
                        @if ($portfolio->thumbnail)
                            <img src="{{ $portfolio->thumbnail }}" alt="{{ $portfolio->name }}" width="100" class="img-thumbnail">
                        @else
                            <p class="text-muted">Không có ảnh</p>
                        @endif
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thay ảnh đại diện (tùy chọn)</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="form-control"
                    >{{ old('description', $portfolio->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="year">Năm thực hiện</label>
                    <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $portfolio->year) }}">
                </div>

                <input type="hidden" name="type" value="portfolio">

                <x-category-select 
                    label="Loại hình công trình"
                    :categories="$categories"
                    :selected="$portfolio->category_id"
                    :useOptgroup="true"
                    class="form-control select2"
                />

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

                <div class="text-right">
                    <button type="submit" class="btn btn-warning font-weight-bold">Cập nhật dự án</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection