@extends('auths.layouts.master')

@section('content')
<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
               <form method="POST" action="{{ route('auths.process_login') }}">
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
         </div>
      </div>
   </div>
</div>
@endsection
