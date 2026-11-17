<?php

namespace App\Catalog;

/**
 * Read access to the catalog. Bound in AppServiceProvider; swapping the
 * mock for a real source (Magento, database, API) only means a new class.
 */
interface ProductRepository
{
    /** @return list<Product> */
    public function all(): array;

    public function findBySlug(string $slug): ?Product;

    /** Same-category products first, then the rest, excluding the given one. */
    public function related(Product $product, int $limit = 3): array;

    /** @return list<array{id: string, label: array<string, string>}> */
    public function categories(): array;

    /** @return list<string> */
    public function formats(): array;
}
