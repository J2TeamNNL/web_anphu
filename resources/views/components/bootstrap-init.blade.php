{{-- Bootstrap Components Initialization --}}
@props([
    'tooltips' => true,
    'popovers' => true,
    'dropdowns' => true
])

@once
    @push('styles')
    <!-- Bootstrap 4 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @endpush

    @push('scripts')
    <!-- jQuery (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
@endonce

@push('scripts')
<script>
    // Bootstrap components initialization
    $(document).ready(function() {
        if (typeof $ !== 'undefined' && typeof $.fn.modal !== 'undefined') {
            @if($tooltips)
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
            @endif
            
            @if($popovers)
            // Initialize popovers
            $('[data-toggle="popover"]').popover();
            @endif
            
            @if($dropdowns)
            // Initialize dropdowns
            $('.dropdown-toggle').dropdown();
            @endif
            
            console.log('Bootstrap components initialized');
        } else {
            console.warn('Bootstrap or jQuery not found.');
        }
    });
</script>
@endpush
