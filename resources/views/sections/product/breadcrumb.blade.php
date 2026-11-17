{{-- Breadcrumb: Home › Test|Formazione › category › short name. --}}
<nav class="product-breadcrumb" aria-label="{{ __('product.breadcrumb.label') }}">
    <ol class="product-breadcrumb__list">
        <li><a class="product-breadcrumb__link" href="{{ route('home') }}">{{ __('product.breadcrumb.home') }}</a></li>
        <li aria-hidden="true">@include('partials.icon', ['name' => 'chevron-right', 'size' => 14, 'class' => 'product-breadcrumb__separator'])</li>
        <li><a class="product-breadcrumb__link" href="{{ route('home') }}#catalogo">{{ __('product.breadcrumb.'.$product->kind) }}</a></li>
        <li aria-hidden="true">@include('partials.icon', ['name' => 'chevron-right', 'size' => 14, 'class' => 'product-breadcrumb__separator'])</li>
        <li>{{ $categoryLabel }}</li>
        <li aria-hidden="true">@include('partials.icon', ['name' => 'chevron-right', 'size' => 14, 'class' => 'product-breadcrumb__separator'])</li>
        <li><span class="product-breadcrumb__current" aria-current="page">{{ $product->shortName() }}</span></li>
    </ol>
</nav>
