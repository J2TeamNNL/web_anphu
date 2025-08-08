@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0">Thêm Dịch vụ</h4>
      <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-primary">← Quản lý Dịch vụ</a>
   </div>

   <div class="card shadow-sm">
      <div class="card-body">
         <form action="{{ route('admin.services.store') }}"method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
               <label for="name">Tên dịch vụ</label>
               <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="image">Logo dịch vụ</label>
               <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="form-group">
               <label for="slogan">Slogan</label>
               <input type="text" name="slogan" id="slogan" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="description">Mô tả</label>
               <textarea name="description" id="description" rows="6" class="form-control"></textarea>
            </div>

            {{-- NỘI DUNG 1 --}}
            <div class="form-group">
               <h4 for="" class='text-primary'>Đoạn nội dung 1</h4>
            </div>
            <div class="form-group">
               <h5 for="title_1">Tiêu đề</h5>
               <input type="text" name="title_1" id="title_1" class="form-control" required>
            </div>
            <div class="form-group">
               <h5 for="icon_1">Icon</h5>
               <input type="file" name="icon_1" id="icon_1" class="form-control">
            </div>
            <div class="form-group">
               <h5 for="content_1">Nội dung</h5>
               <textarea name="content_1" id="content_1" rows="6" class="form-control"></textarea>
            </div>

            {{-- NỘI DUNG 2 --}}
            <div class="form-group">
               <h4 for="" class='text-primary'>Đoạn nội dung 2</h4>
            </div>
            <div class="form-group">
               <h5 for="title_2">Tiêu đề 2</h5>
               <input type="text" name="title_2" id="title_2" class="form-control" required>
            </div>
            <div class="form-group">
               <h5 for="icon_2">Icon</h5>
               <input type="file" name="icon_2" id="icon_2" class="form-control">
            </div>
            <div class="form-group">
               <label for="content_2">Nội dung 2</label>
               <textarea name="content_2" id="content_2" rows="6" class="form-control"></textarea>
            </div>

            {{-- NỘI DUNG 3 --}}
            <div class="form-group">
               <h4 for="" class='text-primary'>Đoạn nội dung 3</h4>
            </div>
            <div class="form-group">
               <h5 for="title_3">Tiêu đề 3</h5>
               <input type="text" name="title_3" id="title_3" class="form-control" required>
            </div>
            <div class="form-group">
               <h5 for="icon_3">Icon</h5>
               <input type="file" name="icon_3" id="icon_3" class="form-control">
            </div>
            <div class="form-group">
               <label for="content_3">Nội dung 3</label>
               <textarea name="content_3" id="content_3" rows="6" class="form-control"></textarea>
            </div>

            {{-- NỘI DUNG 4 --}}
            <div class="form-group">
               <h4 for="" class='text-primary'>Đoạn nội dung 4</h4>
            </div>
            <div class="form-group">
               <h5 for="title_4">Tiêu đề 4</h5>
               <input type="text" name="title_4" id="title_4" class="form-control" required>
            </div>
            <div class="form-group">
               <h5 for="icon_4">Icon</h5>
               <input type="file" name="icon_4" id="icon_4" class="form-control">
            </div>
            <div class="form-group">
               <label for="content_4">Nội dung 4</label>
               <textarea name="content_4" id="content_4" rows="6" class="form-control"></textarea>
            </div>

            <div class="text-right">
               <button type="submit" class="btn btn-warning font-weight-bold">Thêm Dịch vụ</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection