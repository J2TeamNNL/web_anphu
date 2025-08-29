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
        <h4 class="mb-0 text-primary">Danh sách Bài đăng</h4>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-success">+ Thêm bài đăng</a>
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

                    <x-category-select 
                        :categories="$categories"
                        :showChildren="false"
                        :label="null"
                    />

                    <div class="col-md-2 mb-2">
                        <button class="btn btn-primary w-100" type="submit">
                            <i class="fa fa-search mr-1"></i> Tìm kiếm
                        </button>
                    </div>

                    <div class="col-md-1 mb-2">
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
                    </div>
                </div>
            </form>

            <div>
                <table class="table table-bordered table-hover text-center">
                    <thead style="background-color: #242323c0; color: #C9B037">
                        <tr>
                            <th>#</th>
                            <th>Tên bài</th>
                            <th>Ảnh mô tả</th>
                            <th>Mô tả</th>
                            <th>Loại bài viết</th>
                            <th>Danh mục</th>
                            <th>Chi tiết</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $article->name }}</td>
                                <td>
                                    @if ($article->thumbnail)
                                        <img src="{{ $article->thumbnail }}" alt="{{ $article->name }}" width="100" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">Không có</span>
                                    @endif
                                </td>
                                <td class="text-left" style="max-width: 200px;">
                                    {{ \Illuminate\Support\Str::limit($article->description, 100) }}
                                </td>
                                <td>
                                    <span class="text-primary font-weight-bold">
                                        {{ $article->getParentCategoryNameAttribute()?? $article->category->name ?? '-' }}
                                    </span>
                                </td>
                                <td>{{ $article->category->name ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.articles.show', $article)}}">Xem chi tiết</a>
                                </td>
                                <td>
                                    <a 
                                        href="{{ route('admin.articles.edit', $article) }}" 
                                        class="btn btn-sm btn-primary mb-1"
                                    >
                                        Sửa
                                    </a>
                                    <form 
                                        href="{{ route('admin.articles.edit', $article) }}" 
                                        action="{{ route('admin.articles.destroy', $article) }}" 
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

@push('scripts')
<script>
$(function() {
    $('#category_id').select2();

    $('#category_id').on('change', function () {
        const params = new URLSearchParams(window.location.search);
        params.set('category_id', $(this).val());
        window.location.search = params.toString();
    });
});
</script>
@endpush