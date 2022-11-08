<?php
/*
 * source: https://darkghosthunter.medium.com/laravel-has-many-through-pivot-elegantly-958dd096db
 * reason for these pivot is to make relation between foods and comments
 */
namespace App\Models\Pivots;

use App\Models\Comment;
use App\Models\Order;
use App\Models\restaurant\Food;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FoodOrder extends Pivot
{
    public function food(){
        return $this->belongsTo(Food::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class,Order::class);
    }
}
