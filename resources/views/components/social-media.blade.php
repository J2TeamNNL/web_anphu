@props([
    'size' => 'medium', // small, medium, large
    'style' => 'default', // default, outline, minimal, footer
    'showLabels' => false,
    'direction' => 'horizontal', // horizontal, vertical
    'platforms' => null, // specific platforms to show, null = all
    'class' => ''
])

@php
    // Always load directly from config - no backend dependency
    $socialMedia = config('company.social_media', []);
    
    // Ensure we have data, fallback to empty array if config not found
    if (empty($socialMedia)) {
        $socialMedia = [];
    }
    
    // Filter platforms if specified
    if ($platforms && is_array($platforms)) {
        $socialMedia = array_intersect_key($socialMedia, array_flip($platforms));
    }
    
    // Size classes
    $sizeClasses = [
        'small' => 'social-sm',
        'medium' => 'social-md', 
        'large' => 'social-lg'
    ];
    
    // Style classes
    $styleClasses = [
        'default' => 'social-default',
        'outline' => 'social-outline',
        'minimal' => 'social-minimal',
        'footer' => 'social-footer'
    ];
    
    $containerClass = 'social-media-container ' . 
    ($sizeClasses[$size] ?? 'social-md') . ' ' .
    ($styleClasses[$style] ?? 'social-default') . ' ' .
    ($direction === 'vertical' ? 'social-vertical' : 'social-horizontal') . ' ' .
    $class;
@endphp

<div class="{{ $containerClass }}">
    @foreach($socialMedia as $platform => $social)
        <a href="{{ $social['url'] }}" 
           class="social-link social-{{ $platform }}" 
           target="_blank" 
           title="{{ $social['name'] }}"
           data-platform="{{ $platform }}">
            
            <span class="social-icon">
                @if($social['icon'])
                    <i class="{{ $social['icon'] }}"></i>
                @else
                    <img
                        src="{{ asset($social['logo']) }}"
                        alt="{{ $social['name'] }}"
                        style="height: 30px;"
                    >
                @endif
            </span>
            
            @if($showLabels)
                <span class="social-label">{{ $social['name'] }}</span>
            @endif
        </a>
    @endforeach
</div>
