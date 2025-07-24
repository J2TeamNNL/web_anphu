@extends('admins.layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Chỉnh sửa danh mục</h2>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="form-control" required>
        </div>

        {{-- Type --}}
        <div class="form-group">
            <label for="type">Loại danh mục</label>
            <select name="type" id="type" class="form-control" required>
                @foreach ($types as $type)
                    <option value="{{ $type->value }}"
                        {{ old('type', $category->type) === $type->value ? 'selected' : '' }}>
                        {{ $type->label() }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Parent category --}}
        <div class="form-group">
            <label for="parent_id">Danh mục cha (nếu có)</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="">Không có</option>
                @foreach($parentCategories as $parent)
                    @if($parent->id !== $category->id)
                        <option value="{{ $parent->id }}"
                            {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        {{-- Slug --}}
        <div class="form-group">
            <label for="slug">Slug (URL)</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" class="form-control">
            <span class="form-text text-muted">
                Slug chỉ chứa chữ thường không dấu, không khoảng trắng, dùng dấu gạch ngang (-) để ngăn cách. <br>
                Ví dụ: <code>villa</code>, <code>daily-news</code>, <code>service-1</code>
            </span>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
