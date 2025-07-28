@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0">Thêm Bài Đăng</h4>
      <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-primary">← Quản lý Bài Đăng</a>
   </div>

   <div class="card shadow-sm">
      <div class="card-body">
         <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
               <label for="name">Tên bài đăng</label>
               <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="description">Nô tả</label>
               <textarea name="description" id="description" rows="6" class="form-control"></textarea>
            </div>

            <div class="form-group">
               <label for="link">Link</label>
               <input type="text" name="link" id="link" class="form-control">
            </div>

            <input type="hidden" name="type" value="article">

            <div class="form-group">
               <label for="category_id">Danh mục bài đăng</label>
               <select name="category_id" id="category_id" class="form-control select2">
                  <option value="">-- Chọn danh mục --</option>
                  @foreach ($categories as $cat)
                        {{-- Option cho cấp 1 --}}
                        <option value="{{ $cat->id }}"
                           {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                           {{ $cat->name }}
                        </option>

                        {{-- Nếu có cấp con, hiển thị thêm --}}
                        @if ($cat->children->isNotEmpty())
                           @foreach ($cat->children as $child)
                              <option value="{{ $child->id }}"
                                    {{ old('category_id') == $child->id ? 'selected' : '' }}>
                                    — {{ $child->name }}
                              </option>
                           @endforeach
                        @endif
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="image">Ảnh bài đăng</label>
               <input type="file" name="image" id="image" class="form-control-file">
            </div>
            
            <div class="form-group">
               <label for="content">Nội dung bài viết</label>
               <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content', $article->content ?? '') }}</textarea>
            </div>

            <div class="text-right">
               <button type="submit" class="btn btn-warning font-weight-bold">Thêm bài đăng</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

@include('admins.articles.scripts_ckeditor')