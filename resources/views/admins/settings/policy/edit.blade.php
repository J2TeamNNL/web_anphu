@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
    <h3 class="mb-3">Cài đặt chính sách công ty</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="policy-content-viewer" style="height: 900px; overflow-y: auto; padding: 15px;">
                {!! $policyContent !!}
            </div>

            <button id="btn-edit-policy" class="btn btn-warning mt-3">Chỉnh sửa chính sách</button>

            {{-- Form xác nhận mật khẩu --}}
            <form
                id="form-confirm-password"
                style="display: none;"
            >
                @csrf
                <div class="form-group mb-3">
                    <label for="admin_password">Nhập mật khẩu quản trị viên để chỉnh sửa:</label>
                    <input
                        type="password"
                        class="form-control"
                        id="admin_password"
                        name="admin_password"
                        required
                        placeholder="Mật khẩu quản trị viên"
                    >
                </div>
                <button type="submit" class="btn btn-primary">Xác nhận</button>
                <button type="button" class="btn btn-secondary" id="btn-cancel-confirm">Hủy bỏ</button>
            </form>

            <form
                id="form-edit-policy"
                action="{{ route('admin.settings.company.updatePolicy') }}"
                method="POST"
                enctype="multipart/form-data"
                style="display: none;"
            >
                @csrf
                @method('PUT')

                {{-- Input ẩn để truyền mật khẩu admin --}}
                <input type="hidden" name="admin_password" id="admin_password_hidden">

                {{-- Component Quill --}}
                <div class="form-group mb-3">
                    <x-editor 
                        selector="#quill-editor"
                        uploadTable="company_settings_policies"
                        toolbar="full"
                        height="400px" {{-- Nhỏ hơn để tổng form không quá cao --}}
                        placeholder="Nhập chính sách công ty"
                        :uploadRoute="route('admin.media.uploadImage')"
                        :content="old('policy_content', $policyContent ?? '')"
                        textareaName="policy_content"
                    />
                </div>

                <button type="submit" class="btn btn-primary">Cập nhập</button>
                <button type="button" class="btn btn-secondary" id="btn-cancel-edit">Hủy bỏ</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnEdit = document.getElementById('btn-edit-policy');
        const formConfirmPassword = document.getElementById('form-confirm-password');
        const btnCancelConfirm = document.getElementById('btn-cancel-confirm');
        const formEdit = document.getElementById('form-edit-policy');
        const btnCancelEdit = document.getElementById('btn-cancel-edit');
        const viewer = document.getElementById('policy-content-viewer');

        btnEdit.addEventListener('click', () => {
            // Ẩn viewer và nút chỉnh sửa
            viewer.style.display = 'none';
            btnEdit.style.display = 'none';

            // Hiện form xác nhận mật khẩu
            formConfirmPassword.style.display = 'block';
        });

        btnCancelConfirm.addEventListener('click', () => {
            // Hiện lại viewer và nút chỉnh sửa
            viewer.style.display = 'block';
            btnEdit.style.display = 'inline-block';

            // Ẩn form xác nhận mật khẩu
            formConfirmPassword.style.display = 'none';
        });

        formConfirmPassword.addEventListener('submit', (e) => {
            e.preventDefault();
            // Xác nhận mật khẩu
            // Nếu xác nhận thành công thì hiện form chỉnh sửa
            const adminPassword = document.getElementById('admin_password').value;
            document.getElementById('admin_password_hidden').value = adminPassword;
            formEdit.style.display = 'block';
            formConfirmPassword.style.display = 'none';

            // Gọi phương thức updatePolicy() để kiểm tra mật khẩu
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('admin.settings.company.updatePolicy') }}', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.send('admin_password=' + adminPassword);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Nếu mật khẩu đúng, thì hiện form chỉnh sửa
                        formEdit.style.display = 'block';
                        formConfirmPassword.style.display = 'none';
                    } else {
                        // Nếu mật khẩu sai, thì hiện thông báo lỗi
                        alert('Mật khẩu quản trị viên không đúng.');
                    }
                }
            };
        });

        btnCancelEdit.addEventListener('click', () => {
            // Hiện lại viewer và nút chỉnh sửa
            viewer.style.display = 'block';
            btnEdit.style.display = 'inline-block';

            // Ẩn form chỉnh sửa
            formEdit.style.display = 'none';
        });
    });
</script>
@endpush