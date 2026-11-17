{{--
    Inline stroke icon. Usage: @include('partials.icon', ['name' => 'cart', 'size' => 20])
    Icons are decorative (aria-hidden); the surrounding control carries the accessible name.
--}}
@php($size = $size ?? 20)
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor"
     stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"
     @isset($class) class="{{ $class }}" @endisset>
    @switch($name)
        @case('search')<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>@break
        @case('cart')<path d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.5L21 8H6.2"/><circle cx="10" cy="20" r="1"/><circle cx="17" cy="20" r="1"/>@break
        @case('sun')<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>@break
        @case('moon')<path d="M20 14.5A8 8 0 0 1 9.5 4a8 8 0 1 0 10.5 10.5z"/>@break
        @case('chevron-down')<path d="m6 9 6 6 6-6"/>@break
        @case('chevron-left')<path d="m15 18-6-6 6-6"/>@break
        @case('chevron-right')<path d="m9 6 6 6-6 6"/>@break
        @case('arrow-right')<path d="M5 12h14"/><path d="m13 6 6 6-6 6"/>@break
        @case('check')<path d="m5 12 5 5 9-10"/>@break
        @case('truck')<path d="M3 7h11v9H3zM14 10h4l3 3v3h-7"/><circle cx="7" cy="18" r="1.6"/><circle cx="17" cy="18" r="1.6"/>@break
        @case('shield')<path d="M12 3 4 6v6c0 4.5 3.4 8.3 8 9 4.6-.7 8-4.5 8-9V6z"/><path d="m9 12 2 2 4-4"/>@break
        @case('lock')<rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/>@break
        @case('menu')<path d="M4 7h16M4 12h16M4 17h16"/>@break
        @case('close')<path d="M6 6l12 12M18 6 6 18"/>@break
        @case('user')<circle cx="12" cy="8" r="4"/><path d="M4 21c1.5-4 4.5-6 8-6s6.5 2 8 6"/>@break
        @case('calendar')<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/>@break
        @case('plus')<path d="M12 5v14M5 12h14"/>@break
        @case('minus')<path d="M5 12h14"/>@break
        @case('trash')<path d="M4 7h16M9 7V4h6v3M6 7l1 13h10l1-13"/>@break
        @case('info')<circle cx="12" cy="12" r="9"/><path d="M12 8v.01M11 12h1v5h1"/>@break
        @case('linkedin')<rect x="3" y="3" width="18" height="18" rx="3"/><path d="M8 10v7M8 7v.01M12 17v-4a2 2 0 0 1 4 0v4M12 10v7"/>@break
        @case('instagram')<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5v.01"/>@break
        @case('youtube')<rect x="2" y="5" width="20" height="14" rx="4"/><path d="m10 9 5 3-5 3z"/>@break
        @case('facebook')<path d="M15 3h-2a4 4 0 0 0-4 4v3H7v4h2v7h4v-7h3l1-4h-4V7a1 1 0 0 1 1-1h2z"/>@break
    @endswitch
</svg>
