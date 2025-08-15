@extends('admins.layouts.master')

@section('content')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">Danh sách Trang Tùy chỉnh</h4>
        <a href="{{ route('admin.custom_pages.create') }}" class="btn btn-success">+ Thêm Trang</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-hover text-center">
                <thead style="background-color: #242323c0; color: #C9B037">
                    <tr>
                        <th>#</th>
                        <th>Tên trang</th>
                        <th>Slug</th>
                        @for($i=1; $i<=4; $i++)
                            <th>Đoạn Mô tả {{ $i }}</th>
                        @endfor
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $page->name }}</strong></td>
                            <td>{{ $page->slug }}</td>
                            @for($i=1; $i<=4; $i++)
                                <td style="max-width:200px; text-align:left;">
                                    @if($page['title_'.$i])
                                        {{ $page['title_'.$i] }}
                                    @endif
                                    
                                </td>
                            @endfor
                            <td>
                                <a href="{{ route('admin.custom_pages.edit', $page) }}" class="btn btn-sm btn-primary mb-1">Sửa</a>
                                <form action="{{ route('admin.custom_pages.destroy', $page) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn chắc chắn muốn xoá?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ 2 + 2*4 + 1 }}" class="text-muted">Chưa có trang nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if ($pages->hasPages())
            <div class="mt-3 d-flex justify-content-center">
                {{ $pages->links('pagination::bootstrap-4') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
