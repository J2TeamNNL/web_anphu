@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0">Cập nhật Bài Đăng</h4>
      <a href="{{ route('articles.index') }}" class="btn btn-sm btn-primary">← Quản lý Bài Đăng</a>
   </div>

   <div class="card shadow-sm">
      <div class="card-body">
         <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
               <label for="name">Tên bài đăng</label>
               <input type="text" name="name" id="name" class="form-control" value="{{ $article->name }}">
            </div>

            <div class="form-group">
               <label for="description">Nội dung</label>
               <textarea name="description" id="description" rows="6" class="form-control">{{ $article->description }}</textarea>
            </div>

            <div class="form-group">
               <label for="link">Link</label>
               <input type="text" name="link" id="link" class="form-control" value="{{ $article->link }}">
            </div>

            <div class="form-group">
               <label for="type">Loại hình bài đăng</label>
               <select name="type" id="type" class="form-control" required>
                  <option value="">-- Chọn loại --</option>
                  @foreach ($types as $key => $label)
                     <option value="{{ $key }}" {{ $article->type === $key ? 'selected' : '' }}>
                        {{ $label }}
                     </option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label>Ảnh hiện tại</label><br>
               <img src="{{ asset('storage/' . $article->image) }}" width="200" class="img-thumbnail mb-2">
               <input type="hidden" name="image_old" value="{{ $article->image }}">
            </div>

            <div class="form-group">
               <label for="image_new">Thay ảnh mới (tùy chọn)</label>
               <input type="file" name="image_new" id="image_new" class="form-control-file">
            </div>

            <div class="text-right">
               <button type="submit" class="btn btn-warning font-weight-bold">Cập nhật bài đăng</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
