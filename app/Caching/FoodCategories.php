<?php

namespace App\Caching;

use App\Models\Admin\FoodCategory;

class FoodCategories extends Caching
{
    public const KEY = 'FOODCATEGORIES';

    public function all()
    {

        return $this->cache(FoodCategory::all());
    }


}
