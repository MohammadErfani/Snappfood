<?php

namespace App\Observers;

use Facades\App\Caching\FoodCategories;
use App\Models\Admin\FoodCategory;

class FoodCategoryObserver
{

    public function recache()
    {
        FoodCategories::reCache();
    }

    /**
     * Handle the FoodCategory "created" event.
     *
     * @param  \App\Models\Admin\FoodCategory  $foodCategory
     * @return void
     */
    public function created(FoodCategory $foodCategory)
    {
        $this->recache();
    }

    /**
     * Handle the FoodCategory "updated" event.
     *
     * @param  \App\Models\Admin\FoodCategory  $foodCategory
     * @return void
     */
    public function updated(FoodCategory $foodCategory)
    {
        $this->recache();
    }

    /**
     * Handle the FoodCategory "deleted" event.
     *
     * @param  \App\Models\Admin\FoodCategory  $foodCategory
     * @return void
     */
    public function deleted(FoodCategory $foodCategory)
    {
        $this->recache();
    }

    /**
     * Handle the FoodCategory "restored" event.
     *
     * @param  \App\Models\Admin\FoodCategory  $foodCategory
     * @return void
     */
    public function restored(FoodCategory $foodCategory)
    {
        $this->recache();
    }

    /**
     * Handle the FoodCategory "force deleted" event.
     *
     * @param  \App\Models\Admin\FoodCategory  $foodCategory
     * @return void
     */
    public function forceDeleted(FoodCategory $foodCategory)
    {
        $this->recache();
    }
}
