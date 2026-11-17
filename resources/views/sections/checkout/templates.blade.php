{{-- Markup the script clones for each cart line and each purchased line. --}}
<template data-line-template>
    <li class="order-line">
        <img class="order-line__image" src="" alt="" width="72" height="72" loading="lazy" decoding="async" data-line-image>
        <div class="order-line__body">
            <div class="order-line__top">
                <div class="order-line__info">
                    <p class="order-line__name" data-line-name></p>
                    <p class="order-line__meta" data-line-meta></p>
                </div>
                <p class="order-line__price">
                    <span class="order-line__current tabular">
                        <span class="sr-only">{{ __('common.a11y.currentPrice') }} </span><span data-line-total></span>
                    </span>
                    <s class="order-line__original tabular" data-line-original-wrap>
                        <span class="sr-only">{{ __('common.a11y.originalPrice') }} </span><span data-line-original></span>
                    </s>
                </p>
            </div>
            <div class="order-line__actions">
                <div class="line-stepper" role="group" data-line-stepper>
                    <button type="button" class="line-stepper__button" data-quantity-step="-1"><span aria-hidden="true">−</span></button>
                    <output class="line-stepper__value tabular" aria-live="polite" data-line-quantity></output>
                    <button type="button" class="line-stepper__button" data-quantity-step="1"><span aria-hidden="true">+</span></button>
                </div>
                <button type="button" class="order-line__remove" data-line-remove>{{ __('checkout.summary.remove') }}</button>
            </div>
        </div>
    </li>
</template>

<template data-confirmation-line-template>
    <li class="confirmation__line">
        <span class="confirmation__line-info">
            <span class="confirmation__line-name" data-line-name></span>
            <span class="confirmation__line-meta" data-line-meta></span>
        </span>
        <span class="confirmation__line-total tabular" data-line-total></span>
    </li>
</template>
