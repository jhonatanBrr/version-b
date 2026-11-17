{{--
    "Coming soon" illustration: a page still being drafted — a browser window
    with dashed placeholder blocks, a pencil sketching the layout, a ruler and
    a sticky note. Colors come from the design tokens (light and dark themes).
    @include('partials.illustrations.coming-soon', ['title' => '…', 'class' => '…'])
    Pass an empty title when the image is purely decorative.
--}}
@php($decorative = ($title ?? '') === '')
<svg viewBox="0 0 560 400" class="{{ $class ?? '' }}" fill="none" focusable="false"
     @if ($decorative) aria-hidden="true" @else role="img" aria-label="{{ $title }}" @endif>
    {{-- Backdrop --}}
    <ellipse cx="280" cy="214" rx="252" ry="168" fill="var(--ds-soft)"/>
    <circle cx="486" cy="96" r="40" fill="var(--brand-accent)" opacity="0.14"/>
    <circle cx="70" cy="300" r="26" fill="var(--brand-primary)" opacity="0.1"/>

    {{-- Browser window being drafted --}}
    <g>
        <rect x="96" y="74" width="330" height="236" rx="6" fill="var(--ds-paper)" stroke="var(--ds-line)" stroke-width="2"/>
        <path d="M96 80a6 6 0 0 1 6-6h318a6 6 0 0 1 6 6v22H96z" fill="var(--brand-primary)"/>
        <circle cx="114" cy="88" r="4.5" fill="var(--ds-paper)" opacity="0.9"/>
        <circle cx="130" cy="88" r="4.5" fill="var(--ds-paper)" opacity="0.6"/>
        <circle cx="146" cy="88" r="4.5" fill="var(--ds-paper)" opacity="0.35"/>
        <rect x="170" y="82" width="140" height="12" rx="6" fill="var(--ds-paper)" opacity="0.25"/>

        {{-- Finished bits --}}
        <rect x="118" y="122" width="120" height="12" rx="6" fill="var(--brand-text)" opacity="0.85"/>
        <rect x="118" y="144" width="180" height="8" rx="4" fill="var(--ds-line)"/>
        <rect x="118" y="160" width="150" height="8" rx="4" fill="var(--ds-line)"/>

        {{-- Placeholders still to build (dashed) --}}
        <g stroke="var(--brand-primary)" stroke-width="2" stroke-dasharray="6 6" opacity="0.7">
            <rect x="118" y="188" width="88" height="96" rx="6"/>
            <rect x="218" y="188" width="88" height="96" rx="6"/>
            <rect x="318" y="122" width="88" height="162" rx="6"/>
        </g>
        <path d="M150 236l12-12 12 12M162 224v24" stroke="var(--brand-primary)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.7"/>
        <path d="M250 236h24M262 224v24" stroke="var(--brand-primary)" stroke-width="2.5" stroke-linecap="round" opacity="0.7"/>
    </g>

    {{-- Pencil sketching a line --}}
    <g transform="rotate(38 404 250)">
        <rect x="380" y="200" width="24" height="112" rx="4" fill="var(--brand-accent)"/>
        <rect x="380" y="200" width="24" height="16" rx="3" fill="var(--brand-primary)"/>
        <path d="M380 312h24l-12 26z" fill="var(--ds-paper)" stroke="var(--ds-line)" stroke-width="2" stroke-linejoin="round"/>
        <path d="M388 330h8l-4 8z" fill="var(--brand-text)"/>
    </g>
    <path d="M318 302c18 6 36 6 54-2" stroke="var(--brand-text)" stroke-width="2.5" stroke-linecap="round" stroke-dasharray="1 7"/>

    {{-- Ruler --}}
    <g transform="rotate(-8 300 352)">
        <rect x="176" y="338" width="230" height="28" rx="4" fill="var(--brand-primary)" opacity="0.92"/>
        @for ($i = 0; $i < 11; $i++)
            <path d="M{{ 190 + $i * 20 }} 338v{{ $i % 2 === 0 ? 12 : 7 }}" stroke="var(--ds-paper)" stroke-width="2" stroke-linecap="round"/>
        @endfor
    </g>

    {{-- Sticky note with a check list --}}
    <g transform="rotate(7 466 196)">
        <rect x="428" y="150" width="84" height="84" rx="6" fill="var(--ds-note)"/>
        <path d="M428 150h84v14h-84z" fill="var(--ds-note-strong)"/>
        @foreach ([0, 1, 2] as $row)
            <g transform="translate(440 {{ 176 + $row * 18 }})">
                <path d="{{ $row === 0 ? 'M0 4l3 3 6-7' : 'M0 0h8v8H0z' }}" stroke="var(--ds-note-ink)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="16" y="2" width="{{ $row === 1 ? 40 : 52 }}" height="5" rx="2.5" fill="var(--ds-note-ink)" opacity="0.45"/>
            </g>
        @endforeach
    </g>

    {{-- Sparkles --}}
    <path d="M78 120v16M70 128h16" stroke="var(--brand-accent)" stroke-width="3" stroke-linecap="round"/>
    <path d="M500 302v12M494 308h12" stroke="var(--brand-primary)" stroke-width="3" stroke-linecap="round"/>
</svg>
