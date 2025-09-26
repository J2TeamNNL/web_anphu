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
                    <!-- Add Slide Form -->
                    <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data" id="slide-form">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <label class="form-label fw-bold">Thêm slide mới:</label>
                                <input type="file" 
                                       name="image"
                                       accept="image/*"
                                       class="form-control" 
                                       id="image-input"
                                       required>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <!-- Preview Table -->
                    <h5>Preview:</h5>
                    <table class="table table-bordered" id="slides-table">
                        <thead>
                            <tr>
                                <th width="100">Ảnh</th>
                                <th>Tên file</th>
                                <th width="100">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($slides as $index => $slide)
                                <tr data-index="{{ $index }}">
                                    <td>
                                        <img src="{{ $slide->media->file_path }}" 
                                                class="img-thumbnail" 
                                                style="width: 80px; height: 60px; object-fit: cover;">
                                    </td>
                                    <td>Slide {{ $index + 1 }}</td>
                                    <td>
                                        <form action="{{ route('admin.slides.destroy', $slide->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger remove-slide">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr id="no-slides">
                                    <td colspan="3" class="text-center text-muted">
                                        Chưa có slide nào. Chọn ảnh để tạo slides.
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
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto submit form when file is selected
    $('#image-input').change(function() {
        const file = this.files[0];
        if (file) {
            // Update status
            $('#upload-status').html('<i class="fas fa-spinner fa-spin text-primary"></i> Đang upload...');
            
            // Submit form
            $('#slide-form').submit();
        }
    });
});
</script>
@endpush
