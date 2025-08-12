@extends('admins.layouts.master')

@section('content')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">Danh sách Dự án</h4>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">+ Thêm người quản lý</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form class="mb-3" method="GET">
                <div class="form-row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="q" value="{{ old('q', $search ?? '') }}" class="form-control" placeholder="Tìm theo Tên, Email">
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
                            <th>Avatar</th>
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
                                <td>
                                    @if ($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" width="100" class="img-thumbnail mb-2">
                                    @else
                                        NA
                                    @endif
                                </td>
                                <td>{{ $user->level }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-secondary toggle-password" data-user-id="{{ $user->id }}">
                                        Hiện mật khẩu
                                    </button>
                                    <input type="text" class="form-control form-control-sm mt-1 d-none password-field" id="password-{{ $user->id }}" value="******" readonly>
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary mb-1">Sửa</a>
                                    
                                    @if(session('level') == 1)
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá?')" class="d-inline">
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
