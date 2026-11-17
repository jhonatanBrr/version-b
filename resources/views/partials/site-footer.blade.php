<footer class="site-footer">
    <div class="container site-footer__inner">
        <div class="site-footer__top">
            <div class="site-footer__brand">
                <img class="brand-logo" src="{{ asset('images/giunti-logo.png') }}" alt="Giunti Psychometrics" width="143" height="44">
                <p class="site-footer__tagline">{{ __('common.footer.tagline') }}</p>
            </div>

            <nav class="site-footer__nav" aria-label="{{ __('common.footer.navLabel') }}">
                <div class="site-footer__column">
                    <span class="site-footer__heading">{{ __('common.footer.products') }}</span>
                    <a class="site-footer__link" href="{{ route('home') }}#catalogo">{{ __('common.header.nav.test') }}</a>
                    <a class="site-footer__link" href="{{ route('home') }}#catalogo">{{ __('common.header.nav.training') }}</a>
                    <a class="site-footer__link" href="{{ route('coming-soon', ['sezione' => 'resources']) }}">{{ __('common.header.nav.resources') }}</a>
                </div>
                <div class="site-footer__column">
                    <span class="site-footer__heading">{{ __('common.footer.company') }}</span>
                    <a class="site-footer__link" href="{{ route('coming-soon', ['sezione' => 'about']) }}">{{ __('common.footer.about') }}</a>
                    <a class="site-footer__link" href="{{ route('home') }}#contatti">{{ __('common.header.nav.contacts') }}</a>
                    <a class="site-footer__link" href="{{ route('coming-soon', ['sezione' => 'privacy']) }}">{{ __('common.footer.privacy') }}</a>
                </div>
            </nav>

            <div class="site-footer__column">
                <span class="site-footer__heading">{{ __('common.footer.follow') }}</span>
                <ul class="site-footer__socials">
                    @foreach (['linkedin' => 'LinkedIn', 'instagram' => 'Instagram', 'youtube' => 'YouTube', 'facebook' => 'Facebook'] as $icon => $label)
                        <li>
                            <a class="site-footer__social" href="{{ route('coming-soon', ['sezione' => 'social']) }}" aria-label="{{ $label }}">
                                @include('partials.icon', ['name' => $icon, 'size' => 18])
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <p class="site-footer__copyright">{{ __('common.footer.copyright', ['year' => now()->year]) }}</p>
    </div>
</footer>
