{{-- Isotope Layout Component --}}
@props([
    'selector' => '.isotope',
    'itemSelector' => '.isotope-item',
    'layoutMode' => 'fitRows',
    'percentPosition' => true,
    'enableFilters' => true
])

@once
    @push('scripts')
    <!-- Isotope Layout JS -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    @endpush
@endonce

@push('scripts')
<script>
    // Isotope initialization with custom options
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Isotope !== 'undefined') {
            const containers = document.querySelectorAll('{{ $selector }}');
            
            containers.forEach(container => {
                const iso = new Isotope(container, {
                    itemSelector: '{{ $itemSelector }}',
                    layoutMode: '{{ $layoutMode }}',
                    percentPosition: {{ $percentPosition ? 'true' : 'false' }},
                    masonry: {
                        columnWidth: '{{ $itemSelector }}'
                    }
                });
                
                @if($enableFilters)
                // Add filter functionality if filter buttons exist
                const filterButtons = document.querySelectorAll('.isotope-filter');
                filterButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const filterValue = this.getAttribute('data-filter');
                        iso.arrange({ filter: filterValue });
                        
                        // Update active class
                        filterButtons.forEach(btn => btn.classList.remove('active'));
                        this.classList.add('active');
                    });
                });
                @endif
                
                console.log('Isotope initialized on container with selector: {{ $selector }}');
            });
        } else {
            console.warn('Isotope library not found.');
        }
    });
</script>
@endpush
