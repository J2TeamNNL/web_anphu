@props([
    'size' => 'medium', // small, medium, large
    'style' => 'default', // default, outline, minimal, footer
    'showLabels' => false,
    'direction' => 'horizontal', // horizontal, vertical
    'platforms' => null, // specific platforms to show, null = all
    'class' => ''
])

@php
    // Load from database with fallback to config
    $companySetting = company();
    $socialMedia = $companySetting?->social_links ?? [];

    // Định nghĩa danh sách đầy đủ các social media có thể có
    $availableSocialMedia = [
        'facebook' => [
            'icon' => 'fab fa-facebook-f',
            'color' => '#1877f2',
            'name' => 'Facebook'
        ],
        'tiktok' => [
            'icon' => 'fab fa-tiktok',
            'color' => '#000000',
            'name' => 'TikTok',
            'logo' => 'assets/img/logo/logo_tiktok.png'
        ],
        'youtube' => [
            'icon' => 'fab fa-youtube',
            'color' => '#ff0000',
            'name' => 'YouTube'
        ],
        'zalo' => [
            'icon' => null,
            'color' => '#0068ff',
            'name' => 'Zalo',
            'logo' => 'assets/img/logo/logo_zalo.png'
        ],
        'instagram' => [
            'icon' => 'fab fa-instagram',
            'color' => '#E4405F',
            'name' => 'Instagram'
        ],
        'linkedin' => [
            'icon' => 'fab fa-linkedin-in',
            'color' => '#0077b5',
            'name' => 'LinkedIn'
        ],
        'twitter' => [
            'icon' => 'fab fa-twitter',
            'color' => '#1da1f2',
            'name' => 'Twitter'
        ]
    ];

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
    @foreach($availableSocialMedia as $platform => $social)
        @if(isset($socialMedia[$platform]))
            <a href="{{ $socialMedia[$platform] }}"
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
                            style="height: 40px;"
                        >
                    @endif
                </span>

                @if($showLabels)
                    <span class="social-label">{{ $social['name'] }}</span>
                @endif
            </a>
        @endif
    @endforeach
</div>
