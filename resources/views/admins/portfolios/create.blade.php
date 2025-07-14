@extends('admins.layouts.master')

@section('portfolios_create')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Thêm Dự Án</h4>
        <a href="{{ route('portfolios.index') }}" class="btn btn-sm btn-primary">← Quản lý dự án</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Tên dự án</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="location">Địa điểm</label>
                    <input type="text" name="location" id="location" class="form-control">
                </div>

                <div class="form-group">
                    <label for="client">Khách hàng</label>
                    <input type="text" name="client" id="client" class="form-control">
                </div>

                <div class="form-group">
                    <label for="image">Ảnh mô tả</label>
                    <input type="file" name="image" id="image" class="form-control-file" required>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="year">Năm thực hiện</label>
                    <input type="number" name="year" id="year" class="form-control">
                </div>

                <div class="form-group">
                    <label for="type">Loại hình dự án</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="">-- Chọn loại --</option>
                        @foreach ($types as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="category">Phân danh mục</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="">-- Chọn danh mục --</option>
                        {{-- Sẽ render bằng JS --}}
                    </select>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-warning font-weight-bold">Thêm dự án</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@include('admins.scripts_portfolios_create_types_categories')