<?php

namespace Tests\Unit;

use App\Catalog\ProductRepository;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    private function catalog(): ProductRepository
    {
        return $this->app->make(ProductRepository::class);
    }

    #[Test]
    public function it_has_at_least_8_products_across_at_least_3_categories(): void
    {
        $products = $this->catalog()->all();

        $this->assertGreaterThanOrEqual(8, count($products));
        $this->assertGreaterThanOrEqual(3, count(array_unique(array_map(fn ($p) => $p->category, $products))));
    }

    #[Test]
    public function slugs_are_unique_and_sale_prices_are_below_list_prices(): void
    {
        $products = $this->catalog()->all();

        $this->assertCount(count($products), array_unique(array_map(fn ($p) => $p->slug, $products)));
        foreach ($products as $product) {
            $this->assertLessThan($product->price, $product->salePrice);
            $this->assertSame($product->salePrice, $product->editions[0]['salePrice']);
        }
    }

    #[Test]
    public function it_finds_products_by_slug(): void
    {
        $this->assertSame('p02', $this->catalog()->findBySlug('sca-2-screening-cognitivo-adulti')?->id);
        $this->assertNull($this->catalog()->findBySlug('does-not-exist'));
    }

    #[Test]
    public function related_products_exclude_the_current_one_and_prefer_its_category(): void
    {
        $product = $this->catalog()->findBySlug('bva-2-batteria-valutazione-attentiva');
        $related = $this->catalog()->related($product, 3);

        $this->assertCount(3, $related);
        $this->assertNotContains($product->id, array_map(fn ($p) => $p->id, $related));
        $this->assertSame($product->category, $related[0]->category);
    }
}
