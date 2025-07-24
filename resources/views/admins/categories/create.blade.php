@extends('admins.layouts.master')

@section('content')
<div class="container">
    <h4 class="mb-4">Tạo danh mục mới</h4>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug (tùy chọn)</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">
        </div>

        <div class="form-group">
            <label for="parent_id">Danh mục cha</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="">-- Không có --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="category_for">Category for (mô tả ngắn)</label>
            <input type="text" name="category_for" id="category_for" class="form-control" value="{{ old('category_for') }}">
        </div>

        <button type="submit" class="btn btn-primary">Tạo danh mục</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection

