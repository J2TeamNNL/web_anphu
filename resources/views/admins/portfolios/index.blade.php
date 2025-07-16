@extends('admins.layouts.master')

@section('portfolios_index')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Xin chào {{ session('name') }}</h5>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">Danh sách Dự án</h4>
        <a href="{{ route('portfolios.create') }}" class="btn btn-success">+ Thêm Dự án</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form class="mb-3" method="GET">
                <div class="form-row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="q" value="{{ old('q', $search ?? '') }}" class="form-control" placeholder="Tìm theo Tên, Địa điểm, Khách hàng...">
                    </div>

                    <div class="col-md-2 mb-2">
                        <select name="year" class="form-control">
                            <option value="">-- Năm --</option>
                            @foreach ($years as $y)
                                <option value="{{ $y }}" {{ ($selectedYear ?? '') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <select name="category" class="form-control">
                            <option value="">-- Danh mục --</option>
                            @foreach ($categories as $group => $items)
                                <optgroup label="{{ ucfirst($group) }}">
                                    @foreach ($items as $key => $label)
                                        <option value="{{ $key }}" {{ ($selectedCategory ?? '') === $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 mb-2">
                        <button class="btn btn-primary w-100" type="submit">
                            <i class="fa fa-search mr-1"></i> Tìm kiếm
                        </button>
                    </div>

                    <div class="col-md-1 mb-2">
                        <a href="{{ route('portfolios.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead style="background-color: #242323c0; color: #C9B037">
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
                                        <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->name }}" width="100" class="img-thumbnail">
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
