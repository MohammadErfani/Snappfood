<?php

namespace App\Models;

use App\Models\Pivots\FoodOrder;
use App\Models\Restaurant\Food;
use App\Models\Restaurant\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * todo : define const for order status
     */
    const PAID = 0;
    const ADDED = 1;
    const REJECTED = 2;
    const INPROGRESS = 3;
    const SENDING = 4;
    const DELIVERED = 5;
    protected $fillable = ['address_id', 'restaurant_id', 'user_id', 'status','total_price'];

    /**
     * @return HasOne
     */
    public function comment():HasOne
    {
        return $this->hasOne(Comment::class);
    }

    /**
     * @return BelongsToMany
     */
    public function foods():BelongsToMany
    {
        return $this->belongsToMany(Food::class)->using(FoodOrder::class);
    }

    /**
     * @return array
     */
    public function foodCounts():array
    {
        $foods = $this->foods;
        $counts =[];
        foreach($foods as $food){
            $counts[$food->id] = FoodOrder::where('order_id',$this->id)->where('food_id',$food->id)->first()->count;
        }
        return $counts;

    }

    /**
     * @return BelongsTo
     */
    public function address():BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * @return BelongsTo
     */
    public function restaurant():BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * @return BelongsTo
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return float|int
     */
    public function calculateTotal():int|float
    {
        $total = 0;
        $foods = $this->foods;
        foreach($foods as $food){
            $off = $food->discount?1-$food->discount->percentage:1;
            $price = $food->price * $off;
            $total = $price *$this->foodCounts()[$food->id];
        }
        return $total;

    }
}
