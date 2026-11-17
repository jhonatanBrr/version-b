{{--
    Price with the original amount struck through.
    @include('partials.price', ['amount' => 272.0, 'original' => 320.0, 'size' => 'lg'])
--}}
@php($size = $size ?? null)
<span class="price {{ $size ? 'price--'.$size : '' }}">
    <span class="price__current" @isset($currentHook) data-{{ $currentHook }} @endisset>
        <span class="sr-only">{{ __('common.a11y.currentPrice') }} </span>{{ \App\Support\PriceFormatter::format($amount) }}
    </span>
    @if (isset($original) && $original > $amount)
        <s class="price__original" @isset($originalHook) data-{{ $originalHook }} @endisset>
            <span class="sr-only">{{ __('common.a11y.originalPrice') }} </span>{{ \App\Support\PriceFormatter::format($original) }}
        </s>
    @endif
</span>
