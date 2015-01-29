<?php

namespace Formation\Util;

abstract class DiscountCodeHelper
{
    public static function normalize($discountCode)
    {
        $discountCode = strtoupper($discountCode);
        $discountCode = str_replace('Œ', 'OE', $discountCode);
        
        return $discountCode;
    }
}
