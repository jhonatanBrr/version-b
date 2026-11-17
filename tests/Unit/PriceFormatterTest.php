<?php

namespace Tests\Unit;

use App\Support\PriceFormatter;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class PriceFormatterTest extends TestCase
{
    #[Test]
    public function it_uses_italian_thousands_and_decimal_separators(): void
    {
        $this->assertSame('1.250,00 €', PriceFormatter::format(1250));
    }

    #[Test]
    public function it_keeps_two_decimals_below_one_thousand(): void
    {
        $this->assertSame('157,25 €', PriceFormatter::format(157.25));
    }

    #[Test]
    public function it_groups_large_amounts(): void
    {
        $this->assertSame('12.500,50 €', PriceFormatter::format(12500.5));
    }
}
