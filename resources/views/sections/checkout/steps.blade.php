{{--
    Three-step progress indicator: Carrello ✓ · Pagamento · Conferma.
    The script moves it to "confirm" after the simulated payment.
--}}
@php($steps = ['cart', 'payment', 'confirm'])
@php($currentIndex = array_search($current, $steps, true))
<nav class="checkout-steps" aria-label="{{ __('checkout.steps.label') }}" data-checkout-steps>
    <ol class="checkout-steps__list">
        @foreach ($steps as $index => $step)
            @php($state = $index < $currentIndex ? 'done' : ($index === $currentIndex ? 'active' : 'todo'))
            <li class="checkout-steps__item">
                @if ($index > 0)
                    <span class="checkout-steps__connector" aria-hidden="true"></span>
                @endif
                <span class="checkout-steps__step checkout-steps__step--{{ $state }}" data-step="{{ $step }}"
                      @if ($state === 'active') aria-current="step" @endif>
                    <span class="checkout-steps__dot" aria-hidden="true">
                        @include('partials.icon', ['name' => 'check', 'size' => 14, 'class' => 'checkout-steps__check'])
                        <span class="checkout-steps__number">{{ $index + 1 }}</span>
                    </span>
                    {{ __("checkout.steps.$step") }}
                    <span class="sr-only" data-step-completed @if ($state !== 'done') hidden @endif> ({{ __('checkout.steps.completed') }})</span>
                </span>
            </li>
        @endforeach
    </ol>
</nav>
