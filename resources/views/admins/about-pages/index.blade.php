@extends('admins.layouts.master')

@section('content')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">Danh sách Trang giới thiệu</h4>
        <a href="{{ route('admin.about-pages.create') }}" class="btn btn-success">+ Thêm trang</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if($aboutPages->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Slug</th>
                                <th>Nội dung</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aboutPages as $index => $page)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $page->title }}</strong></td>
                                    <td><code>{{ $page->slug }}</code></td>
                                    <td>
                                        @if($page->content)
                                            <span class="text-muted">{{ htmlToPlainText($page->content, 50) }}</span>
                                        @else
                                            <span class="text-muted">Chưa có nội dung</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.about-pages.edit', $page) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                            <form action="{{ route('admin.about-pages.destroy', $page) }}" 
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Bạn có chắc muốn xóa trang này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Chưa có trang giới thiệu nào</h5>
                    <p class="text-muted">Hãy tạo trang đầu tiên để bắt đầu.</p>
                    <a href="{{ route('admin.about-pages.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tạo trang đầu tiên
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
