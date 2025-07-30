@extends('admins.layouts.master')

@section('content')

<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
               <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <div class="form-group">
                     <label for="name">Tên người dùng</label>
                     <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                  </div>

                  <div class="form-group">
                     <label>Ảnh hiện tại</label><br>
                     <img src="{{ asset('storage/' . $user->avatar) }}" width="200" class="img-thumbnail mb-2">
                     <input type="hidden" name="avatar_old" value="{{ $user->avatar }}">
                  </div>

                  <div class="form-group">
                     <label for="avatar_new">Thay ảnh mới (tùy chọn)</label>
                     <input type="file" name="avatar_new" id="avatar_new" class="form-control-file">
                  </div>

                  <div class="form-group">
                     <label for="email">Level</label>
                     <select name="level" class="form-control">
                        @foreach ($levels as $key => $label)
                           <option value="{{ $key }}"
                           @if($key == $user->level) selected @endif
                           >
                              {{ $label }}
                        </option>
                        @endforeach
                     </select>
                  </div>

                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" class="form-control" value="{{ $user->email }}" name="email">
                  </div>

                  <div class="form-group">
                     <label for="password">Mật khẩu mới (nếu cần thay)</label>
                     <input type="password" name="password" class="form-control" placeholder="Để trống nếu không đổi">
                  </div>

                  <button type="submit" class="btn btn-primary">Cập nhật</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection