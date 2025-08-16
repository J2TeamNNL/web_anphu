@extends('admins.layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Thêm danh mục mới</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        {{-- Name --}}
        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
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
                    <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tạo mới</button>
    </form>
</div>
@endsection
