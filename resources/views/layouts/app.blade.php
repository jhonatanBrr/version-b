<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@hasSection('title')@yield('title') · {{ __('common.meta.siteName') }}@else{{ __('common.meta.defaultTitle') }}@endif</title>
    <meta name="description" content="@yield('description', __('common.meta.defaultDescription'))">
    @stack('meta')

    {{-- Applies the saved (or system) theme before first paint: no light flash in dark mode. --}}
    <script>
        (function () {
            try {
                var t = localStorage.getItem('gp-theme');
                if (t !== 'light' && t !== 'dark') {
                    t = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                }
                document.documentElement.dataset.theme = t;
            } catch (e) {}
        })();
    </script>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@500;600&family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <a href="#contenuto" class="skip-link">{{ __('common.a11y.skipToContent') }}</a>

    @include('partials.site-header')

    <main id="contenuto">
        @yield('content')
    </main>

    @include('partials.site-footer')

    <script src="{{ mix('js/app.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
