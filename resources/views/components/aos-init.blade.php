{{-- AOS (Animate On Scroll) Component --}}
@props([
    'duration' => 800,
    'once' => true,
    'offset' => 120,
    'delay' => 0
])

@once
    @push('styles')
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    @endpush

    @push('scripts')
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    @endpush
@endonce

@push('scripts')
<script>
    // AOS initialization with custom options
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: {{ $duration }},
                once: {{ $once ? 'true' : 'false' }},
                offset: {{ $offset }},
                delay: {{ $delay }}
            });
            console.log('AOS initialized with custom options');
        } else {
            console.warn('AOS library not found.');
        }
    });
</script>
@endpush
