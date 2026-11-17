@extends('layouts.app')

@section('title', $product->name)
@section('description', $product->summaryText())

@push('meta')
    <meta property="og:type" content="product">
    <meta property="og:title" content="{{ $product->name }}">
    <meta property="og:description" content="{{ $product->summaryText() }}">
    <meta property="og:image" content="{{ $product->imageUrl(1200) }}">
    <meta property="og:image:alt" content="{{ $product->imageAltText() }}">
    <script type="application/ld+json">@json($page->jsonLd(), JSON_HEX_TAG | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)</script>
@endpush

@section('content')
    <div class="container product-page" data-page="product">
        <div class="ds-enter">
            @include('sections.product.breadcrumb')
        </div>

        <div class="product-page__main">
            <div class="product-page__gallery ds-enter-scale ds-delay-1">
                @include('sections.product.gallery')
            </div>
            <div class="product-page__info">
                <div class="ds-enter ds-delay-2">
                    @include('sections.product.summary')
                </div>
                <div class="ds-enter ds-delay-3">
                    @include('sections.product.buy-box')
                </div>
                <div class="ds-enter ds-delay-4">
                    @include('sections.product.delivery')
                </div>
                <div class="ds-enter ds-delay-5">
                    @include('sections.product.details')
                </div>
            </div>
        </div>

        <div class="ds-reveal">
            @include('sections.product.related')
        </div>
    </div>
@endsection
