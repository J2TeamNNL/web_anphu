@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0">Cập nhật Đối tác</h4>
      <a href="{{ route('admin.partners.index') }}" class="btn btn-sm btn-primary">← Quản lý Đối tác</a>
   </div>

   <div class="card shadow-sm">
      <div class="card-body">
         <form action="{{ route('admin.partners.update' , $partner) }}"method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
               <label for="name">Tên đối tác</label>
               <input
                  type="text"
                  name="name"
                  id="name"
                  class="form-control"
                  value="{{ $partner->name }}"
               >
            </div>
            
            <div class="form-group">
               <label>Ảnh hiện tại</label><br>
               @if ($partner->logo)
                  <img
                     src="{{ asset('storage/' . $partner->logo) }}"
                     width="200"
                     class="img-thumbnail mb-2"
                  >
               @else
                  <p class="text-muted">Không có ảnh</p>
               @endif
               <input type="hidden" name="logo_old" value="{{ $partner->logo }}">
            </div>

            <div class="form-group">
               <label for="logo_new">Thay ảnh mới (tùy chọn)</label>
               <input type="file" name="logo_new" id="logo_new" class="form-control-file">
            </div>

            <div class="form-group">
               <label for="link">Link website/mạng xã hội</label>
               <input
                  type="text"
                  name="link"
                  id="link"
                  class="form-control"
                  value="{{ $partner->link }}"
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
                  {{ $partner->description }}
            </textarea>
            </div>

            <div class="text-right">
               <button type="submit" class="btn btn-warning font-weight-bold">Cập nhập Đối tác</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection