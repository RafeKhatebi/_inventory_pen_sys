<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function format($amount)
    {
        return rtrim(rtrim(number_format($amount, 2), '0'), '.') . ' افغانی';
    }

    public static function formatWithoutCurrency($amount)
    {
        return rtrim(rtrim(number_format($amount, 2), '0'), '.');
    }
}