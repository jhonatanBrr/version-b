<?php

namespace App\Catalog;

use Illuminate\Support\Carbon;

/**
 * Product page view model: spec line, delivery kind, buy-box totals and
 * structured data, so the Blade sections stay free of business rules.
 */
final class ProductPresenter
{
    public const QUANTITY_MIN = 1;

    public const QUANTITY_MAX = 20;

    public function __construct(public readonly Product $product) {}

    public static function clampQuantity(int $quantity): int
    {
        return min(self::QUANTITY_MAX, max(self::QUANTITY_MIN, $quantity));
    }

    /**
     * Line totals computed in cents to avoid float noise.
     *
     * @param  array{price: float, salePrice: float}  $edition
     * @return array{total: float, listTotal: float, savings: float, discountPercent: int}
     */
    public static function totals(array $edition, int $quantity): array
    {
        $total = (int) round($edition['salePrice'] * 100) * $quantity;
        $listTotal = (int) round($edition['price'] * 100) * $quantity;
        $savings = max(0, $listTotal - $total);

        return [
            'total' => $total / 100.0,
            'listTotal' => $listTotal / 100.0,
            'savings' => $savings / 100.0,
            'discountPercent' => $listTotal > 0 ? (int) round($savings / $listTotal * 100) : 0,
        ];
    }

    /**
     * Ordered spec fragments with their localized label and text:
     * tests by audience and use, courses by schedule.
     *
     * @return list<array{key: string, label: string, text: string}>
     */
    public function specs(): array
    {
        $p = $this->product;

        if ($p->isTest()) {
            $parts = [
                isset($p->ageRange['max'])
                    ? ['ageRange', __('product.spec.ageRange', ['min' => $p->ageRange['min'], 'max' => $p->ageRange['max']])]
                    : ['ageFrom', __('product.spec.ageFrom', ['min' => $p->ageRange['min']])],
                ['duration', __('product.spec.duration', $p->durationMinutes)],
                ['administration', __('product.spec.administration.'.$p->administration)],
                ['qualification', __('product.spec.qualification', ['level' => $p->qualification])],
            ];
        } else {
            $date = Carbon::parse($p->startDate)->locale(app()->getLocale())->isoFormat('LL');
            $parts = [
                ['start', __('product.spec.start', ['date' => $date])],
                ['hours', __('product.spec.hours', ['hours' => $p->hours])],
            ];
            if ($p->ecmCredits !== null) {
                $parts[] = ['ecm', __('product.spec.ecm', ['credits' => $p->ecmCredits])];
            }
            if ($p->location) {
                $parts[] = ['location', $p->location];
            }
        }

        return array_map(fn (array $part) => [
            'key' => $part[0],
            'label' => __('product.details.labels.'.$part[0]),
            'text' => $part[1],
        ], $parts);
    }

    /** "paper" | "digital" | "course": drives the delivery promise. */
    public function deliveryKind(): string
    {
        if ($this->product->isCourse()) {
            return 'course';
        }

        return $this->product->format === 'cartaceo' ? 'paper' : 'digital';
    }

    /**
     * Editions localized for the buy box (server render and jQuery data).
     *
     * @return list<array{id: string, label: string, detail: string, price: float, salePrice: float}>
     */
    public function editions(?string $locale = null): array
    {
        $locale ??= app()->getLocale();

        return array_map(fn (array $edition) => [
            'id' => $edition['id'],
            'label' => $edition['label'][$locale],
            'detail' => $edition['detail'][$locale],
            'price' => $edition['price'],
            'salePrice' => $edition['salePrice'],
        ], $this->product->editions);
    }

    /**
     * schema.org Product structured data for search engines.
     *
     * @return array<string, mixed>
     */
    public function jsonLd(?string $locale = null): array
    {
        $p = $this->product;

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $p->name,
            'description' => $p->summaryText($locale),
            'image' => $p->imageUrl(1200),
            'sku' => $p->id,
            'brand' => ['@type' => 'Brand', 'name' => 'Giunti Psychometrics'],
            'offers' => [
                '@type' => 'Offer',
                'price' => number_format($p->salePrice, 2, '.', ''),
                'priceCurrency' => 'EUR',
                'availability' => 'https://schema.org/InStock',
            ],
        ];
    }
}
