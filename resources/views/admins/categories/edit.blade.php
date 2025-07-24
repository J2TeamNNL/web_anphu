@extends('admins.layouts.master')

@section('content')
<div class="container">
    <h4 class="mb-4">Cập nhật danh mục</h4>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $category->slug) }}">
        </div>

        <div class="form-group">
            <label for="parent_id">Danh mục cha</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="">-- Không có --</option>
                @foreach($categories as $item)
                    <option value="{{ $item->id }}" {{ old('parent_id', $category->parent_id) == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="category_for">Category for</label>
            <input type="text" name="category_for" id="category_for" class="form-control" value="{{ old('category_for', $category->category_for) }}">
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
