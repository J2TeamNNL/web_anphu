@extends('admins.layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh mục {{ ucfirst($type) }}</h2>
    <a href="{{ route('categories.create', ['type' => $type]) }}" class="btn btn-success mb-3">Thêm danh mục mới</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Slug</th>
                <th>Danh mục cha</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ optional($category->parent)->name }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-primary">Sửa</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->appends(['type' => $type])->links() }}
</div>
@endsection
