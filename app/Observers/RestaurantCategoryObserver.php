<?php

namespace App\Observers;

use Facades\App\Caching\RestaurantCategories;
use App\Models\Admin\RestaurantCategory;

class RestaurantCategoryObserver
{

    public function reCache()
    {
        RestaurantCategories::reCache();
    }

    /**
     * Handle the RestaurantCategory "created" event.
     *
     * @param  \App\Models\Admin\RestaurantCategory  $restaurantCategory
     * @return void
     */
    public function created(RestaurantCategory $restaurantCategory)
    {
        $this->reCache();
    }

    /**
     * Handle the RestaurantCategory "updated" event.
     *
     * @param  \App\Models\Admin\RestaurantCategory  $restaurantCategory
     * @return void
     */
    public function updated(RestaurantCategory $restaurantCategory)
    {
        $this->reCache();
    }

    /**
     * Handle the RestaurantCategory "deleted" event.
     *
     * @param  \App\Models\Admin\RestaurantCategory  $restaurantCategory
     * @return void
     */
    public function deleted(RestaurantCategory $restaurantCategory)
    {
        $this->reCache();
    }

    /**
     * Handle the RestaurantCategory "restored" event.
     *
     * @param  \App\Models\Admin\RestaurantCategory  $restaurantCategory
     * @return void
     */
    public function restored(RestaurantCategory $restaurantCategory)
    {
        $this->reCache();
    }

    /**
     * Handle the RestaurantCategory "force deleted" event.
     *
     * @param  \App\Models\Admin\RestaurantCategory  $restaurantCategory
     * @return void
     */
    public function forceDeleted(RestaurantCategory $restaurantCategory)
    {
        $this->reCache();
    }
}
