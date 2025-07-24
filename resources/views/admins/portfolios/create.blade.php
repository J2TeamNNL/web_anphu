@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Thêm Dự Án</h4>
        <a href="{{ route('portfolios.index') }}" class="btn btn-sm btn-primary">← Quản lý dự án</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Tên dự án</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="location">Địa điểm</label>
                    <input type="text" name="location" id="location" class="form-control">
                </div>

                <div class="form-group">
                    <label for="client">Khách hàng</label>
                    <input type="text" name="client" id="client" class="form-control">
                </div>

                <div class="form-group">
                    <label for="image">Ảnh mô tả</label>
                    <input type="file" name="image" id="image" class="form-control-file" required>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="year">Năm thực hiện</label>
                    <input type="number" name="year" id="year" class="form-control">
                </div>

                <div class="form-group">
                    <label for="category_id">Danh mục công trình</label>
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
                    <button type="submit" class="btn btn-warning font-weight-bold">Thêm dự án</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
