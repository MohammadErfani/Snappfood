<?php

namespace App\Http\Middleware;

use App\Models\restaurant\Restaurant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRestaurant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$guard = "salesman")
    {

        if (Auth::guard($guard)->check() && Restaurant::where('salesman_id',Auth::guard($guard)->id())->first()){
            return $next($request);
        }
        return redirect()->route('restaurant.create');
    }
}
