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
               <input
                  type="text"
                  name="name"
                  id="name"
                  class="form-control"
                  required
               >
            </div>

            <div class="form-group">
               <label for="link">Link</label>
               <input type="text" name="link" id="link" class="form-control">
            </div>

            <input type="hidden" name="type" value="article">

            <x-category-select 
                label="Danh mục bài đăng"
                :categories="$categories"
                class="form-control select2"
            />

            <div class="form-group">
               <label for="thumbnail">Ảnh mô tả <span class="text-danger">*</span></label>
               <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
            </div>

            <div class="form-group">
               <label for="description">Mô tả</label>
               <textarea
                  name="description"
                  id="description"
                  rows="4"
                  class="form-control"
               >{{ old('description') }}</textarea>
            </div>

            {{-- Component Quill --}}
            <div class="form-group">
               <label for="content">Nội dung chi tiết</label>
               <x-editor 
                  selector="#quill-editor"
                  uploadTable="articles"
                  toolbar="full"
                  height="500px"
                  placeholder="Nhập nội dung mô tả chi tiết..."
                  :uploadRoute="route('admin.media.uploadImage')"
                  :content="old('content', $article->content ?? '')"
                  textareaName="content"
               />
            </div>

            <div class="text-right">
               <button type="submit" class="btn btn-warning font-weight-bold">Thêm bài đăng</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection