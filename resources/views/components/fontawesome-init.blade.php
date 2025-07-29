{{-- FontAwesome Component --}}
@props([
    'version' => '6.0.0'
])

@once
    @push('styles')
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/{{ $version }}/css/all.min.css">
    @endpush
@endonce
