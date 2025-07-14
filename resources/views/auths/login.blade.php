@extends('auths.layouts.master')

@section('auths.login')
<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="col-md-6">
         <div class="card">
            <div class="card-header">Đăng nhập</div>
            <div class="card-body">
               <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" class="form-control" name="email" required autofocus>
                  </div>

                  <div class="form-group">
                     <label for="password">Mật khẩu</label>
                     <input type="password" class="form-control" name="password" required>
                  </div>

                  <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
               </form>
            </div>
            <div class="card-footer">
               <a href="{{ route('register') }}">
                  <button type="submit" class="btn btn-warning btn-block">Đăng ký</button>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
