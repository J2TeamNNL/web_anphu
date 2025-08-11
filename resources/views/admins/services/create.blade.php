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
               <input type="text" name="slogan" id="slogan" class="form-control">
            </div>

            <div class="form-group">
               <label for="description">Mô tả</label>
               <textarea name="description" id="description" rows="6" class="form-control"></textarea>
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
                                 class="form-control">
                           </div>
                           <div class="form-group">
                              <h5>Icon</h5>
                              <input type="file" name="icon_{{ $i }}" id="icon_{{ $i }}" class="form-control-file">
                           </div>
                           <div class="form-group">
                              <h5 for="content_{{ $i }}">Nội dung</h5>
                              <textarea name="content_{{ $i }}" id="content_{{ $i }}" rows="3" class="form-control"></textarea>
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