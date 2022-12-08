<?php
/*
 * source: https://darkghosthunter.medium.com/laravel-has-many-through-pivot-elegantly-958dd096db
 * reason for these pivot is to make relation between foods and comments
 */

namespace App\Models\Pivots;

use App\Models\Comment;
use App\Models\Order;
use App\Models\restaurant\Food;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FoodOrder extends Pivot
{
    protected $fillable = ['order_id', 'food_id', 'count'];
    protected $table = 'food_order';

    /**
     * @return BelongsTo
     */
    public function food():BelongsTo
    {
        return $this->belongsTo(Food::class);
    }

    /**
     * @return BelongsTo
     */
    public function order():BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return HasManyThrough
     */
    public function comments():HasManyThrough
    {
        return $this->hasManyThrough(Comment::class, Order::class);
    }
}
