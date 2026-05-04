@props(['icon', 'size' => 24])

@if ($icon === App\Enums\ServiceIcon::Code)
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" width="{{ $size }}" height="{{ $size }}">
        <path d="M8 9l-4 3 4 3M16 9l4 3-4 3M14 6l-4 12" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
@elseif ($icon === App\Enums\ServiceIcon::Server)
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" width="{{ $size }}" height="{{ $size }}">
        <rect x="3" y="4" width="18" height="7" rx="1.5"/>
        <rect x="3" y="13" width="18" height="7" rx="1.5"/>
        <path d="M7 7.5h.01M7 16.5h.01M11 7.5h4M11 16.5h4" stroke-linecap="round"/>
    </svg>
@elseif ($icon === App\Enums\ServiceIcon::Phone)
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" width="{{ $size }}" height="{{ $size }}">
        <rect x="7" y="2.5" width="10" height="19" rx="2.5"/>
        <path d="M11 18.5h2" stroke-linecap="round"/>
    </svg>
@else
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" width="{{ $size }}" height="{{ $size }}">
        <ellipse cx="12" cy="5" rx="8" ry="2.5"/>
        <path d="M4 5v7c0 1.4 3.6 2.5 8 2.5s8-1.1 8-2.5V5"/>
        <path d="M4 12v7c0 1.4 3.6 2.5 8 2.5s8-1.1 8-2.5v-7"/>
    </svg>
@endif
