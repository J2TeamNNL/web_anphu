@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
    <h5 class="mb-4">Cập nhật thông tin công ty</h5>

    <form action="{{ route('admin.settings.company.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="font-weight-bold">Tên công ty</label>
            <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $setting->company_name) }}">
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Email</label>
            <input type="email" name="company_email" class="form-control" value="{{ old('company_email', $setting->company_email) }}">
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Điện thoại 1 (Zalo)</label>
            <input type="text" name="company_phone_1" class="form-control" value="{{ old('company_phone_1', $setting->company_phone_1) }}">
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Điện thoại 2 (Hotline)</label>
            <input type="text" name="company_phone_2" class="form-control" value="{{ old('company_phone_2', $setting->company_phone_2) }}">
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Địa chỉ 1</label>
            <textarea name="company_address_1" class="form-control">{{ old('company_address_1', $setting->company_address_1) }}</textarea>
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Địa chỉ 2</label>
            <textarea name="company_address_2" class="form-control">{{ old('company_address_2', $setting->company_address_2) }}</textarea>
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Logo công ty (nếu muốn thay)</label>
            <input type="file" name="company_logo" class="form-control-file">
            @if ($setting->company_logo)
                <p class="mt-2">Logo hiện tại:</p>
                <img src="{{ asset('storage/' . $setting->company_logo) }}" alt="Logo" style="max-height: 80px;">

            @endif
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Giờ làm việc</label>
            <input type="text" name="working_hours" class="form-control" value="{{ old('working_hours', $setting->working_hours) }}">
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Social Links (JSON format)</label>
            <textarea name="social_links" class="form-control" rows="4">{{ old('social_links', json_encode($setting->social_links)) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
