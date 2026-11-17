<?php

namespace Tests\Unit;

use App\Catalog\ProductPresenter;
use App\Catalog\ProductRepository;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductPresenterTest extends TestCase
{
    private function presenter(string $slug): ProductPresenter
    {
        return new ProductPresenter(app(ProductRepository::class)->findBySlug($slug));
    }

    #[Test]
    public function totals_are_computed_in_cents_with_savings_and_discount(): void
    {
        $totals = ProductPresenter::totals(['price' => 95.0, 'salePrice' => 80.75], 3);

        $this->assertSame(242.25, $totals['total']);
        $this->assertSame(285.0, $totals['listTotal']);
        $this->assertSame(42.75, $totals['savings']);
        $this->assertSame(15, $totals['discountPercent']);
    }

    #[Test]
    public function totals_without_discount_have_no_savings(): void
    {
        $totals = ProductPresenter::totals(['price' => 100.0, 'salePrice' => 100.0], 1);

        $this->assertSame(0.0, $totals['savings']);
        $this->assertSame(0, $totals['discountPercent']);
    }

    #[Test]
    public function quantity_is_clamped_between_1_and_20(): void
    {
        $this->assertSame(1, ProductPresenter::clampQuantity(0));
        $this->assertSame(20, ProductPresenter::clampQuantity(99));
        $this->assertSame(5, ProductPresenter::clampQuantity(5));
    }

    #[Test]
    public function a_test_spec_line_lists_age_duration_administration_and_qualification(): void
    {
        app()->setLocale('it');
        $specs = $this->presenter('sca-2-screening-cognitivo-adulti')->specs();

        $this->assertSame(['ageRange', 'duration', 'administration', 'qualification'], array_column($specs, 'key'));
        $this->assertSame(['18–90 anni', '15–20 min', 'Individuale', 'Livello B'], array_column($specs, 'text'));
        $this->assertSame('Età', $specs[0]['label']);
    }

    #[Test]
    public function a_course_spec_line_lists_start_hours_and_ecm_credits(): void
    {
        app()->setLocale('es');
        $specs = $this->presenter('corso-valutazione-neuropsicologica-eta-evolutiva')->specs();

        $this->assertSame(['start', 'hours', 'ecm'], array_column($specs, 'key'));
        $this->assertSame('Inicio 15 de enero de 2027', $specs[0]['text']);
        $this->assertSame('16 horas', $specs[1]['text']);
        $this->assertSame('24 créditos ECM', $specs[2]['text']);
    }

    #[Test]
    public function delivery_kind_depends_on_kind_and_format(): void
    {
        $this->assertSame('digital', $this->presenter('sca-2-screening-cognitivo-adulti')->deliveryKind());
        $this->assertSame('course', $this->presenter('corso-valutazione-neuropsicologica-eta-evolutiva')->deliveryKind());
    }

    #[Test]
    public function json_ld_describes_the_product_offer_in_euros(): void
    {
        $jsonLd = $this->presenter('sca-2-screening-cognitivo-adulti')->jsonLd('it');

        $this->assertSame('Product', $jsonLd['@type']);
        $this->assertSame('SCA-2 · Scala di Screening Cognitivo per Adulti', $jsonLd['name']);
        $this->assertSame('1062.50', $jsonLd['offers']['price']);
        $this->assertSame('EUR', $jsonLd['offers']['priceCurrency']);
        $this->assertStringContainsString('w=1200', $jsonLd['image']);
    }
}
