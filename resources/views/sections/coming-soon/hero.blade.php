<section class="coming-soon" data-page="coming-soon">
    <div class="coming-soon__inner container">
        <div class="coming-soon__content">
            <span class="coming-soon__eyebrow">
                <span class="coming-soon__dot" aria-hidden="true"></span>
                {{ __('common.comingSoon.eyebrow') }}
            </span>
            <h1 class="coming-soon__title">
                {{ $section
                    ? __('common.comingSoon.titleSection', ['section' => __("common.comingSoon.sections.$section")])
                    : __('common.comingSoon.title') }}
            </h1>
            <p class="coming-soon__text">{{ __('common.comingSoon.text') }}</p>
            <ul class="coming-soon__list">
                @foreach (['catalog', 'product', 'checkout'] as $key)
                    <li class="coming-soon__item">
                        <span class="coming-soon__check" aria-hidden="true">✓</span>
                        {{ __("common.comingSoon.available.$key") }}
                    </li>
                @endforeach
            </ul>
            <div class="coming-soon__actions">
                <a class="btn btn--primary btn--lg" href="{{ route('home') }}#catalogo">{{ __('common.comingSoon.toCatalog') }}</a>
                <a class="btn btn--outline btn--lg" href="{{ route('home') }}">{{ __('common.comingSoon.toHome') }}</a>
            </div>
        </div>
        @include('partials.illustrations.coming-soon', ['title' => __('common.comingSoon.illustration'), 'class' => 'coming-soon__illustration'])
    </div>
</section>
