{{-- Smooth Scroll Component --}}
@props([
    'duration' => 800,
    'enableDropdownSubmenu' => true
])

@once
    @push('scripts')
    <!-- jQuery (required for smooth scroll) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @endpush
@endonce

@push('scripts')
<script>
    // Smooth Scroll and Dropdown functionality
    $(document).ready(function() {
        // Smooth Scroll for Anchor Links
        $('a[href^="#"]').on('click', function(e) {
            const href = $(this).attr('href');
            if (href === '#') return;
            e.preventDefault();
            const target = $(href);
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, {{ $duration }});
            }
        });
        
        @if($enableDropdownSubmenu)
        // Dropdown submenu toggle
        $('li.dropdown-submenu > a').on("click", function(e) {
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
        @endif
        
        console.log('Smooth scroll initialized with duration: {{ $duration }}ms');
    });
</script>
@endpush
