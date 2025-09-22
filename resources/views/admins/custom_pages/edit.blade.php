@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Cập nhật Trang</h4>
        <a href="{{ route('admin.custom_pages.index') }}" class="btn btn-sm btn-primary">← Quản lý Trang</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.custom_pages.update', $page) }}">
               @csrf
               @method('PUT')

               {{-- Tên --}}
               <div class="form-group">
                  <h5>Tên</h5>
                  <input type="text" name="name" class="form-control" value="{{ old('name', $page->name ?? '') }}" required>
               </div>

               {{-- Slug --}}
               <div class="form-group">
                  <h5>Slug</h5>
                  <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug ?? '') }}" required>
               </div>

               {{-- Các block nội dung --}}
               @for($i=1; $i<=4; $i++)
                <div class="form-group">
                    <h5
                        class="d-flex justify-content-between align-items-center"
                        style="color: #030a36; background-color: #73c595; padding: 4px 12px; border-radius: 5px; cursor: pointer;"
                        data-toggle="collapse"
                        data-target="#blockContent{{ $i }}"
                        aria-expanded="false"
                        aria-controls="blockContent{{ $i }}"
                    >
                        Block Nội dung {{ $i }}
                        <button
                            class="btn btn-sm btn-outline-primary"
                            type="button"
                            aria-label="Toggle Block Nội dung {{ $i }}"
                        >
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>

                <div class="collapse" id="blockContent{{ $i }}">
                    <div class="border rounded p-3 mb-3">

                        {{-- Tiêu đề --}}
                        <div class="form-group">
                            <h5 class="text-primary">Tiêu đề {{ $i }}</label>
                            <input type="text" name="title_{{ $i }}" class="form-control" value="{{ old("title_$i", $page["title_$i"] ?? '') }}">
                        </div>

                        {{-- Ảnh --}}
                        <div class="form-group">
                            <h5 class="text-primary">Ảnh {{ $i }} (tùy chọn)</h5>
                            <input type="file" name="image_{{ $i }}" class="form-control-file">
                            @if(!empty($page["image_$i"]))
                                <div class="mt-2">
                                    <p>Ảnh hiện tại:</p>
                                    <img src="{{ $page["image_$i"] }}" class="img-thumbnail" width="150" alt="Lỗi ảnh {{ $i }}">
                                </div>
                            @endif
                        </div>

                        {{-- Nội dung --}}
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
                  <button type="submit" class="btn btn-success">Cập nhật</button>
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
