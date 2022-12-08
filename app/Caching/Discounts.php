<?php

namespace App\Caching;

use App\Models\Admin\Discount;

class Discounts extends Caching
{

    public const KEY = "DISCOUNTS";
    public function all()
    {
        return $this->cache(Discount::all());

    }
}
