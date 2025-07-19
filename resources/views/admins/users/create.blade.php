@extends('admins.layouts.master')

@section('content')

<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-body">
               <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                  @csrf
                  <h4 class="text-primary font-weight-bold text-center" >ĐĂNG KÝ THÀNH VIÊN QUẢN LÝ</h4>
                  <div class="form-group">
                     <label for="name">Tên người dùng</label>
                     <input type="text" class="form-control" name="name" required>
                  </div>

                  <div class="form-group">
                     <label for="name">Avatar</label>
                     <input type="file" class="form-control" name="avatar">
                  </div>

                  <div class="form-group">
                     <label for="email">Level</label>
                     <select name="level" class="form-control">
                        @foreach ($levels as $key => $label)
                           <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                     </select>
                  </div>

                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" class="form-control" name="email">
                  </div>

                  <div class="form-group">
                     <label for="password">Mật khẩu</label>
                     <input type="password" class="form-control" name="password" required>
                  </div>

                  <div class="form-group">
                     <label for="password_confirmation">Nhập lại mật khẩu</label>
                     <input type="password" class="form-control" name="password_confirmation" required>
                  </div>

                  <button type="submit" class="btn btn-success btn-block">Đăng ký</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection