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
               <label for="slogan">Slogan</label>
               <input type="text" name="slogan" id="slogan" class="form-control"
                  value="{{ $service->slogan }}"
               >
            </div>

            <div class="form-group">
               <h5 for="description">Mô tả sơ bộ</h5>
               <textarea
                  name="description"
                  id="description"
                  rows="6"
                  class="form-control"
               >
                  {{ $service->description }}
               </textarea>
            </div>
            

            
            {{-- NỘI DUNG TIÊU ĐỀ --}}
            <div class="form-group">
               <h5 class="d-flex justify-content-between align-items-center"
                  style="color: #030a36; background-color: #73c595; padding: 4px 12px; border-radius: 5px;"
                  style="cursor: pointer;"
                  data-toggle="collapse"
                  data-target="#collapseTitles"
                  aria-expanded="false"
                  aria-controls="collapseTitles"
               >
                  Chỉnh sửa Nội dung tiêu đề
                  <button class="btn btn-sm btn-outline-primary" type="button">
                     <i class="fas fa-chevron-down"></i>
                  </button>
               </h5>
            </div>

            <div class="collapse" id="collapseTitles">
               <div class="row">
                  @for ($i = 1; $i <= 4; $i++)
                     <div class="col-md-6 mb-4"
                        style="
                           border: 1px solid #ccc;
                           border-radius: 15px;
                           padding: 20px;
                           background-color: #fff;
                           box-shadow: 0 2px 6px rgba(0,0,0,0.05);
                           height: 100%;
                           transition: box-shadow 0.2s ease, transform 0.2s ease;
                        ">
                        <div class="border rounded p-3 h-100">
                           {{-- Form chỉnh sửa --}}
                           <div class="form-group">
                              <h5 for="title_{{ $i }}" class="text-primary">
                                 Tiêu đề {{ $i }}
                              </h5>
                           </div>
                           <div class="form-group">
                              <input type="text" name="title_{{ $i }}" id="title_{{ $i }}" 
                                 class="form-control" 
                                 value="{{ $service->{'title_'.$i} }}">
                           </div>
                           <div class="form-group">
                              <h5>Icon hiện tại</h5>
                              @if($service->{'icon_'.$i})
                                 <img src="{{ $service->{'icon_'.$i} }}" alt="" class="img-thumbnail mb-2" style="max-width: 100px;">
                              @else 
                                 <p class="text-muted">Chưa có icon</p>
                              @endif
                              <input type="file" name="icon_{{ $i }}" id="icon_{{ $i }}" class="form-control-file">
                           </div>
                           <div class="form-group">
                              <h5 for="content_{{ $i }}">Nội dung</h5>
                              <textarea name="content_{{ $i }}" id="content_{{ $i }}" rows="3" class="form-control">{{ $service->{'content_'.$i} }}</textarea>
                           </div>
                        </div>
                     </div>
                  @endfor
               </div>
            </div>


            {{-- NỘI DUNG DỊCH VỤ --}}
            <div class="form-group">
               <h5
                  class="d-flex justify-content-between align-items-center"
                  style="color: #030a36; background-color: #73c595; padding: 4px 12px; border-radius: 5px; cursor: pointer;"
                  data-toggle="collapse"
                  data-target="#contentService"
                  aria-expanded="false"
                  aria-controls="contentService"
               >
                  Nội dung dịch vụ (quy trình thực hiện)
                  <button
                        class="btn btn-sm btn-outline-primary"
                        type="button"
                        aria-label="Toggle Nội dung dịch vụ"
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
               <h5
                  class="d-flex justify-content-between align-items-center"
                  style="color: #030a36; background-color: #73c595; padding: 4px 12px; border-radius: 5px; cursor: pointer;"
                  data-toggle="collapse"
                  data-target="#contentPrice"
                  aria-expanded="false"
                  aria-controls="contentPrice"
               >
                  Nội dung báo giá Dich vụ
                  <button
                        class="btn btn-sm btn-outline-primary"
                        type="button"
                        aria-label="Toggle Nội dung báo giá"
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