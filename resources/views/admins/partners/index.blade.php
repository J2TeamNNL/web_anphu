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
        <h4 class="mb-0 text-primary">Danh sách đối tác</h4>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-success">+ Thêm đối tác</a>
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
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
                    </div>
                </div>
            </form>

            <div>
                <table class="table table-bordered table-hover text-center">
                    <thead style="background-color: #242323c0; color: #C9B037">
                        <tr>
                            <th>#</th>
                            <th>Tên đối tác</th>
                            <th>Logo</th>
                            <th>Mô tả</th>
                            <th>Link Website</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partners as $partner)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $partner->name }}</td>
                                <td>
                                    @if ($partner->logo)
                                        <img
                                            src="{{ $partner->logo }}"
                                            alt="{{ $partner->name }}"
                                            width="100"
                                            class="img-thumbnail"
                                        >
                                    @else
                                        <span class="text-muted">Không có</span>
                                    @endif
                                </td>
                                <td class="text-left" style="max-width: 200px;">
                                    {{ \Illuminate\Support\Str::limit($partner->description, 100) }}
                                </td>
                                <td>
                                    <a href="{{ $partner->link }}">{{ $partner->link }}</a>
                                </td>
                                <td>
                                    <a
                                        href="{{ route('admin.partners.edit', $partner) }}"
                                        class="btn btn-sm btn-primary mb-1"
                                    >
                                        Sửa
                                    </a>
                                    
                                    <form
                                        action="{{ route('admin.partners.destroy', $partner) }}"
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
                                <td colspan="7" class="text-muted">Chưa có bài đối tác nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($partners->hasPages())
                <div class="mt-3 d-flex justify-content-center">
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $partners->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection