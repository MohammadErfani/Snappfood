<?php

namespace App\Models\restaurant;

use App\Models\admin\Discount;
use App\Models\admin\FoodCategory;
use App\Models\Comment;
use App\Models\FoodParty;
use App\Models\Order;
use App\Models\Pivots\FoodOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'price', 'picture', 'material', 'restaurant_id', 'discount_id'];

    protected $with = ['comments','foodCategories'];
    public function foodCategories():BelongsToMany
    {
        return $this->belongsToMany(FoodCategory::class);
    }

    public function restaurant():BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders():BelongsToMany
    {
        return $this->belongsToMany(Order::class)->using(FoodOrder::class);
    }

    public function comments():HasManyThrough
    {
        return $this->hasManyThrough(Comment::class, FoodOrder::class,
            'food_id', 'order_id', 'id', 'order_id');
    }

    public function discount():BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    public function foodParty():HasOne
    {
        return $this->hasOne(FoodParty::class);
    }

    /**
     * @param int $id
     * @param int $count
     * @return float|int
     */
    public static function finalPrice(int $id, int $count = 1):float|int
    {
        $food = self::find($id);
        $off = $food->discount ? 1 - $food->discount->percentage : 1;
        return $food->price * $off * $count;
    }
}
