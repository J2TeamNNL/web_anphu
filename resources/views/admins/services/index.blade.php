@extends('admins.layouts.master')

@push('styles')
<style>

.select2-container--default .select2-selection--single {
    height: 38px !important;
    padding: 6px 12px;
    border: 1px solid #ced4da;
    border-radius: 4px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 24px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px;
    right: 6px;
}

.select2-container {
    width: 100% !important;
}

</style>
@endpush

@section('content')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">Danh sách Dịch vụ</h4>
        <a href="{{ route('admin.services.create') }}" class="btn btn-success">+ Thêm Dịch vụ</a>
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
                        <button class="btn btn-primary w-100" type="submit">
                            <i class="fa fa-search mr-1"></i> Tìm kiếm
                        </button>
                    </div>

                    <div class="col-md-1 mb-2">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
                    </div>
                </div>
            </form>

            <div>
                <table class="table table-bordered table-hover text-center">
                    <thead style="background-color: #242323c0; color: #C9B037">
                        <tr>
                            <th>#</th>
                            <th>Tên dịch vụ</th>
                            <th>Ảnh đại diện</th>
                            <th>Mô tả</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->name }}</td>
                                <td>
                                    @if ($service->image)
                                        <img
                                            src="{{ $service->image }}"
                                            alt="{{ $service->name }}"
                                            width="100"
                                            class="img-thumbnail"
                                        >
                                    @else
                                        <span class="text-muted">Không có</span>
                                    @endif
                                </td>
                                <td class="text-left" style="max-width: 200px;">
                                    {{ \Illuminate\Support\Str::limit($service->description, 100) }}
                                </td>
                                
                                    <td>
                                        <a
                                            href="{{ route('admin.services.edit', $service) }}"
                                            class="btn btn-sm btn-primary mb-1"
                                        >
                                            Sửa
                                        </a>
                                        @if(auth()->user()->level == 1)
                                        <form
                                            action="{{ route('admin.services.destroy', $service) }}"
                                            method="POST"
                                            onsubmit="return confirm('Bạn chắc chắn muốn xoá?')"
                                            class="d-inline"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                        </form>
                                        @endif
                                    </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-muted">Chưa có dịch vụ nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($services->hasPages())
                <div class="mt-3 d-flex justify-content-center">
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $service->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection