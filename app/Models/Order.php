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
    use HasFactory,SoftDeletes;
    const NOTPAID = 0;
    const PAID= 1;
    const PENDING = 2;
    const INPROGRESS = 3;
    const SENDING = 4;
    const DELIVERED = 5;
    protected $fillable = ['address_id','restaurant_id','user_id','status'];
    public function comment()
    {
        return $this->hasOne(Comment::class);
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class)->using(FoodOrder::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
