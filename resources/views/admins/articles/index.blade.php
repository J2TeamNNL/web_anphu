@extends('admins.layouts.master')

@section('articles_index')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Xin chào {{ session('name')}}</h5>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">Danh sách Bài đăng</h4>
        <a href="{{ route('articles.create') }}" class="btn btn-success">+ Thêm bài đăng</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form class="mb-3" method="GET">
                <div class="form-row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="q" value="{{ old('q', $search ?? '') }}" class="form-control" placeholder="Tìm theo Tên, Mô tả">
                    </div>

                    <div class="col-md-2 mb-2">
                        <select name="type" class="form-control">
                            <option value="">-- Thể loại --</option>
                            @foreach ($types as $key => $value)
                                <option value="{{ $key }}" {{ ($selectedType ?? '') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 mb-2">
                        <button class="btn btn-primary w-100" type="submit">
                            <i class="fa fa-search mr-1"></i> Tìm kiếm
                        </button>
                    </div>

                    <div class="col-md-1 mb-2">
                        <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
                    </div>
                </div>
            </form>

            <div>
                <table class="table table-bordered table-hover text-center">
                    <thead style="background-color: #242323c0; color: #C9B037">
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
                                    
                                    @if(session('level') == 1)
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                    </form>
                                    @endif
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

            @if ($articles->hasPages())
                <div class="mt-3 d-flex justify-content-center">
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $articles->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
