<?php

namespace App\Caching;

use App\Models\Admin\RestaurantCategory;

class RestaurantCategories extends Caching
{

    public const KEY = 'RESTAURANTCATEGOREIS';
    public function all()
    {
        return $this->cache(RestaurantCategory::all());
    }

}
