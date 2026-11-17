<?php

namespace App\Catalog;

/**
 * Immutable catalog product. Localized fields are arrays keyed by locale
 * ("it", "es"); use the accessors to read them for the current locale.
 */
final class Product
{
    /**
     * @param  array<string, string>  $summary
     * @param  array<string, string>  $description
     * @param  array<string, list<string>>  $highlights
     * @param  array<string, string>  $imageAlt
     * @param  list<string>  $people
     * @param  list<array{id: string, label: array<string, string>, detail: array<string, string>, price: float, salePrice: float}>  $editions
     * @param  array<string, list<string>>  $includes
     */
    public function __construct(
        public readonly string $id,
        public readonly string $slug,
        public readonly string $name,
        public readonly string $kind,
        public readonly string $category,
        public readonly string $format,
        public readonly array $people,
        public readonly array $summary,
        public readonly array $description,
        public readonly array $highlights,
        public readonly string $photoId,
        public readonly array $imageAlt,
        public readonly float $price,
        public readonly float $salePrice,
        public readonly array $editions,
        public readonly bool $isNew = false,
        public readonly ?array $ageRange = null,
        public readonly ?array $durationMinutes = null,
        public readonly ?string $administration = null,
        public readonly ?string $qualification = null,
        public readonly array $includes = [],
        public readonly ?string $startDate = null,
        public readonly ?int $hours = null,
        public readonly ?int $ecmCredits = null,
        public readonly ?string $location = null,
    ) {}

    /** @param  array<string, mixed>  $data */
    public static function fromArray(array $data): self
    {
        return new self(...$data);
    }

    public function isTest(): bool
    {
        return $this->kind === 'test';
    }

    public function isCourse(): bool
    {
        return $this->kind === 'course';
    }

    public function summaryText(?string $locale = null): string
    {
        return $this->summary[$locale ?? app()->getLocale()];
    }

    public function descriptionText(?string $locale = null): string
    {
        return $this->description[$locale ?? app()->getLocale()];
    }

    /** @return list<string> */
    public function highlightList(?string $locale = null): array
    {
        return $this->highlights[$locale ?? app()->getLocale()];
    }

    /** @return list<string> */
    public function includeList(?string $locale = null): array
    {
        return $this->includes[$locale ?? app()->getLocale()] ?? [];
    }

    public function imageAltText(?string $locale = null): string
    {
        return $this->imageAlt[$locale ?? app()->getLocale()];
    }

    /** Unsplash CDN URL for the product photo at the given width. */
    public function imageUrl(int $width = 800): string
    {
        return "https://images.unsplash.com/photo-{$this->photoId}?auto=format&fit=crop&q=75&w={$width}";
    }

    /** Discount percentage of the default edition, rounded. */
    public function discountPercent(): int
    {
        return (int) round((1 - $this->salePrice / $this->price) * 100);
    }

    /** Short name used in breadcrumbs: the code before " · " when present. */
    public function shortName(): string
    {
        return str_contains($this->name, ' · ') ? explode(' · ', $this->name)[0] : $this->name;
    }
}
