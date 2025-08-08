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
               <h5 class="text-primary d-flex justify-content-between align-items-center">
                  Đoạn nội dung 1
                  <button
                     class="btn btn-sm btn-outline-primary"
                     type="button"
                     data-toggle="collapse"
                     data-target="#content1"
                     aria-expanded="false"
                     aria-controls="content1"
                  >
                        <i class="fas fa-chevron-down"></i>
                  </button>
               </h5>
            </div>

            <div class="collapse" id="content1">
               <div class="form-group">
                  <h5 for="title_1">Tiêu đề</h5>
                  <input type="text" name="title_1" id="title_1" class="form-control">
               </div>
               <div class="form-group">
                  <h5 for="icon_1">Icon</h5>
                  <input type="file" name="icon_1" id="icon_1" class="form-control">
               </div>
               <div class="form-group">
                  <h5 for="content_1">Nội dung</h5>
                  <textarea name="content_1" id="content_1" rows="6" class="form-control"></textarea>
               </div>
            </div>

            {{-- NỘI DUNG 2 --}}
            <div class="form-group">
               <h5 class="text-primary d-flex justify-content-between align-items-center">
                  Đoạn nội dung 2
                  <button
                     class="btn btn-sm btn-outline-primary"
                     type="button"
                     data-toggle="collapse"
                     data-target="#content2"
                     aria-expanded="false"
                     aria-controls="content2"
                  >
                        <i class="fas fa-chevron-down"></i>
                  </button>
               </h5>
            </div>

            <div class="collapse" id="content2">
               <div class="form-group">
                  <h5 for="title_2">Tiêu đề</h5>
                  <input type="text" name="title_2" id="title_2" class="form-control">
               </div>
               <div class="form-group">
                  <h5 for="icon_2">Icon</h5>
                  <input type="file" name="icon_2" id="icon_2" class="form-control">
               </div>
               <div class="form-group">
                  <h5 for="content_2">Nội dung</h5>
                  <textarea name="content_2" id="content_2" rows="6" class="form-control"></textarea>
               </div>
            </div>

            {{-- NỘI DUNG 3 --}}
            <div class="form-group">
               <h5 class="text-primary d-flex justify-content-between align-items-center">
                  Đoạn nội dung 3
                  <button
                     class="btn btn-sm btn-outline-primary"
                     type="button"
                     data-toggle="collapse"
                     data-target="#content3"
                     aria-expanded="false"
                     aria-controls="content3"
                  >
                     <i class="fas fa-chevron-down"></i>
                  </button>
               </h5>
            </div>

            <div class="collapse" id="content3">
               <div class="form-group">
                  <h5 for="title_3">Tiêu đề</h5>
                  <input type="text" name="title_3" id="title_3" class="form-control">
               </div>
               <div class="form-group">
                  <h5 for="icon_3">Icon</h5>
                  <input type="file" name="icon_3" id="icon_3" class="form-control">
               </div>
               <div class="form-group">
                  <h5 for="content_3">Nội dung</h5>
                  <textarea name="content_3" id="content_3" rows="6" class="form-control"></textarea>
               </div>
            </div>

            {{-- NỘI DUNG 4 --}}
            <div class="form-group">
               <h5 class="text-primary d-flex justify-content-between align-items-center">
                  Đoạn nội dung 4
                  <button
                     class="btn btn-sm btn-outline-primary"
                     type="button"
                     data-toggle="collapse"
                     data-target="#content4"
                     aria-expanded="false"
                     aria-controls="content4"
                  >
                        <i class="fas fa-chevron-down"></i>
                  </button>
               </h5>
            </div>

            <div class="collapse" id="content4">
               <div class="form-group">
                  <h5 for="title_4">Tiêu đề</h5>
                  <input type="text" name="title_4" id="title_4" class="form-control">
               </div>
               <div class="form-group">
                  <h5 for="icon_4">Icon</h5>
                  <input type="file" name="icon_4" id="icon_4" class="form-control">
               </div>
               <div class="form-group">
                  <h5 for="content_4">Nội dung</h5>
                  <textarea name="content_4" id="content_4" rows="6" class="form-control"></textarea>
               </div>
            </div>

            {{-- NỘI DUNG BÁO GIÁ --}}
            <div class="form-group">
               <h5 class="text-primary d-flex justify-content-between align-items-center">
                  Nội dung báo giá
                  <button
                        class="btn btn-sm btn-outline-primary"
                        type="button"
                        data-toggle="collapse"
                        data-target="#contentPrice"
                        aria-expanded="false"
                        aria-controls="contentPrice"
                  >
                        <i class="fas fa-chevron-down"></i>
                  </button>
               </h5>
            </div>

            <div class="collapse" id="contentPrice">
               {{-- Component Quill --}}
               <div class="form-group">
                  <x-editor
                     selector="#quill-editor"
                     uploadTable="services"
                     toolbar="full"
                     height="500px"
                     placeholder="Nhập nội dung báo giá cho dịch vụ ..."
                     :uploadRoute="route('admin.media.uploadImage')"
                     :content="old('content_price', $service->content_price ?? '')"
                     textareaName="content_price"
                  />
               </div>
            </div>

            <div class="text-right">
               <button type="submit" class="btn btn-warning font-weight-bold">Thêm Dịch vụ</button>
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