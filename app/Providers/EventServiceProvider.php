<?php

namespace App\Providers;

use App\Caching\Discounts;
use App\Models\Admin\Discount;
use App\Models\Admin\FoodCategory;
use App\Models\Admin\RestaurantCategory;
use App\Models\Order;
use App\Observers\DiscountObserver;
use App\Observers\FoodCategoryObserver;
use App\Observers\OrderObserver;
use App\Observers\RestaurantCategoryObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Order::observe(OrderObserver::class);
        FoodCategory::observe(FoodCategoryObserver::class);
        RestaurantCategory::observe(RestaurantCategoryObserver::class);
        Discount::observe(DiscountObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
