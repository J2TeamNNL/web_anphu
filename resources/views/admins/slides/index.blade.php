@extends('admins.layouts.master')

@section('title', 'Quản lý Slides')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quản lý Slides</h3>
                </div>

                <div class="card-body">
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="slideTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="desktop-tab" data-toggle="tab" href="#desktop" role="tab" aria-controls="desktop" aria-selected="true">
                                <i class="fas fa-desktop"></i> Desktop (16:9)
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="mobile-tab" data-toggle="tab" href="#mobile" role="tab" aria-controls="mobile" aria-selected="false">
                                <i class="fas fa-mobile-alt"></i> Mobile (9:16)
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-3" id="slideTabContent">
                        <!-- Desktop Tab -->
                        <div class="tab-pane fade show active" id="desktop" role="tabpanel">
                            <!-- Desktop Upload Form -->
                            <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data" id="desktop-form">
                                @csrf
                                <input type="hidden" name="is_mobile" value="0">
                                <div class="row mb-4">
                                    <div class="col-md-8">
                                        <label class="form-label fw-bold">Thêm slide Desktop (1920×1080px):</label>
                                        <input type="file" 
                                               name="image"
                                               accept="image/*"
                                               class="form-control" 
                                               id="desktop-input"
                                               required>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <button type="submit" class="btn btn-success" id="desktop-btn" disabled>
                                            <i class="fas fa-upload"></i> Upload Desktop
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <!-- Desktop Slides Table -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="100">Ảnh</th>
                                        <th>Thứ tự</th>
                                        <th width="100">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($slides->where('is_mobile', false) as $slide)
                                        <tr>
                                            <td>
                                                <img src="{{ $slide->media->file_path }}" 
                                                        class="img-thumbnail" 
                                                        style="width: 80px; height: 45px; object-fit: cover;">
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <form action="{{ route('admin.slides.update', $slide->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="is_mobile" value="1">
                                                        <button type="submit" class="btn btn-sm btn-info" title="Chuyển sang Mobile">
                                                            <i class="fas fa-mobile-alt"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.slides.destroy', $slide->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Xóa slide">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">
                                                Chưa có slide Desktop nào.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Tab -->
                        <div class="tab-pane fade" id="mobile" role="tabpanel">
                            <!-- Mobile Upload Form -->
                            <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data" id="mobile-form">
                                @csrf
                                <input type="hidden" name="is_mobile" value="1">
                                <div class="row mb-4">
                                    <div class="col-md-8">
                                        <label class="form-label fw-bold">Thêm slide Mobile (1080×1920px):</label>
                                        <input type="file" 
                                               name="image"
                                               accept="image/*"
                                               class="form-control" 
                                               id="mobile-input"
                                               required>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <button type="submit" class="btn btn-info" id="mobile-btn" disabled>
                                            <i class="fas fa-upload"></i> Upload Mobile
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <!-- Mobile Slides Table -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="100">Ảnh</th>
                                        <th>Thứ tự</th>
                                        <th width="100">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($slides->where('is_mobile', true) as $slide)
                                        <tr>
                                            <td>
                                                <img src="{{ $slide->media->file_path }}" 
                                                        class="img-thumbnail" 
                                                        style="width: 45px; height: 80px; object-fit: cover;">
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <form action="{{ route('admin.slides.update', $slide->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="is_mobile" value="0">
                                                        <button type="submit" class="btn btn-sm btn-success" title="Chuyển sang Desktop">
                                                            <i class="fas fa-desktop"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.slides.destroy', $slide->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Xóa slide">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">
                                                Chưa có slide Mobile nào.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Enable desktop upload button when file is selected
    $('#desktop-input').change(function() {
        const file = this.files[0];
        if (file) {
            $('#desktop-btn').prop('disabled', false);
        } else {
            $('#desktop-btn').prop('disabled', true);
        }
    });

    // Enable mobile upload button when file is selected
    $('#mobile-input').change(function() {
        const file = this.files[0];
        if (file) {
            $('#mobile-btn').prop('disabled', false);
        } else {
            $('#mobile-btn').prop('disabled', true);
        }
    });
});
</script>
@endpush
