@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0">Cập nhật Dịch vụ</h4>
      <a
         href="{{ route('admin.services.index') }}"
         class="btn btn-sm btn-primary"
      >← Quản lý Đối tác</a>
   </div>

   <div class="card shadow-sm">
      <div class="card-body">
         <form
            action="{{ route('admin.services.update' , $service) }}"
            method="POST"
            enctype="multipart/form-data"
         >
            @csrf
            @method('PUT')

            <div class="form-group">
               <h5 for="name">Tên đối tác</h5>
               <input
                  type="text"
                  name="name"
                  id="name"
                  class="form-control"
                  value="{{ $service->name }}"
               >
            </div>
            
            <div class="form-group">
               <h5>Logo hiện tại</h5><br>
               @if ($service->image)
                  <img
                     src="{{ $service->image }}"
                     alt="{{ $service->name }}"
                     width="300"
                     class="img-thumbnail"
                  >
               @else
                  <p class="text-muted">Không có logo</p>
               @endif
               <input type="hidden" name="image_old" value="{{ $service->image }}">
            </div>

            <div class="form-group">
               <h5 for="logo">Thay Logo mới (tùy chọn)</h5>
               <input type="file" name="image" id="image" class="form-control-file">
            </div>

            <div class="form-group">
               <h5 for="description">Mô tả</h5>
               <textarea
                  name="description"
                  id="description"
                  rows="6"
                  class="form-control"
               >
                  {{ $service->description }}
               </textarea>
            </div>
            
            {{-- NỘI DUNG 1 --}}
            <div class="form-group">
               <h5 class="text-primary d-flex justify-content-between align-items-center">
                  Nội dung tóm tắt 1
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
                  <input type="text" name="title_1" id="title_1" class="form-control"
                  value="{{ $service->title_1 }}" required>
               </div>
               <div class="form-group">
                  <h5 for="icon_1">Icon hiện tại</h5>
                  <img
                     src="{{ $service->icon_1 }}"
                     alt="{{ $service->title_1 }}"
                     class="img-thumbnail"
                  >
               </div>
               <div class="form-group">
                  <h5 for="icon_1">Thay icon mới (tùy chọn)</h5>
                  <input type="file" name="icon_1" id="icon_1" class="form-control-file">
               </div>
               <div class="form-group">
                  <h5 for="content_1">Nội dung</h5>
                  <textarea name="content_1" id="content_1" rows="6" class="form-control">
                     {{ $service->content_1 }}
                  </textarea>
               </div>
            </div>

            {{-- NỘI DUNG 2 --}}
            <div class="form-group">
               <h5 class="text-primary d-flex justify-content-between align-items-center">
                  Nội dung tóm tắt 2
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
                  <input type="text" name="title_2" id="title_2" class="form-control"
                  value="{{ $service->title_2 }}" required>
               </div>
               <div class="form-group">
                  <h5 for="icon_2">Icon hiện tại</h5>
                  <img
                     src="{{ $service->icon_2 }}"
                     alt="{{ $service->title_2 }}"
                     class="img-thumbnail"
                  >
               </div>
               <div class="form-group">
                  <h5 for="icon_2">Thay icon mới (tùy chọn)</h5>
                  <input type="file" name="icon_2" id="icon_2" class="form-control-file">
               </div>
               <div class="form-group">
                  <h5 for="content_2">Nội dung</h5>
                  <textarea name="content_2" id="content_2" rows="6" class="form-control">
                     {{ $service->content_2 }}
                  </textarea>
               </div>
            </div>

            {{-- NỘI DUNG 3 --}}
            <div class="form-group">
               <h5 class="text-primary d-flex justify-content-between align-items-center">
                  Nội dung tóm tắt 3
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
                  <input type="text" name="title_3" id="title_3" class="form-control"
                  value="{{ $service->title_3 }}" required>
               </div>
               <div class="form-group">
                  <h5 for="icon_3">Icon hiện tại</h5>
                  <img
                     src="{{ $service->icon_3 }}"
                     alt="{{ $service->title_3 }}"
                     class="img-thumbnail"
                  >
               </div>
               <div class="form-group">
                  <h5 for="icon_3">Thay icon mới (tùy chọn)</h5>
                  <input type="file" name="icon_3" id="icon_3" class="form-control-file">
               </div>
               <div class="form-group">
                  <h5 for="content_3">Nội dung</h5>
                  <textarea name="content_3" id="content_3" rows="6" class="form-control">
                     {{ $service->content_2 }}
                  </textarea>
               </div>
            </div>

            {{-- NỘI DUNG 4 --}}
            <div class="form-group">
               <h5 class="text-primary d-flex justify-content-between align-items-center">
                  Nội dung tóm tắt 4
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
                  <input type="text" name="title_4" id="title_4" class="form-control"
                  value="{{ $service->title_4 }}" required>
               </div>
               <div class="form-group">
                  <h5 for="icon_4">Icon hiện tại</h5>
                  <img
                     src="{{ $service->icon_4 }}"
                     alt="{{ $service->title_4 }}"
                     class="img-thumbnail"
                  >
               </div>
               <div class="form-group">
                  <h5 for="icon_4">Thay icon mới (tùy chọn)</h5>
                  <input type="file" name="icon_4" id="icon_4" class="form-control-file">
               </div>
               <div class="form-group">
                  <h5 for="content_4">Nội dung</h5>
                  <textarea name="content_4" id="content_4" rows="6" class="form-control">
                     {{ $service->content_2 }}
                  </textarea>
               </div>
            </div>

            {{-- NỘI DUNG DỊCH VỤ --}}
            <div class="form-group">
               <h5 class="text-primary d-flex justify-content-between align-items-center">
                  Nội dung dịch vụ (quy trình thực hiện)
                  <button
                        class="btn btn-sm btn-outline-primary"
                        type="button"
                        data-toggle="collapse"
                        data-target="#contentService"
                        aria-expanded="false"
                        aria-controls="contentService"
                  >
                        <i class="fas fa-chevron-down"></i>
                  </button>
               </h5>
            </div>

            <div class="collapse" id="contentService">
               <div class="form-group">
                  <x-editor
                     selector="#quill-editor-service"
                     uploadTable="services"
                     toolbar="full"
                     height="500px"
                     placeholder="Nhập nội dung chi tiết cho dịch vụ ..."
                     :uploadRoute="route('admin.media.uploadImage')"
                     :content="old('content_service', $service->content_service ?? '')"
                     textareaName="content_service"
                  />
               </div>
            </div>

            {{-- NỘI DUNG BÁO GIÁ --}}
            <div class="form-group">
               <h5 class="text-primary d-flex justify-content-between align-items-center">
                  Nội dung báo giá Dich vụ
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
               <div class="form-group">
                  <x-editor
                     selector="#quill-editor-price"
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
               <button type="submit" class="btn btn-warning font-weight-bold">Cập nhập Dịch vụ</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection