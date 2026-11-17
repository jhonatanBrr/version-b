{{--
    Native radio inputs sharing one name: arrow keys move the selection and
    Tab enters/leaves the group, as expected for a radiogroup.
--}}
<div class="payment-methods">
    <div class="payment-methods__list" role="radiogroup" aria-labelledby="checkout-payment-legend" aria-describedby="checkout-method-description">
        @foreach ($paymentMethods as $methodId => $logos)
            <label class="payment-method">
                <input class="payment-method__radio" type="radio" name="payment-method" value="{{ $methodId }}" @checked($methodId === $defaultMethod)>
                <span class="payment-method__label">{{ __("checkout.methods.$methodId.label") }}</span>
                @if ($methodId === 'installments')
                    <span class="badge badge--brand">{{ __('checkout.methods.installments.badge') }}</span>
                @endif
                @if ($logos !== [])
                    <span class="payment-logos">
                        @foreach ($logos as $file => $brand)
                            <span class="payment-logos__tile">
                                <img class="payment-logos__image" src="{{ asset("images/payment/$file.svg") }}" alt="{{ $brand }}" width="32" height="20">
                            </span>
                        @endforeach
                    </span>
                @endif
            </label>
        @endforeach
    </div>
    <p id="checkout-method-description" class="payment-methods__description" aria-live="polite" data-method-description>
        {{ __("checkout.methods.$defaultMethod.description") }}
    </p>
</div>
