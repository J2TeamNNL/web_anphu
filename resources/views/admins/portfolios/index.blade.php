@extends('admins.layouts.master')

@section('portfolios_index')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Xin chào {{ session('name')}}</h3>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">Danh sách Dự án</h4>
        <a href="{{ route('portfolios.create') }}" class="btn btn-success">+ Thêm Dự án</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            {{-- Tìm kiếm (để dành nếu muốn thêm sau) --}}
            {{-- 
            <form class="form-inline mb-3" method="GET">
                <div class="input-group w-100">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Tìm kiếm...">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> 
            --}}

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Tên dự án</th>
                            <th>Địa điểm</th>
                            <th>Khách hàng</th>
                            <th>Ảnh đại diện</th>
                            <th>Mô tả</th>
                            <th>Năm</th>
                            <th>Loại</th>
                            <th>Danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($portfolios as $portfolio)
                            <tr>
                                <td>{{ $portfolio->id }}</td>
                                <td>{{ $portfolio->name }}</td>
                                <td>{{ $portfolio->location }}</td>
                                <td>{{ $portfolio->client }}</td>
                                <td>
                                    @if ($portfolio->image)
                                        <img src="{{ asset("storage/{$portfolio->image}") }}" alt="{{ $portfolio->name }}" width="100" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">Không có</span>
                                    @endif
                                </td>
                                <td class="text-left" style="max-width: 200px;">
                                    {{ \Illuminate\Support\Str::limit($portfolio->description, 100) }}
                                </td>
                                <td>{{ $portfolio->year }}</td>
                                <td>{{ $portfolio->getTypeName() }}</td>
                                <td>{{ $portfolio->getCategoryName() }}</td>
                                <td>
                                    <a href="{{ route('portfolios.edit', $portfolio) }}" class="btn btn-sm btn-primary mb-1">Sửa</a>
                                    <form action="{{ route('portfolios.destroy', $portfolio) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-muted">Chưa có dự án nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
