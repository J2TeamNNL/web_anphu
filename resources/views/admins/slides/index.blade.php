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
                    <!-- Upload Form -->
                    <form action="{{ route('slides.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <input type="file" 
                                       name="images[]" 
                                       multiple 
                                       accept="image/*"
                                       class="form-control" 
                                       id="images-input"
                                       required>
                                <small class="text-muted">Chọn ảnh để thay thế toàn bộ slides</small>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-danger btn-block">
                                    <i class="fas fa-save"></i> Save
                                </button>
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
                                @if($slide->media->first())
                                    <tr data-index="{{ $index }}">
                                        <td>
                                            <img src="{{ $slide->media->first()->file_path }}" 
                                                 class="img-thumbnail" 
                                                 style="width: 80px; height: 60px; object-fit: cover;">
                                        </td>
                                        <td>Slide {{ $index + 1 }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger remove-slide">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
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
    // Handle file selection
    $('#images-input').change(function() {
        const files = this.files;
        const tbody = $('#slides-table tbody');
        
        // Clear existing rows
        tbody.empty();
        
        if (files.length === 0) {
            tbody.append(`
                <tr id="no-slides">
                    <td colspan="3" class="text-center text-muted">
                        Chưa có slide nào. Chọn ảnh để tạo slides.
                    </td>
                </tr>
            `);
            return;
        }
        
        // Add preview rows
        Array.from(files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                tbody.append(`
                    <tr data-index="${index}">
                        <td>
                            <img src="${e.target.result}" 
                                 class="img-thumbnail" 
                                 style="width: 80px; height: 60px; object-fit: cover;">
                        </td>
                        <td>${file.name}</td>
                        <td>
                            <button class="btn btn-sm btn-danger remove-slide">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `);
            };
            reader.readAsDataURL(file);
        });
    });
    
    // Handle remove slide
    $(document).on('click', '.remove-slide', function() {
        $(this).closest('tr').remove();
        
        // Check if no rows left
        if ($('#slides-table tbody tr').length === 0) {
            $('#slides-table tbody').append(`
                <tr id="no-slides">
                    <td colspan="3" class="text-center text-muted">
                        Chưa có slide nào. Chọn ảnh để tạo slides.
                    </td>
                </tr>
            `);
        }
    });
});
</script>
@endpush
