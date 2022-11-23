<?php

namespace App\Providers;

 use App\Models\Order;
 use App\Models\restaurant\Salesman;
 use App\Models\User;
 use Illuminate\Auth\Access\Response;
 use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('create-restaurant',function (Salesman $salesman){         //only salesman who doesn't have restaurant should access to this
            return !isset($salesman->restaurant->id)?
                Response::allow()
                :Response::deny('You have Restaurant you cant create more restaurant')
                ;
        });
        Gate::define('order-ability',function (Salesman $salesman,Order $order){
           return $order->restaurant_id === $salesman->restaurant->id?
                Response::allow()
               :Response::deny("This order doesn't belong to your restaurant");
        });
    }
}
