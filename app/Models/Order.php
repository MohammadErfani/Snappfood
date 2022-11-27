<?php

namespace App\Models;

use App\Models\Pivots\FoodOrder;
use App\Models\restaurant\Food;
use App\Models\restaurant\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    const PAID = 0;
    const ADDED = 1;
    const REJECTED = 2;
    const INPROGRESS = 3;
    const SENDING = 4;
    const DELIVERED = 5;
    protected $fillable = ['address_id', 'restaurant_id', 'user_id', 'status','total_price'];

    public function comment()
    {
        return $this->hasOne(Comment::class);
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class)->using(FoodOrder::class);
    }

    public function foodCounts()
    {
        $foods = $this->foods;
        $counts =[];
        foreach($foods as $food){
            $counts[$food->id] = FoodOrder::where('order_id',$this->id)->where('food_id',$food->id)->first()->count;
        }
        return $counts;

    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return float|int
     */
    public function calculateTotal():int
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
