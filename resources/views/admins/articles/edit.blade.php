@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0">Cập nhật Bài Đăng</h4>
      <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-primary">← Quản lý Bài Đăng</a>
   </div>

   <div class="card shadow-sm">
      <div class="card-body">
         <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
               <label for="name">Tên bài đăng</label>
               <input
                  type="text"
                  name="name"
                  id="name"
                  class="form-control"
                  value="{{ $article->name }}"
               >
            </div>

            <div class="form-group">
               <label for="description">Mô tả</label>
               <textarea
                  name="description"
                  id="description"
                  rows="6"
                  class="form-control"
               >
                  {{ $article->description }}
            </textarea>
            </div>

            <div class="form-group">
               <label for="link">Link</label>
               <input
                  type="text"
                  name="link"
                  id="link"
                  class="form-control"
                  value="{{ $article->link }}"
               >
            </div>

            <input type="hidden" name="type" value="article">

            <div class="form-group">
               <label for="category_id">Danh mục bài đăng</label>
               <select name="category_id" id="category_id" class="form-control select2">
                  <option value="">-- Chọn danh mục --</option>
                  @foreach ($categories as $cat)
                        {{-- Option cho cấp 1 --}}
                        <option value="{{ $cat->id }}"
                           {{ old('category_id', $article->category_id) == $cat->id ? 'selected' : '' }}>
                           {{ $cat->name }}
                        </option>

                        {{-- Nếu có cấp con, hiển thị thêm --}}
                        @if ($cat->children->isNotEmpty())
                           @foreach ($cat->children as $child)
                              <option value="{{ $child->id }}"
                                 {{ (old('category_id', $article->category_id) == $child->id) ? 'selected' : '' }}>
                                       {{ $child->name }}
                                 </option>
                           @endforeach
                        @endif
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label>Ảnh hiện tại</label><br>
               @if ($article->image)
                  <img
                     src="{{ asset('storage/' . $article->image) }}"
                     width="200"
                     class="img-thumbnail mb-2"
                  >
               @else
                  <p class="text-muted">Không có ảnh</p>
               @endif
               <input type="hidden" name="image_old" value="{{ $article->image }}">
            </div>

            <div class="form-group">
               <label for="image_new">Thay ảnh mới (tùy chọn)</label>
               <input type="file" name="image_new" id="image_new" class="form-control-file">
            </div>

            <div class="form-group">
               <label for="content">Nội dung bài viết</label>
               <textarea
                  name="content"
                  id="editor"
                  class="form-control"
                  rows="10"
               >
                  {{ old('content', $article->content ?? '') }}
               </textarea>
            </div>

            <div class="text-right">
               <button type="submit" class="btn btn-warning font-weight-bold">Cập nhật bài đăng</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

@include('admins.articles.partials.scripts_ckeditor_articles')
