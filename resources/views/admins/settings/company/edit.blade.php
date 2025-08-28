@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
    <h4 class="mb-4 text-warning">Cập nhật thông tin công ty</h4>

    <form
        action="{{ route('admin.settings.company.update') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        {{-- THÔNG TIN CHUNG --}}
        <div class="form-group">
            <h4 class="font-weight-bold text-primary">Thông tin chung</h4>
            <hr>
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Tên công ty</label>
            <input
                type="text"
                name="company_name"
                class="form-control"
                value="{{ old('company_name', $setting->company_name) }}"
            >
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Tên thương hiệu (Brand)</label>
            <input
                type="text"
                name="company_brand"
                class="form-control"
                value="{{ old('company_brand', $setting->company_brand) }}"
            >
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Tên quốc tế</label>
            <input
                type="text"
                name="international_name"
                class="form-control"
                value="{{ old('international_name', $setting->international_name) }}"
            >
        </div>

        <div class="form-group">
            <label for="established_date" class="form-label font-weight-bold">
                Ngày thành lập <span class="text-muted">(dd/mm/yyyy)</span>
            </label>

            <input 
                type="date" 
                name="established_date"
                class="form-control @error('established_date') is-invalid @enderror"
                id="established_date"
                value="{{ old('established_date', $setting->established_date ? $setting->established_date->format('Y-m-d') : '') }}"
                max="{{ now()->toDateString() }}"
            >

            @error('established_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="tax_code" class="form-label font-weight-bold">
                Mã số thuế
            </label>
            <input 
                type="text" 
                class="form-control @error('tax_code') is-invalid @enderror" 
                id="tax_code" 
                name="tax_code" 
                placeholder="Nhập mã số thuế (10 hoặc 13 số)"
                value="{{ old('tax_code', $setting->tax_code ?? '') }}"
            >
            @error('tax_code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror    
        </div>

        <div class="form-group">
            <label for="director" class="form-label font-weight-bold">
                Người đại diện
            </label>
            <input 
                type="text" 
                class="form-control @error('director') is-invalid @enderror" 
                id="director" 
                name="director" 
                placeholder="Nhập người đại diện"
                value="{{ old('director', $setting->director ?? '') }}"
            >
            @error('director')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror    
        </div>

        <div class="form-group">
            <label>Ảnh chứng chỉ (tối đa 6 ảnh)</label>
            <input type="file" name="certificates[]" class="form-control" multiple accept="image/*">
            @if(!empty($setting->certificates))
                <div class="row mt-2">
                    @foreach($setting->certificates as $img)
                        <div class="col-md-3 mb-2">
                            <img src="{{ $img }}" class="img-fluid rounded shadow-sm">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>



        {{-- THÔNG TIN LIÊN HỆ --}}
        <div class="form-group">
            <h4 class="font-weight-bold text-primary">Thông tin liên hệ</h4>
            <hr>
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Email</label>
            <input
                type="email"
                name="company_email"
                class="form-control"
                value="{{ old('company_email', $setting->company_email) }}"
            >
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Điện thoại 1 (Zalo)</label>
            <input
                type="text"
                name="company_phone_1"
                class="form-control"
                value="{{ old('company_phone_1', $setting->company_phone_1) }}"
            >
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Điện thoại 2 (Hotline)</label>
            <input
                type="text"
                name="company_phone_2"
                class="form-control"
                value="{{ old('company_phone_2', $setting->company_phone_2) }}"
            >
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Địa chỉ 1</label>
            <textarea name="company_address_1" class="form-control">{{ old('company_address_1', $setting->company_address_1) }}
            </textarea>
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Địa chỉ 2</label>
            <textarea name="company_address_2" class="form-control">{{ old('company_address_2', $setting->company_address_2) }}
            </textarea>
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Giờ làm việc</label>
            <input
                type="text"
                name="working_hours"
                class="form-control"
                value="{{ old('working_hours', $setting->working_hours) }}"
            >
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Google Map 1</label>
            <input
                type="text"
                name="google_map[map_1][embed_url]"
                class="form-control"
                value="{{ old('google_map.map_1.embed_url', $setting->google_map['map_1']['embed_url'] ?? '') }}"
            >
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Google Map 2</label>
            <input
                type="text"
                name="google_map[map_2][embed_url]"
                class="form-control"
                value="{{ old('google_map.map_2.embed_url', $setting->google_map['map_2']['embed_url'] ?? '') }}"
            >
        </div>


        {{-- LOGO, MẠNG XÃ HỘI --}}
        <div class="form-group">
            <h4 class="font-weight-bold text-primary">Logo, mạng xã hội</h4>
            <hr>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Logo công ty (nếu muốn thay)</label>
            <input type="file" name="company_logo" class="form-control-file">

            @if (!empty($setting->company_logo))
                <div class="mt-3">
                    <label class="font-weight-bold">Logo hiện tại:</label>
                    <br>
                    <img 
                        src="{{ $setting->company_logo }}" 
                        alt="Logo công ty" 
                        style="max-height: 80px; border: 1px solid #ddd; padding: 4px; background: #fff;"
                        onerror="this.onerror=null;this.src='/images/default-logo.png';"
                    >
                </div>
            @else
                <p class="mt-2 text-muted">Chưa có logo</p>
            @endif
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Facebook Link</label>
            <input type="url" name="facebook_link" class="form-control" 
                value="{{ old('facebook_link', $setting->social_links['facebook'] ?? '') }}" 
                placeholder="https://www.facebook.com/share/16aNn1KZ37/?mibextid=wwXIfr">
        </div>

        <div class="form-group">
            <label class="font-weight-bold">YouTube Link</label>
            <input type="url" name="youtube_link" class="form-control" 
                value="{{ old('youtube_link', $setting->social_links['youtube'] ?? '') }}" 
                placeholder="https://www.youtube.com/channel/xxxx">
        </div>

        <div class="form-group">
            <label class="font-weight-bold">TikTok Link</label>
            <input type="url" name="tiktok_link" class="form-control" 
                value="{{ old('tiktok_link', $setting->social_links['tiktok'] ?? '') }}" 
                placeholder="https://www.tiktok.com/@anphudesign">
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Instagram Link</label>
            <input type="url" name="instagram_link" class="form-control" 
                value="{{ old('instagram_link', $setting->social_links['instagram'] ?? '') }}" 
                placeholder="https://www.instagram.com/@xxxx">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection