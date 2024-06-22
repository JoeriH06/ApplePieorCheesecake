<?php

namespace App\Helpers;

class ColorHelper
{
    public static function getColorClass($price)
    {
        if ($price <= 20) {
            return 'bg-light-sage';
        } elseif ($price <= 40) {
            return 'bg-medium-sage';
        } elseif ($price <= 60) {
            return 'bg-terracotta';
        } elseif ($price <= 80) {
            return 'bg-dark-terracotta';
        } else {
            return 'bg-burnt-sienna';
        }
    }
}
