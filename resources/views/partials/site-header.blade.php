@php
    $nav = [
        ['key' => 'test', 'href' => route('home').'#catalogo'],
        ['key' => 'training', 'href' => route('home').'#catalogo'],
        ['key' => 'resources', 'href' => route('coming-soon', ['sezione' => 'resources'])],
        ['key' => 'contacts', 'href' => route('home').'#contatti'],
    ];
@endphp

{{-- Utility bar --}}
<div class="top-bar">
    <div class="container top-bar__inner">
        <span class="top-bar__shipping">
            @include('partials.icon', ['name' => 'truck', 'size' => 16])
            {{ __('common.topBar.shipping') }}
        </span>
        <nav class="top-bar__nav" aria-label="{{ __('common.topBar.corporate') }}">
            <a class="top-bar__link" href="{{ route('coming-soon', ['sezione' => 'corporate']) }}">{{ __('common.topBar.corporate') }}</a>
            <a class="top-bar__link" href="{{ route('coming-soon', ['sezione' => 'help']) }}">{{ __('common.topBar.help') }}</a>
            <a class="top-bar__link" href="{{ route('coming-soon', ['sezione' => 'platform']) }}">
                {{ __('common.topBar.platform') }}
                @include('partials.icon', ['name' => 'chevron-down', 'size' => 14])
            </a>
        </nav>
        <div class="top-bar__lang">@include('partials.lang-switch', ['compact' => true])</div>
    </div>
</div>

<header class="site-header" data-site-header>
    <div class="container site-header__inner">
        <a href="{{ route('home') }}" class="site-header__logo" aria-label="{{ __('common.header.homeLabel') }}">
            <img class="brand-logo" src="{{ asset('images/giunti-logo.png') }}" alt="" width="143" height="44">
        </a>

        <nav class="site-header__nav" aria-label="{{ __('common.header.mainNav') }}">
            @foreach ($nav as $item)
                <a class="site-header__nav-link" href="{{ $item['href'] }}">{{ __('common.header.nav.'.$item['key']) }}</a>
            @endforeach
        </nav>

        <div class="site-header__actions">
            @include('partials.search-field', ['id' => 'search-desktop', 'class' => 'site-header__search'])
            <div class="site-header__lang">@include('partials.lang-switch')</div>

            <button type="button" class="icon-btn theme-toggle" data-theme-toggle
                    data-label-dark="{{ __('common.header.themeToDark') }}"
                    data-label-light="{{ __('common.header.themeToLight') }}"
                    aria-label="{{ __('common.header.themeToDark') }}" aria-pressed="false">
                <span class="theme-toggle__icon theme-toggle__icon--moon">@include('partials.icon', ['name' => 'moon', 'size' => 22])</span>
                <span class="theme-toggle__icon theme-toggle__icon--sun">@include('partials.icon', ['name' => 'sun', 'size' => 22])</span>
            </button>

            <a href="{{ route('coming-soon', ['sezione' => 'login']) }}" class="btn btn--soft site-header__login">{{ __('common.header.login') }}</a>

            <a href="{{ route('checkout') }}" class="icon-btn" data-cart-link
               data-label-template="{{ trans_choice('common.header.cart', 2, ['count' => '__COUNT__']) }}"
               data-label-zero="{{ trans_choice('common.header.cart', 0) }}"
               data-label-one="{{ trans_choice('common.header.cart', 1, ['count' => 1]) }}"
               aria-label="{{ trans_choice('common.header.cart', 0) }}">
                @include('partials.icon', ['name' => 'cart', 'size' => 22])
                <span class="icon-btn__badge" data-cart-count hidden aria-hidden="true">0</span>
            </a>

            <button type="button" class="icon-btn site-header__menu-toggle" data-menu-toggle
                    aria-expanded="false" aria-controls="mobile-menu"
                    data-label-open="{{ __('common.header.openMenu') }}"
                    data-label-close="{{ __('common.header.closeMenu') }}"
                    aria-label="{{ __('common.header.openMenu') }}">
                <span data-menu-icon="open">@include('partials.icon', ['name' => 'menu', 'size' => 22])</span>
                <span data-menu-icon="close" hidden>@include('partials.icon', ['name' => 'close', 'size' => 22])</span>
            </button>
        </div>
    </div>

    <div class="site-header__mobile-search">
        @include('partials.search-field', ['id' => 'search-mobile'])
    </div>

    <nav id="mobile-menu" class="site-header__mobile-nav" aria-label="{{ __('common.header.mainNav') }}" hidden>
        @foreach ($nav as $item)
            <a class="site-header__mobile-link" href="{{ $item['href'] }}">{{ __('common.header.nav.'.$item['key']) }}</a>
        @endforeach
        <a href="{{ route('coming-soon', ['sezione' => 'login']) }}" class="btn btn--soft btn--block site-header__mobile-login">{{ __('common.header.login') }}</a>
    </nav>
</header>
