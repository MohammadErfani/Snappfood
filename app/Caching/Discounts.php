<?php

namespace App\Caching;

use App\Models\admin\Discount;

class Discounts extends Caching
{

    public const KEY = "DISCOUNTS";
    public function all()
    {
        return $this->cache(Discount::all());

    }
}
