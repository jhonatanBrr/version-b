{{-- Product photo (4:3) with the "new" badge. --}}
<div class="product-gallery">
    <img class="product-gallery__image"
         src="{{ $product->imageUrl(1200) }}"
         srcset="{{ $product->imageUrl(640) }} 640w, {{ $product->imageUrl(1200) }} 1200w"
         sizes="(min-width: 1024px) 600px, 100vw"
         alt="{{ $product->imageAltText() }}"
         width="1200" height="900"
         fetchpriority="high" decoding="async">
    @if ($product->isNew)
        <span class="badge badge--solid product-gallery__badge">{{ __('product.isNew') }}</span>
    @endif
</div>
