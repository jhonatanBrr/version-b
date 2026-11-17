{{-- Hero with a soft gradient background and the featured (new) product. --}}
@php
    $stats = [
        __('home.hero.stats.products', ['count' => $productCount]),
        __('home.hero.stats.shipping'),
        __('home.hero.stats.support'),
    ];
@endphp
<section class="hero" aria-labelledby="hero-title">
    <div class="container hero__inner">
        <div class="hero__copy">
            <span class="eyebrow ds-enter">{{ __('home.hero.eyebrow') }}</span>
            <h1 id="hero-title" class="hero__title ds-enter ds-delay-1">{{ __('home.hero.title') }}</h1>
            <p class="hero__subtitle ds-enter ds-delay-2">{{ __('home.hero.subtitle') }}</p>
            <div class="hero__actions ds-enter ds-delay-3">
                <a href="#catalogo" class="btn btn--primary btn--lg">
                    {{ __('home.hero.primaryCta') }}
                    @include('partials.icon', ['name' => 'arrow-right', 'size' => 18])
                </a>
                <a href="#contatti" class="btn btn--outline btn--lg">{{ __('home.hero.secondaryCta') }}</a>
            </div>
            <ul class="hero__stats ds-enter ds-delay-4" aria-label="{{ __('home.hero.stats.label') }}">
                @foreach ($stats as $stat)
                    <li class="hero__stat">
                        @include('partials.icon', ['name' => 'check', 'size' => 16, 'class' => 'hero__stat-icon'])
                        {{ $stat }}
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Entrance lives on the wrapper so its fill-mode never overrides the hover lift. --}}
        <div class="ds-enter-scale ds-delay-2">
            <article class="featured" aria-label="{{ __('home.hero.featuredLabel') }}">
                <div class="featured__media">
                    <img class="featured__image"
                         src="{{ $featured->imageUrl(1040) }}"
                         srcset="{{ $featured->imageUrl(640) }} 640w, {{ $featured->imageUrl(1040) }} 1040w"
                         sizes="(min-width: 1024px) 520px, 100vw"
                         alt="{{ $featured->imageAltText() }}"
                         width="1040" height="780" fetchpriority="high" decoding="async">
                    @if ($featured->isNew)
                        <span class="badge badge--solid featured__tag">{{ __('home.hero.newTag') }}</span>
                    @endif
                </div>
                <div class="featured__body">
                    <span class="featured__eyebrow">{{ __('common.kinds.'.$featured->kind) }} · {{ __('common.formats.'.$featured->format) }}</span>
                    <h2 class="featured__title">
                        <a class="featured__link" href="{{ route('products.show', $featured->slug) }}"
                           aria-label="{{ __('home.hero.featuredCta', ['name' => $featured->name]) }}">{{ $featured->name }}</a>
                    </h2>
                    <p class="featured__summary">{{ $featured->summaryText() }}</p>
                    @include('partials.price', ['amount' => $featured->salePrice, 'original' => $featured->price])
                </div>
            </article>
        </div>
    </div>
</section>
