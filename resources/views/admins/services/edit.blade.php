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
               <h4 for="" class='text-primary'>Đoạn nội dung 1</h4>
            </div>
            <div class="form-group">
               <h5 for="name">Tiêu đề</h5>
               <input
                  type="text"
                  name="title_1"
                  id="title_1"
                  class="form-control"
                  value="{{ $service->title_1 }}"
               >
            </div>

            <div class="form-group">
               <h5>Icon hiện tại</h5><br>
               @if ($service->icon_1)
                  <img
                     src="{{ $service->icon_1 }}"
                     alt="{{ $service->title_1 }}"
                     class="img-thumbnail"
                  >
               @else
                  <p class="text-muted">Không icon</p>
               @endif
               <input type="hidden" name="icon_1_old" value="{{ $service->icon_1 }}">
            </div>

            <div class="form-group">
               <h5 for="logo">Thay icon mới (tùy chọn)</h5>
               <input type="file" name="icon_1" id="icon_1" class="form-control-file">
            </div>

            <div class="form-group">
               <h5 for="description">Nội dung</h5>
               <textarea
                  name="content_1"
                  id="content_1"
                  rows="6"
                  class="form-control"
               >
                  {{ $service->content_1 }}
               </textarea>
            </div>

            {{-- NỘI DUNG 2 --}}
            <div class="form-group">
               <h4 for="" class='text-primary'>Đoạn nội dung 2</h4>
            </div>
            <div class="form-group">
               <h5 for="name">Tiêu đề</h5>
               <input
                  type="text"
                  name="title_2"
                  id="title_2"
                  class="form-control"
                  value="{{ $service->title_2 }}"
               >
            </div>

            <div class="form-group">
               <h5>Icon hiện tại</h5><br>
               @if ($service->icon_1)
                  <img
                     src="{{ $service->icon_2 }}"
                     alt="{{ $service->title_2 }}"
                     class="img-thumbnail"
                  >
               @else
                  <p class="text-muted">Không icon</p>
               @endif
               <input type="hidden" name="icon_2_old" value="{{ $service->icon_2 }}">
            </div>

            <div class="form-group">
               <h5 for="logo">Thay icon mới (tùy chọn)</h5>
               <input type="file" name="icon_2" id="icon_2" class="form-control-file">
            </div>

            <div class="form-group">
               <h5 for="description">Nội dung</h5>
               <textarea
                  name="content_2"
                  id="content_2"
                  rows="6"
                  class="form-control"
               >
                  {{ $service->content_2 }}
               </textarea>
            </div>

            {{-- NỘI DUNG 3 --}}
            <div class="form-group">
               <h4 for="" class='text-primary'>Đoạn nội dung 3</h4>
            </div>
            <div class="form-group">
               <h5 for="name">Tiêu đề</h5>
               <input
                  type="text"
                  name="title_3"
                  id="title_3"
                  class="form-control"
                  value="{{ $service->title_3 }}"
               >
            </div>

            <div class="form-group">
               <h5>Icon hiện tại</h5><br>
               @if ($service->icon_3)
                  <img
                     src="{{ $service->icon_3 }}"
                     alt="{{ $service->title_3 }}"
                     class="img-thumbnail"
                  >
               @else
                  <p class="text-muted">Không icon</p>
               @endif
               <input type="hidden" name="icon_3_old" value="{{ $service->icon_3 }}">
            </div>

            <div class="form-group">
               <h5 for="logo">Thay icon mới (tùy chọn)</h5>
               <input type="file" name="icon_3" id="icon_3" class="form-control-file">
            </div>

            <div class="form-group">
               <h5 for="description">Nội dung</h5>
               <textarea
                  name="content_3"
                  id="content_3"
                  rows="6"
                  class="form-control"
               >
                  {{ $service->content_3 }}
               </textarea>
            </div>

            {{-- NỘI DUNG 4 --}}
            <div class="form-group">
               <h4 for="" class='text-primary'>Đoạn nội dung 4</h4>
            </div>
            <div class="form-group">
               <h5 for="name">Tiêu đề</h5>
               <input
                  type="text"
                  name="title_4"
                  id="title_4"
                  class="form-control"
                  value="{{ $service->title_4 }}"
               >
            </div>

            <div class="form-group">
               <h5>Icon hiện tại</h5><br>
               @if ($service->icon_4)
                  <img
                     src="{{ $service->icon_4 }}"
                     alt="{{ $service->title_4 }}"
                     class="img-thumbnail"
                  >
               @else
                  <p class="text-muted">Không icon</p>
               @endif
               <input type="hidden" name="icon_4_old" value="{{ $service->icon_4 }}">
            </div>

            <div class="form-group">
               <h5 for="logo">Thay icon mới (tùy chọn)</h5>
               <input type="file" name="icon_4" id="icon_4" class="form-control-file">
            </div>

            <div class="form-group">
               <h5 for="description">Nội dung</h5>
               <textarea
                  name="content_4"
                  id="content_4"
                  rows="6"
                  class="form-control"
               >
                  {{ $service->content_4 }}
               </textarea>
            </div>

            <div class="text-right">
               <button type="submit" class="btn btn-warning font-weight-bold">Cập nhập Dịch vụ</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection