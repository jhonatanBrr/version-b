<a class="checkout__back" href="{{ route('home') }}#catalogo">
    @include('partials.icon', ['name' => 'chevron-left', 'size' => 18])
    {{ __('checkout.back') }}
</a>

<div class="checkout__head">
    <h1 class="checkout__title">{{ __('checkout.title') }}</h1>
    @include('sections.checkout.steps', ['current' => 'payment'])
</div>
