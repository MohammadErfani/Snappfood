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
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'price', 'picture', 'material', 'restaurant_id', 'discount_id'];

    protected $with = ['comments','foodCategories'];
    public function foodCategories()
    {
        return $this->belongsToMany(FoodCategory::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->using(FoodOrder::class);
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, FoodOrder::class,
            'food_id', 'order_id', 'id', 'order_id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function foodParty()
    {
        return $this->hasOne(FoodParty::class);
    }

    public static function finalPrice(int $id, int $count = 1)
    {
        $food = self::find($id);
        $off = $food->discount ? 1 - $food->discount->percentage : 1;
        return $food->price * $off * $count;
    }
}
