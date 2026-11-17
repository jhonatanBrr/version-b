{{--
    "404" illustration: a questionnaire under a magnifying glass, where the zero
    is a missing puzzle piece. Colors come from the design tokens, so it follows
    the palette and the dark theme automatically.
    @include('partials.illustrations.not-found', ['title' => '…', 'class' => '…'])
    Pass an empty title when the image is purely decorative.
--}}
@php($decorative = ($title ?? '') === '')
<svg viewBox="0 0 560 400" class="{{ $class ?? '' }}" fill="none" focusable="false"
     @if ($decorative) aria-hidden="true" @else role="img" aria-label="{{ $title }}" @endif>
    {{-- Soft backdrop blobs --}}
    <ellipse cx="280" cy="210" rx="250" ry="170" fill="var(--ds-soft)"/>
    <circle cx="470" cy="80" r="46" fill="var(--brand-accent)" opacity="0.14"/>
    <circle cx="78" cy="320" r="30" fill="var(--brand-primary)" opacity="0.1"/>

    {{-- Questionnaire sheet --}}
    <g transform="rotate(-6 210 200)">
        <rect x="118" y="70" width="190" height="250" rx="6" fill="var(--ds-paper)" stroke="var(--ds-line)" stroke-width="2"/>
        <rect x="170" y="58" width="86" height="22" rx="6" fill="var(--brand-primary)"/>
        <rect x="140" y="104" width="120" height="8" rx="4" fill="var(--ds-line)"/>
        @foreach ([0, 1, 2, 3, 4] as $row)
            <g transform="translate(140 {{ 132 + $row * 34 }})">
                <rect width="16" height="16" rx="4" stroke="var(--brand-primary)" stroke-width="2" fill="{{ $row === 1 ? 'var(--brand-primary)' : 'none' }}"/>
                @if ($row === 1)
                    <path d="M4 8.5l3 3 5-6" stroke="var(--ds-on-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                @endif
                <rect x="28" y="4" width="{{ $row % 2 === 0 ? 112 : 86 }}" height="8" rx="4" fill="var(--ds-line)"/>
            </g>
        @endforeach
    </g>

    {{-- "4 _ 4" with a missing puzzle piece as the zero --}}
    <g font-family="'Inter Tight', 'Noto Sans', sans-serif" font-weight="600" font-size="112" fill="var(--ds-ink)">
        <text x="300" y="250">4</text>
        <text x="470" y="250">4</text>
    </g>
    {{-- Empty slot where the piece belongs --}}
    <path d="M376 168h22a12 12 0 1 1 24 0h22v24a12 12 0 1 0 0 24v24h-22a12 12 0 1 0-24 0h-22v-24a12 12 0 1 1 0-24z"
          stroke="var(--brand-primary)" stroke-width="3" stroke-dasharray="7 7" stroke-linejoin="round" fill="var(--ds-surface)"/>
    {{-- The missing piece, floating away --}}
    <g transform="translate(452 98) rotate(18)">
        <path d="M0 0h18a10 10 0 1 1 20 0h18v20a10 10 0 1 0 0 20v20H38a10 10 0 1 0-20 0H0V40a10 10 0 1 1 0-20z" fill="var(--brand-accent)"/>
    </g>
    <path d="M432 150c10-18 18-26 30-30" stroke="var(--brand-accent)" stroke-width="2.5" stroke-linecap="round" stroke-dasharray="2 7"/>

    {{-- Magnifying glass over the sheet --}}
    <g>
        <circle cx="226" cy="246" r="50" fill="var(--brand-accent)" opacity="0.12"/>
        <circle cx="226" cy="246" r="50" stroke="var(--brand-primary)" stroke-width="10"/>
        <path d="M262 282l40 40" stroke="var(--brand-primary)" stroke-width="16" stroke-linecap="round"/>
        <path d="M200 226a30 30 0 0 1 22-12" stroke="var(--ds-paper)" stroke-width="5" stroke-linecap="round" opacity="0.8"/>
    </g>

    {{-- Sparkles --}}
    <path d="M96 120v16M88 128h16" stroke="var(--brand-accent)" stroke-width="3" stroke-linecap="round"/>
    <path d="M512 300v12M506 306h12" stroke="var(--brand-primary)" stroke-width="3" stroke-linecap="round"/>
</svg>
