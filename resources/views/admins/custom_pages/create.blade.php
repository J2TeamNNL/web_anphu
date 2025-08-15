@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ isset($page) ? 'Cập nhật Trang' : 'Thêm Trang' }}</h4>
        <a href="{{ route('admin.custom_pages.index') }}" class="btn btn-sm btn-primary">← Quản lý Trang</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" 
                  action="{{ isset($page) ? route('admin.custom_pages.update', $page) : route('admin.custom_pages.store') }}">
                @csrf
                @if(isset($page)) @method('PUT') @endif

                {{-- Tên & Slug --}}
                <div class="form-group">
                    <h5>Tên</h5>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $page->name ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug ?? '') }}" required>
                </div>

                {{-- Các block nội dung --}}
                @for($i=1; $i<=4; $i++)
                    <div class="form-group mt-4">
                        <h5
                            class="d-flex justify-content-between align-items-center"
                            style="color: #030a36; background-color: #73c595; padding: 6px 12px; border-radius: 5px; cursor: pointer;"
                            data-toggle="collapse"
                            data-target="#collapseBlock{{ $i }}"
                            aria-expanded="false"
                            aria-controls="collapseBlock{{ $i }}"
                        >
                            Chỉnh sửa khu Nội dung {{ $i }}
                            <button class="btn btn-sm btn-outline-primary" type="button">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </h5>
                    </div>

                    <div class="collapse" id="collapseBlock{{ $i }}">
                        <div class="border rounded p-3 mb-3" style="background-color: #fff;">
                            <div class="form-group">
                                <h5 class="text-primary">Tiêu đề {{ $i }}</h5>
                                <input type="text" name="title_{{ $i }}" class="form-control" 
                                       value="{{ old("title_$i", $page["title_$i"] ?? '') }}">
                            </div>

                            <div class="form-group">
                                <h5 class="text-primary">Ảnh {{ $i }} (tùy chọn)</h5>
                                <input type="file" name="image_{{ $i }}" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <h5 class="text-primary">Nội dung {{ $i }}</h5>
                                <x-editor
                                    selector="#quill-editor-{{ $i }}"
                                    uploadTable="custom_pages"
                                    toolbar="full"
                                    height="500px"
                                    placeholder="Nhập nội dung trong trang ..."
                                    :uploadRoute="route('admin.media.uploadImage')"
                                    :content="old('custom_content_'.$i, $page['custom_content_'.$i] ?? '')"
                                    textareaName="custom_content_{{ $i }}"
                                />
                            </div>
                        </div>
                    </div>
                @endfor

                <div class="text-right">
                    <button type="submit" class="btn btn-success">{{ isset($page) ? 'Cập nhật' : 'Tạo mới' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('.collapse').on('show.bs.collapse', function(){
            $(this).prev().find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
        }).on('hide.bs.collapse', function(){
            $(this).prev().find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        });
    });
</script>
@endpush
