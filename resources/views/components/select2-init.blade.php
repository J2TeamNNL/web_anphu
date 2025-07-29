{{-- Select2 Component --}}
@props([
    'selector' => '.select2',
    'placeholder' => 'Chọn danh mục...',
    'allowClear' => true,
    'width' => '100%',
    'multiple' => false
])

@once
    @push('styles')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    @endpush

    @push('scripts')
    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush
@endonce

@push('scripts')
<script>
    // Select2 initialization with custom options
    $(document).ready(function() {
        if (typeof $ !== 'undefined' && typeof $.fn.select2 !== 'undefined') {
            $('{{ $selector }}').select2({
                placeholder: '{{ $placeholder }}',
                allowClear: {{ $allowClear ? 'true' : 'false' }},
                width: '{{ $width }}',
                multiple: {{ $multiple ? 'true' : 'false' }}
            });
            console.log('Select2 initialized on: {{ $selector }}');
        } else {
            console.warn('Select2 or jQuery not found.');
        }
    });
</script>
@endpush
