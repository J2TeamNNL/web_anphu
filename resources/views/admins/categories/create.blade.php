@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0">Thêm Bài Đăng</h4>
      <a href="{{ route('articles.index') }}" class="btn btn-sm btn-primary">← Quản lý Bài Đăng</a>
   </div>

   <div class="card shadow-sm">
      <div class="card-body">
         <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
               <label for="name">Tên bài đăng</label>
               <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="description">Nội dung</label>
               <textarea name="description" id="description" rows="6" class="form-control"></textarea>
            </div>

            <div class="form-group">
               <label for="link">Link</label>
               <input type="text" name="link" id="link" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="type">Loại hình bài đăng</label>
               <select name="type" id="type" class="form-control" required>
                  <option value="">-- Chọn loại --</option>
                  @foreach ($types as $key => $label)
                     <option value="{{ $key }}">{{ $label }}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="image">Ảnh bài đăng</label>
               <input type="file" name="image" id="image" class="form-control-file" required>
            </div>

            <div class="text-right">
               <button type="submit" class="btn btn-warning font-weight-bold">Thêm bài đăng</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
