@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Cập nhật Dự án</h4>
        <a href="{{ route('portfolios.index') }}" class="btn btn-sm btn-primary">← Quản lý dự án</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Tên dự án</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $portfolio->name }}" required>
                </div>

                <div class="form-group">
                    <label for="location">Địa điểm</label>
                    <input type="text" name="location" id="location" class="form-control" value="{{ $portfolio->location }}">
                </div>

                <div class="form-group">
                    <label for="client">Khách hàng</label>
                    <input type="text" name="client" id="client" class="form-control" value="{{ $portfolio->client }}">
                </div>

                <div class="form-group">
                    <label>Ảnh đại diện hiện tại</label><br>
                    @if ($portfolio->image)
                        <img src="{{ asset('storage/' . $portfolio->image) }}" width="200" class="img-thumbnail mb-2">
                    @else
                        <p class="text-muted">Không có ảnh</p>
                    @endif
                    <input type="hidden" name="image_old" value="{{ $portfolio->image }}">
                </div>

                <div class="form-group">
                    <label for="image_new">Thay ảnh chính (tùy chọn)</label>
                    <input type="file" name="image_new" id="image_new" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" rows="4" class="form-control">{{ $portfolio->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="year">Năm thực hiện</label>
                    <input type="number" name="year" id="year" class="form-control" value="{{ $portfolio->year }}">
                </div>

                <div class="form-group">
                    <label for="type">Loại hình công trình</label>
                    <select name="category_id" class="form-control select2">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $portfolio->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ str_repeat('— ', $cat->depth ?? 0) . $cat->name }}
                            </option>
                            @foreach ($cat->children as $child)
                                <option value="{{ $child->id }}"
                                    {{ old('category_id', $portfolio->category_id ?? '') == $child->id ? 'selected' : '' }}>
                                    {{ str_repeat('— ', ($child->depth ?? 1)) . $child->name }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-warning font-weight-bold">Cập nhật dự án</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection