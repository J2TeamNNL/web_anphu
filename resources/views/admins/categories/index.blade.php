@extends('admins.layouts.master')

@section('content')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Xin chào {{ session('name') }}</h5>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">Danh sách Danh mục</h4>
        <a href="{{ route('categories.create') }}" class="btn btn-success">+ Thêm danh mục</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form class="mb-3" method="GET">
                <div class="form-row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="q" value="{{ old('q', $search ?? '') }}" class="form-control" placeholder="Tìm theo Tên">
                    </div>

                    <div class="col-md-2 mb-2">
                        <button class="btn btn-primary w-100" type="submit">
                            <i class="fa fa-search mr-1"></i> Tìm kiếm
                        </button>
                    </div>

                    <div class="col-md-1 mb-2">
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
                    </div>
                </div>
            </form>

            <div>
                @if ($categories->isEmpty())
                    <div class="text-muted">Chưa có danh mục nào.</div>
                @else
                    <ul class="list-group">
                        @foreach ($categories as $category)
                            @include('admins.categories._category_item', ['category' => $category, 'level' => 0])
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection