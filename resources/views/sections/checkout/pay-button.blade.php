{{--
    Submit button whose label follows the selected payment method.
    Pass 'form' when the button lives outside the form (mobile sticky bar).
--}}
<button type="submit" class="btn btn--primary btn--lg btn--block checkout-pay" data-pay-button
        @isset($form) form="{{ $form }}" @endisset>
    @include('partials.icon', ['name' => 'lock', 'size' => 18])
    <span data-pay-label></span>
</button>
