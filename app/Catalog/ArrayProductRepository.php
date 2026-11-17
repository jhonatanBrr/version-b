<?php

namespace App\Catalog;

/** Catalog backed by the mock data file in resources/data/catalog.php. */
final class ArrayProductRepository implements ProductRepository
{
    /** @var list<Product>|null */
    private ?array $products = null;

    /** @param  array{categories: list<array{id: string, label: array<string, string>}>, formats: list<string>, products: list<array<string, mixed>>}  $data */
    public function __construct(private readonly array $data) {}

    public function all(): array
    {
        return $this->products ??= array_map(Product::fromArray(...), $this->data['products']);
    }

    public function findBySlug(string $slug): ?Product
    {
        foreach ($this->all() as $product) {
            if ($product->slug === $slug) {
                return $product;
            }
        }

        return null;
    }

    public function related(Product $product, int $limit = 3): array
    {
        $others = array_values(array_filter($this->all(), fn (Product $p) => $p->id !== $product->id));
        $same = array_filter($others, fn (Product $p) => $p->category === $product->category);
        $rest = array_filter($others, fn (Product $p) => $p->category !== $product->category);

        return array_slice([...$same, ...$rest], 0, $limit);
    }

    public function categories(): array
    {
        return $this->data['categories'];
    }

    public function formats(): array
    {
        return $this->data['formats'];
    }
}
