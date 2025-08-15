@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ isset($page) ? 'Cập nhật Trang' : 'Thêm Trang' }}</h4>
        <a href="{{ route('admin.custom_pages.index') }}" class="btn btn-sm btn-primary">← Quản lý Trang</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ isset($page) ? route('admin.custom_pages.update', $page) : route('admin.custom_pages.store') }}">
                @csrf
                @if(isset($page)) @method('PUT') @endif

                <div class="form-group">
                  <h5>Tên</h5>
                  <input type="text" name="name" class="form-control" value="{{ old('name', $page->name ?? '') }}" required>
               </div>

                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug ?? '') }}" required>
                </div>

                @for($i=1; $i<=4; $i++)
                    <hr>
                    <h5>Block {{ $i }}</h5>

                    <div class="form-group">
                        <label>Tiêu đề {{ $i }}</label>
                        <input type="text" name="title_{{ $i }}" class="form-control" value="{{ old("title_$i", $page["title_$i"] ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Ảnh {{ $i }} (tùy chọn)</label>
                        <input type="file" name="image_{{ $i }}" class="form-control-file">
                        @if(isset($page) && $page["image_$i"])
                            <img src="{{ $page["image_$i"] }}" class="img-thumbnail mt-2" width="150">
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Nội dung {{ $i }}</label>
                        <x-editor
                            selector="#quill-editor-{{ $i }}"
                            uploadTable="custom_pages"
                            toolbar="full"
                            height="500px"
                            placeholder="Nhập nội dung trong trang ..."
                            :uploadRoute="route('admin.media.uploadImage')"
                            :content="old('custom_content_'.$i, $page['custom_content_'.$i] ?? '')"
                            textareaName="custom_content_{{ $i }}"
                        />
                    </div>
                @endfor

                <div class="text-right">
                    <button type="submit" class="btn btn-success">{{ isset($page) ? 'Cập nhật' : 'Tạo mới' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
