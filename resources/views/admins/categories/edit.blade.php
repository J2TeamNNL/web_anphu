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
                        {{ old('type', $category->type->value ?? $category->type) == $type->value ? 'selected' : '' }}>
                        {{ $type->label() }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Parent category --}}
        <div class="form-group">
            <label for="parent_id">Danh mục cha (nếu có)</label>
            <select name="parent_id" id="parent_id" class="form-control font-weight-bold">
                <option class="font-weight-bold" value="">Không có</option>
                @foreach($parentCategories as $parent)
                    <option class="font-weight-bold" value="{{ $parent->id }}"
                        {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection