@extends('auths.layouts.master')

@section('content')
<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
               <form method="POST" action="{{ route('auths.process_register') }}">
                  @csrf

                  <div class="form-group">
                     <label for="name">Tên người dùng</label>
                     <input type="text" class="form-control" name="name" required>
                  </div>

                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" class="form-control" name="email" required>
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
