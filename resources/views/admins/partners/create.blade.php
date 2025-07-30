@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0">Thêm Đối tác</h4>
      <a href="{{ route('admin.partners.index') }}" class="btn btn-sm btn-primary">← Quản lý Đối tác</a>
   </div>

   <div class="card shadow-sm">
      <div class="card-body">
         <form action="{{ route('admin.partners.store') }}"method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
               <label for="name">Tên đối tác</label>
               <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="logo">Logo đối tác</label>
               <input type="file" name="logo" id="logo" class="form-control">
            </div>
            
            <div class="form-group">
               <label for="link">Link website/mạng xã hội</label>
               <input type="text" name="link" id="link" class="form-control">
            </div>

            <div class="form-group">
               <label for="description">Mô tả</label>
               <textarea name="description" id="description" rows="6" class="form-control"></textarea>
            </div>

            <div class="text-right">
               <button type="submit" class="btn btn-warning font-weight-bold">Thêm Đối tác</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection