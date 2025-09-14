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

        {{-- THÔNG TIN CÔNG TY --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-building"></i> Thông tin công ty</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Tên công ty</label>
                            <input
                                type="text"
                                name="company_name"
                                class="form-control"
                                value="{{ old('company_name', $setting->company_name) }}"
                                placeholder="Tên đầy đủ của công ty"
                            >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Tên thương hiệu (Brand)</label>
                            <input
                                type="text"
                                name="company_brand"
                                class="form-control"
                                value="{{ old('company_brand', $setting->company_brand) }}"
                                placeholder="Tên thương hiệu ngắn gọn"
                            >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Tên quốc tế</label>
                            <input
                                type="text"
                                name="international_name"
                                class="form-control"
                                value="{{ old('international_name', $setting->international_name) }}"
                                placeholder="Tên tiếng Anh"
                            >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Người đại diện</label>
                            <input 
                                type="text" 
                                class="form-control @error('director') is-invalid @enderror" 
                                name="director" 
                                placeholder="Tên người đại diện pháp luật"
                                value="{{ old('director', $setting->director ?? '') }}"
                            >
                            @error('director')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror    
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- GIẤY PHÉP KINH DOANH --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-certificate"></i> Giấy phép kinh doanh</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Số giấy phép</label>
                            <input
                                type="text"
                                name="license_number"
                                class="form-control"
                                value="{{ old('license_number', $setting->license_number) }}"
                                placeholder="Số ĐKKD"
                            >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Cơ quan cấp</label>
                            <input
                                type="text"
                                name="license_authority"
                                class="form-control"
                                value="{{ old('license_authority', $setting->license_authority) }}"
                                placeholder="Sở KH&ĐT..."
                            >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Ngày cấp</label>
                            <input
                                type="date"
                                name="license_date"
                                class="form-control"
                                value="{{ old('license_date', $setting->license_date->toDateString()) }}"
                                placeholder="dd/mm/yyyy"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- THÔNG TIN LIÊN HỆ --}}
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-phone"></i> Thông tin liên hệ</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Company Email</label>
                            <input
                                type="email"
                                name="company_email"
                                class="form-control"
                                value="{{ old('company_email', $setting->company_email) }}"
                                placeholder="contact@company.com"
                            >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Điện thoại 1 (Zalo)</label>
                            <input
                                type="text"
                                name="company_phone_1"
                                class="form-control"
                                value="{{ old('company_phone_1', $setting->company_phone_1) }}"
                                placeholder="0xxx xxx xxx"
                            >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Điện thoại 2 (Hotline)</label>
                            <input
                                type="text"
                                name="company_phone_2"
                                class="form-control"
                                value="{{ old('company_phone_2', $setting->company_phone_2) }}"
                                placeholder="0xxx xxx xxx"
                            >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Địa chỉ 1</label>
                            <textarea 
                                name="company_address_1" 
                                class="form-control" 
                                rows="3"
                                placeholder="Địa chỉ trụ sở chính"
                            >{{ old('company_address_1', $setting->company_address_1) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Địa chỉ 2</label>
                            <textarea 
                                name="company_address_2" 
                                class="form-control" 
                                rows="3"
                                placeholder="Địa chỉ chi nhánh (nếu có)"
                            >{{ old('company_address_2', $setting->company_address_2) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Giờ làm việc</label>
                    <input
                        type="text"
                        name="working_hours"
                        class="form-control"
                        value="{{ old('working_hours', $setting->working_hours) }}"
                        placeholder="Thứ 2 - Thứ 6: 8:00 - 17:00"
                    >
                </div>
            </div>
        </div>

        {{-- BẢN ĐỒ --}}
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Bản đồ Google Maps</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="font-weight-bold">Google Map 1 (Embed URL)</label>
                    <input
                        type="text"
                        name="google_map[embed_url]"
                        class="form-control"
                        value="{{ old('google_map.embed_url', $setting->google_map['embed_url'] ?? '') }}"
                        placeholder="https://www.google.com/maps/embed?pb=..."
                    >
                    <small class="text-muted">Lấy từ Google Maps > Chia sẻ > Nhúng bản đồ</small>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Google Map 2 (Embed URL)</label>
                    <input
                        type="text"
                        name="google_map_2[embed_url]"
                        class="form-control"
                        value="{{ old('google_map_2.embed_url', $setting->google_map_2['embed_url'] ?? '') }}"
                        placeholder="https://www.google.com/maps/embed?pb=... (cho địa chỉ 2)"
                    >
                    <small class="text-muted">Bản đồ cho địa chỉ thứ 2 (nếu có)</small>
                </div>
            </div>
        </div>

        {{-- LOGO & HÌNH ẢNH --}}
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="fas fa-image"></i> Logo & Hình ảnh</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Logo chính</label>
                            <input type="file" name="logo_main" class="form-control-file" accept="image/*">
                            @if (!empty($setting->logo_main))
                                <div class="mt-2">
                                    <img src="{{ asset($setting->logo_main) }}" alt="Logo chính" style="max-height: 60px;">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Logo footer</label>
                            <input type="file" name="logo_footer" class="form-control-file" accept="image/*">
                            @if (!empty($setting->logo_footer))
                                <div class="mt-2">
                                    <img src="{{ asset($setting->logo_footer) }}" alt="Logo footer" style="max-height: 60px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Favicon</label>
                            <input type="file" name="logo_favicon" class="form-control-file" accept="image/*">
                            @if (!empty($setting->logo_favicon))
                                <div class="mt-2">
                                    <img src="{{ asset($setting->logo_favicon) }}" alt="Favicon" style="max-height: 32px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Ảnh chứng chỉ</label>
                    <input type="file" name="certificates[]" class="form-control" multiple accept="image/*">
                    @if(!empty($setting->certificates))
                        <div class="row mt-2">
                            @foreach($setting->certificates as $img)
                                <div class="col-md-3 mb-2">
                                    <img src="{{ asset($img) }}" class="img-fluid rounded shadow-sm" style="max-height: 120px;">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- MẠNG XÃ HỘI --}}
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="fas fa-share-alt"></i> Mạng xã hội</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold"><i class="fab fa-facebook text-primary"></i> Facebook</label>
                            <input type="url" name="social_links[facebook]" class="form-control" 
                                value="{{ old('social_links.facebook', $setting->social_links['facebook'] ?? '') }}" 
                                placeholder="https://www.facebook.com/yourpage">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold"><i class="fab fa-youtube text-danger"></i> YouTube</label>
                            <input type="url" name="social_links[youtube]" class="form-control" 
                                value="{{ old('social_links.youtube', $setting->social_links['youtube'] ?? '') }}" 
                                placeholder="https://www.youtube.com/channel/xxxx">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold"><i class="fab fa-tiktok text-dark"></i> TikTok</label>
                            <input type="url" name="social_links[tiktok]" class="form-control" 
                                value="{{ old('social_links.tiktok', $setting->social_links['tiktok'] ?? '') }}" 
                                placeholder="https://www.tiktok.com/@username">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold"><img src="{{ asset('assets/img/logo/logo_zalo.png') }}" alt="Zalo" style="height: 30px;"> Zalo</label>
                            <input type="url" name="social_links[zalo]" class="form-control" 
                                value="{{ old('social_links.zalo', $setting->social_links['zalo'] ?? '') }}" 
                                placeholder="https://www.zalo.me/username">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-save"></i> Cập nhật thông tin
            </button>
        </div>
    </form>
</div>
@endsection