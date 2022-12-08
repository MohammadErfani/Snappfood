<?php

namespace App\Observers;

use Facades\App\Caching\Discounts;
use App\Models\Admin\Discount;

class DiscountObserver
{


    public function reCache()
    {
        Discounts::reCache();
    }
    /**
     * Handle the Discount "created" event.
     *
     * @param  \App\Models\Admin\Discount  $discount
     * @return void
     */
    public function created(Discount $discount)
    {
        $this->reCache();
    }

    /**
     * Handle the Discount "updated" event.
     *
     * @param  \App\Models\Admin\Discount  $discount
     * @return void
     */
    public function updated(Discount $discount)
    {
        $this->reCache();
    }

    /**
     * Handle the Discount "deleted" event.
     *
     * @param  \App\Models\Admin\Discount  $discount
     * @return void
     */
    public function deleted(Discount $discount)
    {
        $this->reCache();
    }

    /**
     * Handle the Discount "restored" event.
     *
     * @param  \App\Models\Admin\Discount  $discount
     * @return void
     */
    public function restored(Discount $discount)
    {
        $this->reCache();
    }

    /**
     * Handle the Discount "force deleted" event.
     *
     * @param  \App\Models\Admin\Discount  $discount
     * @return void
     */
    public function forceDeleted(Discount $discount)
    {
        $this->reCache();
    }
}
