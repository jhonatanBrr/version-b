<?php

namespace App\Support;

/** Italian euro format used across the site: "1.250,00 €". */
final class PriceFormatter
{
    public static function format(float $amount): string
    {
        return number_format($amount, 2, ',', '.').' €';
    }
}
