@extends('admins.layouts.master')

@section('content')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Xin chào {{ session('name') }}</h5>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">Danh sách Dự án</h4>
        <a 
            href="{{ route('admin.portfolios.create') }}" 
            class="btn btn-success"
        >
            <i class="fa fa-plus mr-1"></i> Thêm Dự án
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form class="mb-3" method="GET">
                <div class="form-row">

                    <div class="col-md-4 mb-2">
                        <input
                            type="text"
                            name="q" id="search"
                            value="{{ old('q', $search ?? '') }}"
                            class="form-control"
                            placeholder="Tìm theo Tên, Mô tả"
                        >
                    </div>

                    <div class="col-md-2 mb-2">
                        <select
                            name="year"
                            class="form-control"
                        >
                            <option value="">-- Năm --</option>
                            @for ($i = date('Y'); $i >= 2015; $i--)
                                <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="ol-md-2 mb-2">
                        <select
                            name="category_id"
                            id="category_id"
                            class="form-control select2"
                        >
                            <option value="">-- Chọn danh mục --</option>

                            @foreach ($categories as $cat)
                                <option
                                    value="{{ $cat->id }}"
                                    {{ request('category_id') == $cat->id ? 'selected' : '' }}
                                >
                                    {{ $cat->name }}
                                </option>

                                @foreach ($cat->children as $child)
                                    <option value="{{ $child->id }}" {{ request('category_id') == $child->id ? 'selected' : '' }}>
                                        — {{ $child->name }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 mb-2">
                        <button 
                            class="btn btn-primary w-100" 
                            type="submit"
                        >
                            <i class="fa fa-search mr-1"></i> Tìm kiếm
                        </button>
                    </div>

                    <div class="col-md-1 mb-2">
                        <a 
                            href="{{ route('admin.portfolios.index') }}" 
                            class="btn btn-outline-secondary w-100"
                        >
                            Đặt lại
                        </a>
                    </div>
                </div>
            </form>

            <div>
                <table class="table table-bordered table-hover text-center">
                    <thead style="background-color: #242323c0; color: #C9B037">
                        <tr>
                            <th>#</th>
                            <th>Tên dự án</th>
                            <th>Địa điểm</th>
                            <th>Khách hàng</th>
                            <th>Ảnh mô tả</th>
                            <th>Mô tả</th>
                            <th>Năm</th>
                            <th>Loại dự án</th>
                            <th>Loại hình</th>
                            <th>Chi tiết</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($portfolios as $portfolio)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $portfolio->name }}</td>
                                <td>{{ $portfolio->location }}</td>
                                <td>{{ $portfolio->client }}</td>
                                <td>
                                    @if ($portfolio->thumbnail)
                                        <img src="{{ $portfolio->thumbnail }}" alt="{{ $portfolio->name }}" width="100" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">Không có</span>
                                    @endif
                                </td>
                                <td class="text-left" style="max-width: 200px;">
                                    {{ \Illuminate\Support\Str::limit($portfolio->description, 100) }}
                                </td>
                                <td>{{ $portfolio->year }}</td>
                                <td>{{ $portfolio->getParentCategoryNameAttribute() }}</td>
                                <td>{{ $portfolio->getCategoryNameAttribute() }}</td>
                                <td>
                                    <a href="{{ route('admin.portfolios.show', $portfolio)}}">Xem chi tiết</a>
                                </td>
                                <td>
                                    <a 
                                        href="{{ route('admin.portfolios.edit', $portfolio) }}" 
                                        class="btn btn-sm btn-primary mb-1"
                                    >
                                        Sửa
                                    </a>
                                    <form 
                                        href="{{ route('admin.portfolios.edit', $portfolio) }}" 
                                        action="{{ route('admin.portfolios.destroy', $portfolio) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Bạn chắc chắn muốn xoá?')" 
                                        class="d-inline"
                                    >
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

            @if ($portfolios->hasPages())
                <div class="mt-3 d-flex justify-content-center">
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $portfolios->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#category_id').select2();

    $('#category_id').on('change', function () {
        const params = new URLSearchParams(window.location.search);
        params.set('category_id', $(this).val());
        window.location.search = params.toString();
    });

    $('select[name="year"]').on('change', function () {
        const params = new URLSearchParams(window.location.search);
        params.set('year', $(this).val());
        window.location.search = params.toString();
    });
});
</script>
@endpush
