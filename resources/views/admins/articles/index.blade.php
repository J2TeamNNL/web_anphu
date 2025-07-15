@extends('admins.layouts.master')

@section('articles_index')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Xin chào {{ session('name')}}</h3>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">Danh sách Bài đăng</h4>
        <a href="{{ route('articles.create') }}" class="btn btn-success">+ Thêm bài đăng</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            {{-- Bộ lọc theo loại bài đăng --}}
            <form method="GET" class="form-inline mb-4">
                <label for="type" class="mr-2 font-weight-bold">Lọc theo thể loại bài đăng:</label>
                <select name="type" id="type" class="form-control mr-2">
                    <option value="">-- Tất cả --</option>
                    @foreach ($types as $key => $label)
                        <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-primary">Lọc</button>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Tên bài</th>
                            <th>Mô tả</th>
                            <th>Ảnh</th>
                            <th>Link</th>
                            <th>Thể loại Bài Đăng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->name }}</td>
                                <td class="text-left" style="max-width: 200px;">
                                    {{ \Illuminate\Support\Str::limit($article->description, 100) }}
                                </td>
                                <td>
                                    @if ($article->image)
                                        <img src="{{ asset("storage/{$article->image}") }}" alt="{{ $article->name }}" width="100" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">Không có</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ $article->link }}" target="_blank">{{ $article->link }}</a>
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $types[$article->type] ?? ucfirst($article->type) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-primary mb-1">Sửa</a>
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-muted">Chưa có bài đăng nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
