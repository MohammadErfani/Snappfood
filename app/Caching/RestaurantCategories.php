<?php

namespace App\Caching;

use App\Models\admin\RestaurantCategory;

class RestaurantCategories extends Caching
{

    public const KEY = 'RESTAURANTCATEGOREIS';
    public function all()
    {
        return $this->cache(RestaurantCategory::all());
    }

}
