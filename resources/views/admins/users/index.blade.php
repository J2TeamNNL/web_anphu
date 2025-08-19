@extends('admins.layouts.master')

@section('content')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">Danh sách Người quản lý</h4>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">+ Thêm người quản lý</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form class="mb-3" method="GET">
                <div class="form-row">
                    <div class="col-md-4 mb-2">
                        <input
                            type="text"
                            name="q"
                            value="{{ old('q', $search ?? '') }}"
                            class="form-control"
                            placeholder="Tìm theo Tên, Email"
                        >
                    </div>

                    <div class="col-md-2 mb-2">
                        <button class="btn btn-primary w-100" type="submit">
                            <i class="fa fa-search mr-1"></i> Tìm kiếm
                        </button>
                    </div>

                    <div class="col-md-1 mb-2">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
                    </div>
                </div>
            </form>

            <div>
                <table class="table table-bordered table-hover text-center">
                    <thead style="background-color: #242323c0; color: #C9B037">
                        <tr>
                            <th>#</th>
                            <th>Tên người quản lý</th>
                            <th>Cấp độ</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->level }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(auth()->user()->level == 1) 
                                        <form action="{{ route('admin.users.resetPassword', $user) }}" 
                                            method="POST" 
                                            class="d-inline"
                                            onsubmit="return confirm('Bạn có chắc muốn reset mật khẩu cho {{ $user->name }}?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning">
                                                Reset mật khẩu
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">Ẩn vì bảo mật</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary mb-1">Sửa</a>
                                    
                                    @if(auth()->user()->level == 1)
                                    <form
                                        action="{{ route('admin.users.destroy', $user) }}"
                                        method="POST"
                                        onsubmit="return confirm('Bạn chắc chắn muốn xoá?')"
                                        class="d-inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-muted">Chưa có người dùng nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="mt-3 d-flex justify-content-center">
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $userss->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".toggle-password").forEach(button => {
            button.addEventListener("click", function () {
                const userId = this.getAttribute("data-user-id");
                const passwordField = document.getElementById("password-" + userId);

                if (passwordField.classList.contains("d-none")) {
                    // Hiện mật khẩu (ở đây bạn chưa có dữ liệu mật khẩu thật, nên tạm hiển thị placeholder)
                    passwordField.classList.remove("d-none");
                    this.textContent = "Ẩn mật khẩu";
                } else {
                    // Ẩn mật khẩu
                    passwordField.classList.add("d-none");
                    this.textContent = "Hiện mật khẩu";
                }
            });
        });
    });
</script>
@endpush